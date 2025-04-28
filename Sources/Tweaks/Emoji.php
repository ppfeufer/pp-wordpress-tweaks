<?php

/**
 * Remove emoji support
 */

namespace Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Remove emoji support
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Emoji extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_emoji';

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
            'title' => __('Emoji support', 'pp-wordpress-tweaks'),
            'desc' => __('Disable Emoji support', 'pp-wordpress-tweaks'),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Disable the tinymce emojicons
     *
     * @param array $plugins The plugins
     * @return array
     * @access public
     */
    public function disableTinymceEmojicons(array $plugins): array {
        return array_diff($plugins, ['wpemoji']);
    }

    /**
     * Execute the filters and so on
     *
     * @return void
     * @access public
     */
    public function execute(): void {
        remove_action(
            hook_name: 'wp_head',
            callback: 'print_emoji_detection_script',
            priority: 7
        );
        remove_action(hook_name: 'wp_print_styles', callback: 'print_emoji_styles');
        remove_action(
            hook_name: 'admin_print_scripts',
            callback: 'print_emoji_detection_script'
        );
        remove_action(hook_name: 'wp_print_styles', callback: 'print_emoji_styles');

        remove_filter(hook_name: 'wp_mail', callback: 'wp_staticize_emoji_for_email');
        remove_filter(hook_name: 'the_content_feed', callback: 'wp_staticize_emoji');
        remove_filter(hook_name: 'comment_text_rss', callback: 'wp_staticize_emoji');

        add_filter(
            hook_name: 'tiny_mce_plugins',
            callback: [$this, 'disableTinymceEmojicons']
        );
    }
}
