<?php

namespace Ppfeufer\Plugin\WordPressTweaks;

use Ppfeufer\Plugin\WordPressTweaks\Libs\YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

/**
 * Main plugin class
 *
 * @package Ppfeufer\Plugin\WordPressTweaks
 */
class Main {
    /**
     * WordPressTweaks constructor.
     *
     * @return void
     * @access public
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Initialize the plugin
     *
     * @return void
     * @access public
     */
    public function init(): void {
        $this->loadSettings();
        $this->loadTweaks();
        $this->doUpdateCheck();
        $this->initializeHooks();
    }

    /**
     * Load the settings
     *
     * @return void
     * @access public
     */
    public function loadSettings(): void {
        new Settings;
    }

    /**
     * Load the tweaks
     *
     * @return void
     * @access public
     */
    public function loadTweaks(): void {
        $tweakClasses = Tweaks::getInstance()->getTweakClasses();

        array_walk(
            array: $tweakClasses,
            callback: static fn($tweakClass) => $tweakClass::getInstance()->init()
        );
    }

    /**
     * Check for updates
     *
     * @return void
     * @access public
     */
    public function doUpdateCheck(): void {
        PucFactory::buildUpdateChecker(
            metadataUrl: 'https://github.com/ppfeufer/pp-wordpress-tweaks/',
            fullPath: PLUGIN_DIR_PATH . '/WordPressTweaks.php',
            slug: 'pp-wordpress-tweaks'
        )->getVcsApi()->enableReleaseAssets();
    }

    /**
     * Initialize the hooks
     *
     * @return void
     * @access private
     */
    private function initializeHooks(): void {
        // Load the text domain.
        add_action(hook_name: 'init', callback: static function () {
            load_plugin_textdomain(
                domain: 'pp-wordpress-tweaks',
                plugin_rel_path: PLUGIN_REL_PATH . '/l10n'
            );
        });
    }
}
