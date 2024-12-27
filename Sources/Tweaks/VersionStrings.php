<?php

/**
 * Remove the version string from enqueued css and js
 */

namespace Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Remove the version string from enqueued css and js
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class VersionStrings extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_version_strings';

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
            'title' => __('Version strings', 'pp-wordpress-tweaks'),
            'desc' => __('Remove the WordPress version from the scripts and styles', 'pp-wordpress-tweaks'),
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
        add_filter(
            hook_name: 'style_loader_src',
            callback: [$this, 'removeVersionStrings'],
            priority: 9999
        );
        add_filter(
            hook_name: 'script_loader_src',
            callback: [$this, 'removeVersionStrings'],
            priority: 9999
        );
    }

    /**
     * Removing the version string from any enqueued css and js source
     *
     * @param string $src the css or js source
     * @return string
     * @access public
     */
    public function removeVersionStrings(string $src): string {
        if (strpos(haystack: $src, needle: 'ver=')) {
            $src = remove_query_arg(key: 'ver', query: $src);
        }

        return $src;
    }
}
