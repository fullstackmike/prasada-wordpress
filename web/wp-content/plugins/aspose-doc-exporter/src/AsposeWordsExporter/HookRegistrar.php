<?php

namespace AsposeWordsExporter;

class HookRegistrar {

    public function register() {
        if (strlen(get_option("aspose-cloud-app-sid")) < 1) {
            add_action("admin_notices", array($this, "activationNotice"));
        } else {
            add_action("admin_init", array($this, "registerAdminSettings"));
            add_action('admin_menu', array($this, "adminMenu"));

            global $wpdb;
            $post_types = $wpdb->get_col("SELECT DISTINCT(post_type) FROM $wpdb->posts");
            foreach ($post_types as $t) {
                add_filter("bulk_actions-edit-$t", array($this, "bulkActionMenu"));
                add_filter("handle_bulk_actions-edit-$t", array($this, "exportBulkAction"), 10, 3);
            }

            add_filter(
                    "plugin_action_links_" . plugin_basename(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE),
                    array($this, "pluginActionLinks")
            );
        }
    }

    public function activationNotice() {
        update_option("aspose-cloud-activation-secret", bin2hex(random_bytes(64)));
        echo ExportEngine::getTwig()->render("activation-notice.twig", [
            "activation_url" => trim(ASPOSE_CLOUD_MARKETPLACE_ACTIVATOR_URL, "/") . "/activate?callback=" . urlencode(site_url()) . "&secret=" . get_option("aspose-cloud-activation-secret"),
            "site_url" => site_url(),
            "admin_email" => get_bloginfo("admin_email"),
            "plugin_data" => get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE),
            "options" => wp_load_alloptions(),
        ]);
    }

    public function adminMenu() {
        add_options_page(
                get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)["Name"] . " " . __("Settings"),
                get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)["Name"],
                "manage_options",
                dirname(plugin_basename(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)),
                array($this, "settingsPage")
        );
    }

    public function pluginActionLinks($default_links) {
        $links = array(
            sprintf("<a href=\"%s\">%s</a>",
                    admin_url("options-general.php?page=" . dirname(plugin_basename(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE))),
                    __("Settings")
            )
        );
        return array_merge($links, $default_links);
    }

    public function registerAdminSettings() {
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_comments_text');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_post_comments');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_file_type');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_post_content_filters');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_post_date');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_post_author');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_archive_posts');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_post_categories');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_metadata');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_excerpt');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_content');
        register_setting('aspose_doc_exporter_options', 'aspose_doc_exporter_do_shortcode');
    }

    public function settingsPage() {
        echo ExportEngine::getTwig()->render("settings.twig", [
            "settings_fields" => (function() {
                        ob_start();
                        settings_fields('aspose_doc_exporter_options');
                        $ob = ob_get_contents();
                        ob_end_clean();
                        return $ob;
                    })(),
            "plugin_data" => get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE),
            "options" => wp_load_alloptions(),
        ]);
    }

    public function bulkActionMenu($bulk_actions) {
        $bulk_actions["AsposeDocExporter_export"] = __(
                "Export to " . strtoupper(get_option("aspose_doc_exporter_file_type")) . " (" . get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)["Name"] . ")",
                "AsposeDocExporter_export"
        );
        return $bulk_actions;
    }

    public function exportBulkAction($redirect_to, $doaction, $post_ids) {
        if ($doaction !== 'AsposeDocExporter_export' || count($post_ids) < 1) {
            return $redirect_to;
        }

        if (count($post_ids) === 1 || get_option("aspose_doc_exporter_archive_posts") !== "1") {
            $e = new ExportEngine($post_ids);
            try {
                $e->export();
                $e->convert();
                header("Content-type: application/octet-stream");
                header("Content-disposition: attachment; filename=\"" . $e->getSlug() . "." . strtolower(get_option("aspose_doc_exporter_file_type")) . "\";");
                readfile($e->getConvertedFilePath());
                $e->clean();
            } catch (GuzzleHttp\Exception\ClientException $x) {
                $err = json_decode($x->getResponse()->getBody(true));
                if ($err->error === "invalid_client") {
                    wp_die("Aspose DOC Exporter: Invalid <b>App SID</b> or <b>App Key</b>. Check your plugin settings and try again.");
                } else {
                    wp_die($err);
                }
            } catch (GuzzleHttp\Exception\ServerException $x) {
                $err = json_decode($x->getResponse()->getBody(true));
                wp_die($err);
            } catch (Exception $x) {
                wp_die($x);
            }
        } else {
            $ee = array();

            foreach ($post_ids as $post_id) {
                try {
                    $ee[] = new ExportEngine($post_id);
                } catch (Exception $x) {
                    wp_die($x);
                }
            }

            foreach ($ee as $e) {
                try {
                    $e->export();
                    $e->convert();
                } catch (Exception $x) {
                    wp_die($x);
                }
            }

            $zfile = wp_upload_dir()["path"] . "/exported-posts-" . time() . ".zip";
            $zip = new \ZipArchive();
            if ($zip->open($zfile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
                foreach ($ee as $e) {
                    $zip->addFile($e->getConvertedFilePath(), $e->getSlug() . "." . strtolower(get_option("aspose_doc_exporter_file_type")));
                }
                $zip->close();
            } else {
                wp_die("Failed to create archive");
            }

            header("Content-type: application/zip");
            header("Content-disposition: attachment; filename=exported-posts" . time() . ".zip;");
            readfile($zfile);

            foreach ($ee as $e) {
                try {
                    $e->clean();
                } catch (Exception $x) {
                    
                }
            }
        }
    }

}
