<?php

/**
 * Remove the WooCommerce generator version
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use WordPress\Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Remove the WooCommerce generator version
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class WooCommerce extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_woocommerce';

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
            'title' => __('WooCommerce', 'ppp-wordpress-tweaks'),
            'desc' => __('Remove the WooCommerce generator tag', 'pp-wordpress-tweaks'),
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
        remove_action(hook_name: 'wp_head', callback: 'wc_generator_tag');
    }
}
