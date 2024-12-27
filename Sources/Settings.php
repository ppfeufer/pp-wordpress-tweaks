<?php

namespace Ppfeufer\Plugin\WordPressTweaks;

use WordPressSettingsFramework;

/**
 * Initialize plugin settings and settings page.
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 */
class Settings {
    /**
     * WordPress Settings Framework
     *
     * @var WordPressSettingsFramework
     * @scope private
     */
    private WordPressSettingsFramework $wpsf;

    /**
     * Constructor.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->wpsf = new WordPressSettingsFramework(
            settings_file: PLUGIN_SOURCE_PATH . '/Settings/WordPressTweaksSettings.php',
            option_group: 'pp-wordpress-tweaks'
        );

        $this->initialize();
    }

    /**
     * Initialize settings page and settings link in the plugin list.
     *
     * @return void
     * @scope public
     */
    public function initialize(): void {
        // Add admin menu.
        add_action(
            hook_name: 'admin_menu',
            callback: [$this, 'addSettingsPage'],
            priority: 20
        );

        // Add a settings link to plugin actions.
        add_action(
            hook_name: 'plugin_action_links_' . PLUGIN_BASENAME,
            callback: [$this, 'pluginActionsLink']
        );

        // Add an optional settings validation filter (recommended).
//        add_filter(
//            hook_name: $this->wpsf->get_option_group() . '_settings_validate',
//            callback: [$this, 'validateSettings']
//        );
    }

    /**
     * Add the settings page to the admin menu.
     *
     * @return void
     * @scope public
     */
    public function addSettingsPage(): void {
        $this->wpsf->add_settings_page(
            args: [
                'parent_slug' => 'options-general.php',
                'page_title' => __('WP Tweaks Settings', 'pp-wordpress-tweaks'),
                'menu_title' => __('WP Tweaks', 'pp-wordpress-tweaks'),
                'capability' => 'edit_posts',
            ]
        );
    }

    /**
     * Add a link to the option page from the plugin list
     *
     * @param array $links Plugin Links.
     * @return array
     * @scope public
     */
    public function pluginActionsLink(array $links): array {
        $new_links = [
            sprintf(
                '<a href="' . admin_url(path: 'options-general.php?page=%1$s') . '">%2$s</a>',
                'pp-wordpress-tweaks-settings',
                __('Plugin Settings', 'pp-wordpress-tweaks')
            )
        ];

        return array_merge($new_links, $links);
    }

    /**
     * Validate settings before saving.
     *
     * @param array $input Settings input.
     * @return array
     * @scope public
     */
//    public function validateSettings(array $input): array {
//        return $input;
//    }
}
