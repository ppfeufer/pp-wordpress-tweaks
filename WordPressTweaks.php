<?php
/**
 * Plugin Name: WordPress Tweaks
 * Plugin URI: https://github.com/ppfeufer/pp-wordpress-tweaks
 * Description: A collection of personal tweaks for WordPress.
 * Version: 1.0.0
 * Author: H. Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * License: GPLv3
 * License URI: https://github.com/ppfeufer/pp-wordpress-tweaks/blob/master/LICENSE
 * Text Domain: pp-wordpress-tweaks
 * Domain Path: /l10n
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks;

// phpcs:disable
define(constant_name: 'PP_WP_TWEAKS_PLUGIN_DIR', value: plugin_dir_path(file: __FILE__));

require_once trailingslashit(value: __DIR__) . 'Sources/autoloader.php';
require_once trailingslashit(value: __DIR__) . 'Sources/Libs/autoload.php';
// phpcs:enable

// Load the plugin's main class.
(new Main())->init();
