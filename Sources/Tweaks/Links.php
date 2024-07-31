<?php

/**
 * Remove some link definitions link from head
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use WordPress\Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Remove some link definitions link from `<head>`
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 */
class Links extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_links';

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
            'title' => __('Meta links tags', 'pp-wordpress-tweaks'),
            'desc' => __(
                'Remove some definitions from the `<head>` section, like XMLRPC header, RSS feeds and WLW Manifests',
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
        /**
         * Removing `<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />`
         *
         * @see https://developer.wordpress.org/reference/functions/rsd_link/
         */
        remove_action(hook_name: 'wp_head', callback: 'rsd_link');

        /**
         * Removing relational next/prev links
         *
         * @see https://developer.wordpress.org/reference/functions/adjacent_posts_rel_link/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'adjacent_posts_rel_link',
            priority: 10
        );
        remove_action(
            hook_name: 'wp_head',
            callback: 'adjacent_posts_rel_link_wp_head',
            priority: 10
        );

        /**
         * Removing short link
         *
         * @see https://developer.wordpress.org/reference/functions/wp_shortlink_wp_head/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'wp_shortlink_wp_head',
            priority: 10
        );

        /**
         * Removing RSS feeds
         *
         * @see https://developer.wordpress.org/reference/functions/feed_links/
         */
        remove_action(hook_name: 'wp_head', callback: 'feed_links', priority: 2);
        remove_action(hook_name: 'wp_head', callback: 'feed_links_extra', priority: 3);

        /**
         * Removing `<link rel='https://api.w.org/' href='http://link.net/wp-json/' />`
         *
         * @see https://developer.wordpress.org/reference/functions/rest_output_link_wp_head/
         */
        remove_action(
            hook_name: 'wp_head',
            callback: 'rest_output_link_wp_head',
            priority: 10
        );
        remove_action(
            hook_name: 'template_redirect',
            callback: 'rest_output_link_header',
            priority: 11
        );

        /**
         * Removing `<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />`
         *
         * @see https://developer.wordpress.org/reference/functions/wlwmanifest_link/
         */
        remove_action(hook_name: 'wp_head', callback: 'wlwmanifest_link');
    }
}
