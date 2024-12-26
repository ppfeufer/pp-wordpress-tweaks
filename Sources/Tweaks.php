<?php

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Tweaks
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity
 */
class Tweaks extends GenericSingleton {
    /**
     * Get the tweak classes
     *
     * @return array
     * @access public
     */
    public function getTweakClasses(): array {
        return array_filter(
            array_map(
                static fn($file) => '\\WordPress\\Ppfeufer\\Plugin\\WordPressTweaks\\Tweaks\\' . basename(path: $file, suffix: '.php'),
                glob(pattern: PLUGIN_DIR_PATH . 'Sources/Tweaks/*.php')
            ),
            static fn($class) => class_exists(class: $class)
        );
    }
}
