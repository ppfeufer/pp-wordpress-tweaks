<?php

/**
 * Removing the debug from html output when Enfold theme is used
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use WordPress\Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Removing the debug from html output when Enfold theme is used
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class EnfoldTheme extends GenericSingleton implements TweakInterface {
    /**
     * The option group for the tweak
     *
     * @var string TWEAK_OPTION_GROUP The option group of the tweak in the settings.
     * @scope private
     */
    private const TWEAK_OPTION_GROUP = 'pp-wordpress-tweaks';

    /**
     * The section ID of the tweak
     *
     * @var string TWEAK_SECTION_ID The section ID of the tweak in the settings.
     * @scope private
     */
    private const TWEAK_SECTION_ID = 'pp-wordpress-tweaks';
    /**
     * The name of the tweak
     *
     * @var string TWEAK_FIELD_ID The field ID of the tweak in the settings.
     * @scope private
     */
    private const TWEAK_FIELD_ID = 'tweak_enfold_theme';

    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     */
    public function init(): void {
        if (wpsf_get_setting(
            $this::TWEAK_OPTION_GROUP,
            $this::TWEAK_SECTION_ID,
            $this::TWEAK_FIELD_ID
        )) {
            $this->execute();
        }
    }

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array {
        return [
            'id' => $this::TWEAK_FIELD_ID,
            'title' => __('Enfold debug', 'pp-wordpress-tweaks'),
            'desc' => __(
                'Remove the debug from html output when the Enfold theme is used',
                'pp-wordpress-tweaks'
            ),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @access public
     */
    public function execute(): void {
        add_action(
            hook_name: 'wp_loaded',
            callback: [$this, 'removeAviaDebug'],
            priority: 9999
        );
    }

    /**
     * Remove the Debug Comment when Enfold Theme is used.
     *
     * @return void
     * @access public
     */
    public function removeAviaDebug(): void {
        remove_action(
            hook_name: 'wp_head',
            callback: 'avia_debugging_info',
            priority: 9999999
        );
        remove_action(
            hook_name: 'admin_print_scripts',
            callback: 'avia_debugging_info',
            priority: 9999999
        );
    }
}
