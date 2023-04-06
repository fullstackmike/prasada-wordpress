<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '/mnt/stor09-wc1-ord1/766448/956613/www.prasadawholebeing.com/web/content/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
// define('DB_NAME', '956613_prasada');
// 
// /** MySQL database username */
// define('DB_USER', '956613_prasada');
// 
// /** MySQL database password */
// define('DB_PASSWORD', 'bL4XbK5S4Oq31g');
// 
// /** MySQL hostname */
// define('DB_HOST', 'mysql51-129.wc1.ord1.stabletransit.com');
// 
// /** Database Charset to use in creating database tables. */
// define('DB_CHARSET', 'utf8');
// 
// /** The Database Collate type. Don't change this if in doubt. */
// define('DB_COLLATE', '');

define('DISALLOW_FILE_EDIT', TRUE); // Sucuri Security: Mon, 01 Jun 2015 17:55:26 +0000


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'C5fC>H]F>5<YE.;%16Of.)n12Q$W&04h6)USoS{bk-!Z@3B#w?.m9eo!5|vI0{Z6');
define('SECURE_AUTH_KEY',  '^hm20je;2<R$P/O_*E6NSumkuS3vPq]sHlvfFJ8Hv1i-R84x9!_226_xYM3b$2Ei');
define('LOGGED_IN_KEY',    '+0yqgG9L5,uWW{/67$u0)e4F28QCw;Vi2;I(yesD3W]ZS.tn4Y"K#|?C7E^1xyj}');
define('NONCE_KEY',        'q3&Z&61-30Ij.@GUxA38z/L3wo55Xo2<?FM6MONcO:vF6@}1a19J;VNp)S/F*Tr6');
define('AUTH_SALT',        '}%yJq=V%&,hJ2fL@gVj9e8y{opB3(49^F5n6.)I791ex^Z7"ir3x{Btk26nIw"m#');
define('SECURE_AUTH_SALT', '^hm20je;2<R$P/O_*E6NSumkuS3vPq]sHlvfFJ8Hv1i-R84x9!_226_xYM3b$2Ei');
define('LOGGED_IN_SALT',   'Fy-Z_Ft6wn3ZC%T%$b$/M|/;/7z$g*"Vd^j}jN3P!7cbI6>k&1brZ2jRaTtqzo=M');
define('NONCE_SALT',       '13KkQN!pi=A2Qn_v<[WM}&18yuy8SjiUm3%$eM0wxB{+Y*gL#$[!S}(?rfW-y%DV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST']);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

// Include for ddev-managed settings in wp-config-ddev.php.
$ddev_settings = dirname(__FILE__) . '/wp-config-ddev.php';
if (is_readable($ddev_settings) && !defined('DB_USER')) {
    require_once($ddev_settings);
}


/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');