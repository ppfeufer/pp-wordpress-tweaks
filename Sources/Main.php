<?php

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Libs\YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

/**
 * Main plugin class
 *
 * @package WordPress\Ppfeufer\Plugin\WordPressTweaks
 */
class Main {
    /**
     * Text domain
     *
     * @var string $textDomain The text domain
     */
    private string $textDomain;

    /**
     * Localization directory
     *
     * @var string $localizationDirectory The localization directory
     */
    private string $localizationDirectory;

    /**
     * WordPressTweaks constructor.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function __construct() {
        /**
         * Initializing Variables
         */
        $this->textDomain = 'pp-wordpress-tweaks';
        $this->localizationDirectory = basename(path: __DIR__) . '/l10n/';
    }

    /**
     * Initialize the plugin
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses loadTextDomain()
     * @uses loadTweaks()
     * @uses doUpdateCheck()
     */
    public function init(): void {
        $this->loadTextDomain();
        $this->loadSettings();
        $this->loadTweaks();
        $this->doUpdateCheck();
    }

    /**
     * Load the text domain
     *
     * @return void
     * @since 1.0.0
     * @access public
     * @uses load_plugin_textdomain()
     */
    public function loadTextDomain(): void {
        load_plugin_textdomain(
            domain: $this->textDomain,
            plugin_rel_path: $this->localizationDirectory
        );
    }

    /**
     * Load the settings
     *
     * @return void
     * @access public
     * @uses Settings
     */
    public function loadSettings(): void {
        new Settings;
    }

    /**
     * Load the tweaks
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function loadTweaks(): void {
        $tweakClasses = Tweaks::getInstance()->getTweakClasses();

        foreach ($tweakClasses as $tweakClass) {
            $tweakClass::getInstance()->init();
        }
    }

    /**
     * Check for updates
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function doUpdateCheck(): void {
        PucFactory::buildUpdateChecker(
            metadataUrl: 'https://github.com/ppfeufer/pp-wordpress-tweaks/',
            fullPath: PLUGIN_DIR . 'WordPressTweaks.php',
            slug: 'pp-wordpress-tweaks'
        )->getVcsApi()->enableReleaseAssets();
    }
}
