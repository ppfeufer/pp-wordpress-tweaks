<?php

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

/**
 * WordPress Tweaks settings
 *
 * @param array $wpsf_settings The settings fields
 *
 * @return array
 */
function wp_tweaks_settings(array $wpsf_settings): array {
    $tweakClasses = Tweaks::getInstance()->getTweakClasses();
    $settingsFields = [];

    foreach ($tweakClasses as $tweakClass) {
        $settingsFields[] = $tweakClass::getInstance()->getSettings();
    }

    $wpsf_settings[] = [
        'section_id' => 'pp-wordpress-tweaks',
        'section_title' => __('Available Tweaks', 'pp-wordpress-tweaks'),
        'section_description' => __(
            'Select which tweaks you want to apply …',
            'pp-wordpress-tweaks'
        ),
        'section_order' => 5,
        'fields' => $settingsFields
    ];

    return $wpsf_settings;
}

// phpcs:disable
add_filter(
    hook_name: 'wpsf_register_settings_pp-wordpress-tweaks',
    callback: 'wp_tweaks_settings'
);
// phpcs:enable
