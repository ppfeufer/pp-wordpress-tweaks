<?php
/**
 * WordPress Tweaks
 *
 * A collection of personal tweaks for WordPress.
 *
 * @package WordPress\Ppfeufer\Plugin\WordPressTweaks
 * @author H. Peter Pfeufer
 * @copyright 2021 H. Peter Pfeufer
 * @license GPL-3.0-or-later
 * @version 1.3.0
 *
 * @wordpress-plugin
 * Plugin Name: WordPress Tweaks
 * Plugin URI: https://github.com/ppfeufer/pp-wordpress-tweaks
 * Description: A collection of personal tweaks for WordPress.
 * Version: 1.3.0
 * Author: H. Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * License: GPLv3
 * License URI: https://github.com/ppfeufer/pp-wordpress-tweaks/blob/master/LICENSE
 * Text Domain: pp-wordpress-tweaks
 * Domain Path: /l10n
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks;

// phpcs:disable
define(
    constant_name: __NAMESPACE__ . '\PLUGIN_DIR',
    value: plugin_dir_path(file: __FILE__)
);
define(
    constant_name: __NAMESPACE__ . '\PLUGIN_URI',
    value: plugin_dir_url(file: __FILE__)
);
define(
    constant_name: __NAMESPACE__ . '\PLUGIN_FILE',
    value: plugin_basename(file: __FILE__)
);

require_once trailingslashit(value: __DIR__) . 'Sources/autoloader.php';
require_once trailingslashit(value: __DIR__) . 'Sources/Libs/autoload.php';
// phpcs:enable

// Load the plugin's main class.
(new Main())->init();
