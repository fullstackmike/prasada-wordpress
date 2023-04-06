<?php

if (!defined("WP_UNINSTALL_PLUGIN")) {
    die();
}

delete_option("aspose_doc_exporter_app_sid");
delete_option("aspose_doc_exporter_app_key");
delete_option("aspose_doc_exporter_comments_text");
delete_option("aspose_doc_exporter_post_comments");
delete_option("aspose_doc_exporter_archive_posts");
delete_option("aspose_doc_exporter_file_type");
delete_option("aspose_doc_exporter_post_content_filters");
delete_option("aspose_doc_exporter_post_date");
delete_option("aspose_doc_exporter_post_author");
delete_option("aspose_doc_exporter_post_categories");

