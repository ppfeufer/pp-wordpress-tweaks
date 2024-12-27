<?php

/**
 * Enable/Disable Auto Update Mails
 */

namespace Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Enable/Disable Auto Update Mails
 *
 * @package Ppfeufer\Plugin\WordPressTweaks\Tweaks
 */
class AutoUpdateMails extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_autoupdate_email';

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
            'title' => __('Autoupdate email', 'pp-wordpress-tweaks'),
            'desc' => __(
                'Disable the email notifications for automatic updates. This will only disable the emails for successful updates.',
                'pp-wordpress-tweaks'
            ),
            'type' => 'checkbox',
            'default' => 0
        ];
    }

    /**
     * Initialize the filters for the tweak
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void {
        add_filter(
            hook_name: 'auto_core_update_send_email',
            callback: static function (
                bool $send,
                string $type,
                object $coreUpdate,
                object $result
            ): bool {
                // Disable core update emails only on successful updates.
                return !(!empty($type) && $type === 'success');
            },
        );
        add_filter(
            hook_name: 'auto_plugin_update_send_email',
            callback: static function (
                bool $send,
                object $plugin,
                object $result
            ): bool {
                // Disable plugin update emails.
                return false;
            }
        );
        add_filter(
            hook_name: 'auto_theme_update_send_email',
            callback: static function (
                bool $send,
                object $theme,
                object $result
            ): bool {
                // Disable theme update emails.
                return false;
            }
        );
    }
}
