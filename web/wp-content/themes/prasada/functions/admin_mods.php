<?php
// UPDATE FOOTER
function remove_footer_admin () {
  echo 'Brought to you by <a href="http://www.legalisi.com/" target="_blank">LISI</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// UPDATE VERSION
function change_footer_version() {
  return 'Powered by LISI Press 3';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

// REMOVE UPDATE NOTICE
//add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// REPLACE HOWDY TEXT
function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', 'Logged in as', $my_account->title );            
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// REPLACE LOGIN LOGO
function lisi_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/lisi_logo.jpg);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'lisi_logo' );

// REPLACE LOGIN LINK
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// UPDATE TITLE OF LINK
function my_login_logo_url_title() {
    return 'Powered by LISI Press 3.0';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// LOGIN STYLESHEET
function my_login_stylesheet() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/css/style-login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
?>