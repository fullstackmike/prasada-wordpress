<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVInfoCallback')) :

class BVInfoCallback extends BVCallbackBase {
	public $db;
	public $settings;
	public $siteinfo;
	public $bvinfo;

	public function __construct($callback_handler) {
		$this->db = $callback_handler->db;
		$this->siteinfo = $callback_handler->siteinfo;
		$this->settings = $callback_handler->settings;
		$this->bvinfo = new LWInfo($this->settings);
	}

	public function getPosts($post_type, $count = 5) {
		$output = array();
		$args = array('numberposts' => $count, 'post_type' => $post_type);
		$posts = get_posts($args);
		$keys = array('post_title', 'guid', 'ID', 'post_date');
		$result = array();
		foreach ($posts as $post) {
			$pdata = array();
			$post_array = get_object_vars($post);
			foreach ($keys as $key) {
				$pdata[$key] = $post_array[$key];
			}
			$result["posts"][] = $pdata;
		}
		return $result;
	}

	public function getStats() {
		return array(
			"posts" => get_object_vars(wp_count_posts()),
			"pages" => get_object_vars(wp_count_posts("page")),
			"comments" => get_object_vars(wp_count_comments())
		);
	}

	public function getPlugins() {
		if (!function_exists('get_plugins')) {
			require_once (ABSPATH."wp-admin/includes/plugin.php");
		}
		$plugins = get_plugins();
		$result = array();
		foreach ($plugins as $plugin_file => $plugin_data) {
			$pdata = array(
				'file' => $plugin_file,
				'title' => $plugin_data['Title'],
				'version' => $plugin_data['Version'],
				'active' => is_plugin_active($plugin_file),
				'network' => $plugin_data['Network']
			);
			$result["plugins"][] = $pdata;
		}
		return $result;
	}

	public function themeToArray($theme) {
		if (is_object($theme)) {
			$pdata = array(
				'name' => $theme->Name,
				'title' => $theme->Title,
				'stylesheet' => $theme->get_stylesheet(),
				'template' => $theme->Template,
				'version' => $theme->Version
			);
		} else {
			$pdata = array(
				'name' => $theme["Name"],
				'title' => $theme["Title"],
				'stylesheet' => $theme["Stylesheet"],
				'template' => $theme["Template"],
				'version' => $theme["Version"]
			);
		}
		return $pdata;
	}

	public function getThemes() {
		$result = array();
		$themes = function_exists('wp_get_themes') ? wp_get_themes() : get_themes();
		foreach($themes as $theme) {
			$pdata = $this->themeToArray($theme);
			$result["themes"][] = $pdata;
		}
		$theme = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme();
		$pdata = $this->themeToArray($theme);
		$result["currenttheme"] = $pdata;
		return $result;
	}

	public function getSystemInfo() {
		$sys_info = array(
			'serverip' => $_SERVER['SERVER_ADDR'],
			'host' => $_SERVER['HTTP_HOST'],
			'phpversion' => phpversion(),
			'AF_INET6' => defined('AF_INET6')
		);
		if (function_exists('get_current_user')) {
			$sys_info['user'] = get_current_user();
		}
		if (function_exists('getmygid')) {
			$sys_info['gid'] = getmygid();
		}
		if (function_exists('getmyuid')) {
			$sys_info['uid'] = getmyuid();
		}
		if (function_exists('posix_getuid')) {
			$sys_info['webuid'] = posix_getuid();
			$sys_info['webgid'] = posix_getgid();
		}
		return array("sys" => $sys_info);
	}

	public function getWpInfo() {
		global $wp_version, $wp_db_version, $wp_local_package;
		$siteinfo = $this->siteinfo;
		$db = $this->db;
		$upload_dir = wp_upload_dir();

		$wp_info = array(
			'dbprefix' => $db->dbprefix(),
			'wpmu' => $siteinfo->isMultisite(),
			'mainsite' => $siteinfo->isMainSite(),
			'name' => get_bloginfo('name'),
			'siteurl' => $siteinfo->siteurl(),
			'homeurl' => $siteinfo->homeurl(),
			'charset' => get_bloginfo('charset'),
			'wpversion' => $wp_version,
			'dbversion' => $wp_db_version,
			'abspath' => ABSPATH,
			'uploadpath' => $upload_dir['basedir'],
			'uploaddir' => wp_upload_dir(),
			'contentdir' => defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR : null,
			'contenturl' => defined('WP_CONTENT_URL') ? WP_CONTENT_URL : null,
			'plugindir' => defined('WP_PLUGIN_DIR') ? WP_PLUGIN_DIR : null,
			'dbcharset' => defined('DB_CHARSET') ? DB_CHARSET : null,
			'disallow_file_edit' => defined('DISALLOW_FILE_EDIT'),
			'disallow_file_mods' => defined('DISALLOW_FILE_MODS'),
			'locale' => get_locale(),
			'wp_local_string' => $wp_local_package,
			'charset_collate' => $db->getCharsetCollate()
		);
		return array("wp" => $wp_info);
	}

