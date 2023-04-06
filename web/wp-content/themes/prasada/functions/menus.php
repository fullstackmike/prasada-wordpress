<?php
add_theme_support( 'nav-menus' );
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Navigation' ),
			'footer-nav' => __( 'Footer Navigation' ),
			'extra-nav' => __( 'Extra Navigation' )
		)
	);
}
?>