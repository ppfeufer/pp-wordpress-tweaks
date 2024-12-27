<?php

use Ppfeufer\Plugin\WordPressTweaks\Tweaks;

/**
 * WordPress Tweaks settings
 *
 * @param array $wpsfSettings The settings fields
 *
 * @return array
 */
function wp_tweaks_settings(array $wpsfSettings): array {
    $settingsFields = array_map(
        static fn($tweakClass) => $tweakClass::getInstance()->getSettings(),
        Tweaks::getInstance()->getTweakClasses()
    );

    $wpsfSettings[] = [
        'section_id' => 'pp-wordpress-tweaks',
        'section_title' => __('Available Tweaks', 'pp-wordpress-tweaks'),
        'section_description' => __(
            'Select which tweaks you want to apply …',
            'pp-wordpress-tweaks'
        ),
        'section_order' => 5,
        'fields' => $settingsFields
    ];

    return $wpsfSettings;
}

// phpcs:disable
add_filter(
    hook_name: 'wpsf_register_settings_pp-wordpress-tweaks',
    callback: 'wp_tweaks_settings'
);
// phpcs:enable
