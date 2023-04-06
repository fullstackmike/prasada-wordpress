<?php
//LOAD JQUERY and JQUERY UI
//wp_enqueue_script('jquery');
//wp_enqueue_script('jquery-ui-tabs');


//Adding in the Featured Image functionality and adding in our custom sizes
include("functions/custom_thumbs.php");

// Add Custom Functions
include("functions/custom_functions.php");

// Add in Widgets
include("functions/widgets.php");

// Add in Menus
include("functions/menus.php");

// Admin Mods
include("functions/admin_mods.php");

// Remove update nag for all non-admin users
if ( !current_user_can( 'edit_users' ) ) {
	add_action('admin_menu','wphidenag');
	function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
	}
}

// GIVE EDITOR ACCESS TO 
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' ); // WIDGETS & MENUS
//$role_object->add_cap( 'manage_options' ); // SETTINGS

remove_action('wp_head', 'wp_generator');

function disable_autosave() {
	wp_deregister_script('autosave');
}
add_action('wp_print_scripts','disable_autosave'); 


// show admin bar only for admins
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
$classes[] = 'et_bloom';
return $classes;
}


?>