	public function getUsers($args = array(), $full) {
		$results = array();
		$users = get_users($args);
		if ('true' == $full) {
			$results = $this->objectToArray($users);
		} else {
			foreach( (array) $users as $user) {
				$result = array();
				$result['user_email'] = $user->user_email;
				$result['ID'] = $user->ID;
				$result['roles'] = $user->roles;
				$result['user_login'] = $user->user_login;
				$result['display_name'] = $user->display_name;
				$result['user_registered'] = $user->user_registered;
				$result['user_status'] = $user->user_status;
				$result['user_url'] = $user->url;

				$results[] = $result;
			}
		}
		return array("users" => $results);
	}
	
	public function availableFunctions(&$info) {
		if (extension_loaded('openssl')) {
			$info['openssl'] = "1";
		}
		if (function_exists('is_ssl') && is_ssl()) {
			$info['https'] = "1";
		}
		if (function_exists('openssl_public_encrypt')) {
			$info['openssl_public_encrypt'] = "1";
		}
		if (function_exists('openssl_public_decrypt')) {
			$info['openssl_public_decrypt'] = "1";
		}
		$info['sha1'] = "1";
		$info['apissl'] = "1";
		if (function_exists('base64_encode')) {
			$info['b64encode'] = true;
		}
		if (function_exists('base64_decode')) {
			$info['b64decode'] = true;
		}
		return $info;
	}
	
	public function servicesInfo(&$data) {
		$settings = $this->settings;
		$data['dynsync'] = $settings->getOption('bvDynSyncActive');
		$data['woodyn'] = $settings->getOption('bvWooDynSync');
		$data['dynplug'] = $settings->getOption('bvdynplug');
		$data['ptplug'] = $settings->getOption('bvptplug');
		$data['fw'] = $this->getFWConfig();
		$data['lp'] = $this->getLPConfig();
		$data['brand'] = $settings->getOption($this->bvinfo->brand_option);
		$data['badgeinfo'] = $settings->getOption($this->bvinfo->badgeinfo);
	}

	public function getLPConfig() {
		$config = array();
		$settings = $this->settings;
		$mode = $settings->getOption('bvlpmode');
		$cplimit = $settings->getOption('bvlpcaptchalimit');
		$tplimit = $settings->getOption('bvlptempblocklimit');
		$bllimit = $settings->getOption('bvlpblockAllLimit');
		$config['mode'] = intval($mode ? $mode : 1);
		$config['captcha_limit'] = intval($cplimit ? $cplimit : 3);
		$config['temp_block_limit'] = intval($tplimit? $tplimit : 6);
		$config['block_all_limit'] = intval($bllimit ? $bllimit : 100);
		return $config;
	}

	public function getFWConfig() {
		$config = array();
		$settings = $this->settings;
		$mode = $settings->getOption('bvfwmode');
		$drules = $settings->getOption('bvfwdisabledrules');
		$arules = $settings->getOption('bvfwauditrules');
		$rmode = $settings->getOption('bvfwrulesmode');
		$reqprofilingmode = $settings->getOption('bvfwreqprofilingmode');
		$config['mode'] = intval($mode ? $mode : 1);
		$config['disabled_rules'] = $drules ? $drules : array();
		$config['audit_rules'] = $arules ? $arules : array();
		$config['rules_mode'] = intval($rmode ? $rmode : 1);
		$config['req_profiling_mode'] = intval($reqprofilingmode ? $reqprofilingmode : 1);
		return $config;
	}

	public function dbconf(&$info) {
		$db = $this->db;
		if (defined('DB_CHARSET'))
			$info['dbcharset'] = DB_CHARSET;
		$info['dbprefix'] = $db->dbprefix();
		$info['charset_collate'] = $db->getCharsetCollate();
		return $info;
	}
	
	public function activate() {
		$resp = array();
		$this->siteinfo->basic($resp);
		$this->servicesInfo($resp);
		$this->dbconf($resp);
		$this->availableFunctions($resp);
		return array('actinfo' => $resp);
	}

	public function process($request) {
		$db = $this->db;
		$params = $request->params;
		switch ($request->method) {
		case "activateinfo":
			$resp = $this->activate();
			break;
		case "gtpsts":
			$count = 5;
			if (array_key_exists('count', $params))
				$count = $params['count'];
			$resp = $this->getPosts($params['post_type'], $count);
			break;
		case "gtsts":
			$resp = $this->getStats();
			break;
		case "gtplgs":
			$resp = $this->getPlugins();
			break;
		case "gtthms":
			$resp = $this->getThemes();
			break;
		case "gtsym":
			$resp = $this->getSystemInfo();
			break;
		case "gtwp":
			$resp = $this->getWpInfo();
			break;
		case "getoption":
			$resp = array("option" => $this->settings->getOption($params['name']));
			break;
		case "gtusrs":
			$full = false;
			if (array_key_exists('full', $params))
				$full = true;
			$resp = $this->getUsers($params['args'], $full);
			break;
		case "gttrnsnt":
			$transient = $this->settings->getTransient($params['name']);
			if ($transient && array_key_exists('asarray', $params))
				$transient = $this->objectToArray($transient);
			$resp = array("transient" => $transient);
			break;
		default:
			$resp = false;
		}
		return $resp;
	}
}
endif;