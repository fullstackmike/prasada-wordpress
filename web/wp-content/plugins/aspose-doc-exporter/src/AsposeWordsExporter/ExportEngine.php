<?php

namespace AsposeWordsExporter;

use Aspose\Words\WordsApi;
use Aspose\Words\Model\Requests\ConvertDocumentRequest;

class ExportEngine {

    public function __construct($post_id) {
        if (is_int($post_id)) {
            $this->post_id = $post_id;
        } else if (is_array($post_id) && count($post_id) === 1 && is_int($post_id[0])) {
            $this->post_id = $post_id[0];
        } else if (is_array($post_id)) {
            $this->post_id = $post_id;
        }
    }

    public function getSlug() {
        if (is_array($this->post_id)) {
            return "exported-posts-" . time();
        } else {
            return get_post($this->post_id)->post_name;
        }
    }

    public function getHtml() {
        if (is_array($this->post_id)) {
            $list = [];
            foreach ($this->post_id as $i) {
                $list[$i] = self::fetchPostData($i);
            }
            return self::getTwig()->render("posts.twig", [
                        "list" => $list,
                        "plugin_data" => get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE),
                        "options" => wp_load_alloptions(),
            ]);
        } else {
            return self::getTwig()->render("post.twig", array_merge(
                                    self::fetchPostData($this->post_id),
                                    [
                                        "plugin_data" => get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE),
                                        "options" => wp_load_alloptions(),
                                    ]
            ));
        }
    }

    public function export() {
        $this->exportedFilePath = get_temp_dir() . "/" . $this->getSlug() . ".html";
        file_put_contents(
                $this->exportedFilePath,
                $this->getHtml()
        );
    }

    public function convert() {
        $file = null;
        try {
            $file = new \SplFileObject($this->getExportedFilePath());
            $req = new ConvertDocumentRequest($file, strtoupper(get_option("aspose_doc_exporter_file_type")), null);
            $res = self::getWordsApi()->convertDocument($req);
            $this->convertedFilePath = $res->getPathname();
        } catch (Exception $x) {
            throw $x;
        } finally {
            $file = null;
        }
    }

    /**
     * Delete temporary/generated files
     */
    public function clean() {
        @unlink($this->exportedFilePath);
        unset($this->exportedFilePath);
        @unlink($this->convertedFilePath);
        unset($this->convertedFilePath);
    }

    private function getExportedFilePath() {
        return $this->exportedFilePath;
    }

    public function getConvertedFilePath() {
        return $this->convertedFilePath;
    }

    public function exported() {
        return isset($this->exportedFilePath) && !empty($this->exportedFilePath);
    }

    public function converted() {
        return isset($this->convertedFilePath) && !empty($this->convertedFilePath);
    }

    public static function getWordsApi() {
        if (!isset(self::$wordsApi)) {
            self::$wordsApi = new WordsApi(
                    get_option("aspose-cloud-app-sid"),
                    get_option("aspose-cloud-app-key"),
                    "https://api.aspose.cloud/"
            );
            //self::$wordsApi->getConfig()->setDebug(WP_DEBUG);
            global $wp_version;
            self::$wordsApi->getConfig()->setUserAgent(sprintf("%s/%s %s/%s WordPress/$wp_version PHP/%s",
                            get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)["Name"],
                            get_plugin_data(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE)["Version"],
                            self::$wordsApi->getConfig()->getUserAgent(),
                            self::$wordsApi->getConfig()->getClientVersion(),
                            PHP_VERSION
            ));
        }
        return self::$wordsApi;
    }

    public static function getTwig() {
        if (!isset(self::$twig)) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE) . "/templates");
            self::$twig = new \Twig\Environment($loader, [
                "debug" => defined("WP_DEBUG") && WP_DEBUG
            ]);

            if (self::$twig->isDebug()) {
                self::$twig->addExtension(new \Twig\Extension\DebugExtension());
            }
        }

        return self::$twig;
    }

    public static function fetchPostData($post_id) {
        $post = get_post($post_id);
        $post_content = $post->post_content;
        if (get_option("aspose_doc_exporter_do_shortcode")) {
            $post_content = do_shortcode($post_content);
        }
        $postmeta_keys = get_post_custom_keys($post_id);
        if ($postmeta_keys) {
            $postmeta_keys = array_filter(get_post_custom_keys($post_id), function($item) {
                return trim($item, '_') === $item;
            });
        } else {
            $postmeta_keys = [];
        }
        $author = get_userdata($post->post_author);
        $categories = get_the_terms($post_id, "category");
        $comments = get_comments(["post_id" => $post_id, "status" => "approve"]);

        return [
            "post" => $post,
            "post_content" => $post_content,
            "postmeta_keys" => $postmeta_keys,
            "author" => $author,
            "categories" => $categories,
            "comments" => $comments,
        ];
    }

    private static $twig;
    private static $wordsApi;

}
