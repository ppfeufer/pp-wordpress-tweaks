<?php

/**
 * Change the YouTube embed to use the no-cookie domain
 */

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Tweaks;

use WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces\TweakInterface;
use WordPress\Ppfeufer\Plugin\WordPressTweaks\Singletons\GenericSingleton;

/**
 * Change the YouTube embed to use the no-cookie domain
 *
 * @package WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs
 * @access public
 */
class YoutubeEmbed extends GenericSingleton implements TweakInterface {
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
    private const TWEAK_FIELD_ID = 'tweak_youtube_embed';

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
            'title' => __('YouTube embed (no cookie)', 'pp-wordpress-tweaks'),
            'desc' => __('Change the YouTube embed to use the no-cookie domain', 'pp-wordpress-tweaks'),
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
            hook_name: 'embed_oembed_html',
            callback: [$this, 'youtubeNoCookieEmbed'],
            priority: 10,
            accepted_args: 4
        );
    }

    /**
     * Change the YouTube embed to use the no-cookie domain
     *
     * @param string $html The html of the embed
     * @param string $url The url of the embed
     * @param array $attr The attributes of the embed
     * @param int $post_ID The post id
     *
     * @return string
     * @access public
     */
    public function youtubeNoCookieEmbed(
        string $html,
        string $url,
        array $attr,
        int $post_ID
    ): string {
        $returnValue = $html;

        if (preg_match(pattern: '#https?://(www\.)?youtu#i', subject: $url)) {
            $returnValue = preg_replace(
                pattern: '#src=(["\'])(https?:)?//(www\.)?youtube\.com#i',
                replacement: 'src=$1$2//$3youtube-nocookie.com',
                subject: $html
            );
        }

        return $returnValue;
    }
}
