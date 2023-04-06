<?php

/**
 * Plugin Name:         Aspose.Words Exporter
 * Plugin URI:          https://www.aspose.cloud/
 * Version:		5.5.2
 * Description:         Export WordPress posts and pages as DOCX, DOC, ODT Word documents
 * Requires at least:   5.3
 * Requires PHP:        7.2
 * Author:              aspose.cloud Marketplace
 * Author URI:          https://www.aspose.cloud/
 * License:             GPLv2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 */
define("ASPOSE_WORDS_EXPORTER_PLUGIN_FILE", __FILE__);

@include_once(dirname(ASPOSE_WORDS_EXPORTER_PLUGIN_FILE) . "/local.php");
require_once __DIR__ . "/vendor/autoload.php";

defined("ASPOSE_CLOUD_MARKETPLACE_ACTIVATOR_URL") || define("ASPOSE_CLOUD_MARKETPLACE_ACTIVATOR_URL", "https://activator.marketplace.aspose.cloud/");

register_activation_hook(__FILE__, function() {
    update_option("aspose_doc_exporter_file_type", "docx");
    update_option("aspose_doc_exporter_excerpt", "1");
    update_option("aspose_doc_exporter_content", "1");
    update_option("aspose_doc_exporter_do_shortcode", "1");
});

register_deactivation_hook(__FILE__, function() {
    update_option("aspose-cloud-app-sid", null);
    update_option("aspose-cloud-app-key", null);
});

use AsposeWordsExporter\Activation;
use AsposeWordsExporter\HookRegistrar;

call_user_func(function() {
    $a = new Activation();
    $a->register();
    $r = new HookRegistrar();
    $r->register();
});
