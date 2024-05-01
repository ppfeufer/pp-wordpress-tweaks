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
        add_filter(hook_name: 'auto_core_update_send_email', callback: '__return_false');
        add_filter(hook_name: 'send_core_update_notification_email', callback: '__return_false');
        add_filter(hook_name: 'auto_theme_update_send_email', callback: '__return_false');
    }
}
