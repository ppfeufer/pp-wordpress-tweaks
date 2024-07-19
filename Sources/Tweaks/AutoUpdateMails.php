<?php

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweaksInterface;

class AutoUpdateMails implements TweaksInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        $this->execute();
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
