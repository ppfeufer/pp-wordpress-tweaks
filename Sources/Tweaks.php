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
        $tweakClasses = [];
        $files = glob(pattern: PLUGIN_DIR_PATH . 'Sources/Tweaks/*.php');

        foreach ($files as $file) {
            $class = '\\WordPress\\Ppfeufer\\Plugin\\WordPressTweaks\\Tweaks\\' . basename(
                path: $file,
                suffix: '.php'
            );

            if (class_exists(class: $class)) {
                $tweakClasses[] = $class;
            }
        }

        return $tweakClasses;
    }
}
