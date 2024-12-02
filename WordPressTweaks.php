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
 * @version 1.3.1
 *
 * @wordpress-plugin
 * Plugin Name: WordPress Tweaks
 * Plugin URI: https://github.com/ppfeufer/pp-wordpress-tweaks
 * Description: A collection of personal tweaks for WordPress.
 * Version: 1.3.1
 * Requires at least: 6.0
 * Requires PHP: 8.2
 * Author: H. Peter Pfeufer
 * Author URI: https://ppfeufer.de
 * Text Domain: pp-wordpress-tweaks
 * Domain Path: /l10n
 * License: GPLv3
 * License URI: https://github.com/ppfeufer/pp-wordpress-tweaks/blob/master/LICENSE
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

// Load the text domain.
add_action(hook_name: 'init', callback: static function () {
    load_plugin_textdomain(
        domain: 'pp-wordpress-tweaks',
        deprecated: false,
        plugin_rel_path: basename(path: __DIR__) . '/l10n/'
    );
});

// Load the plugin's main class.
new Main();
