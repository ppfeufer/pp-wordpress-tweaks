<?php

/**
 * Remove the oembed stuff
 */

namespace Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Remove the oembed stuff
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Oembed extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_oembed';

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
            'title' => __('oEmbed', 'pp-wordpress-tweaks'),
            'desc' => __('Disable oEmbed discovery', 'pp-wordpress-tweaks'),
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
        remove_action(hook_name: 'wp_head', callback: 'wp_oembed_add_discovery_links');
        remove_action(hook_name: 'rest_api_init', callback: 'wp_oembed_register_route');
        remove_filter(
            hook_name: 'oembed_dataparse',
            callback: 'wp_filter_oembed_result'
        );
        remove_action(hook_name: 'wp_head', callback: 'wp_oembed_add_host_js');
    }
}
