<?php

/**
 * Remove the generator name from head
 */

namespace Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Removing `<meta name="generator" content="WordPress x.y.z" />`
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class GeneratorName extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_generator_name';

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
            'title' => __('Generator name', 'pp-wordpress-tweaks'),
            'desc' => __(
                'Remove the `<meta name="generator" content="WordPress x.y.z" />` tag from the `<head>` section',
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
        remove_action(hook_name: 'wp_head', callback: 'wp_generator');
    }
}
