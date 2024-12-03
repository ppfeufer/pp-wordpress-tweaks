<?php

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces;

/**
 * Tweak interface
 *
 * @package WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces
 */
interface TweakInterface {
    /**
     * Initialize the class
     *
     * @return void
     * @access public
     */
    public function init(): void;

    /**
     * Get the settings
     *
     * @return array
     * @access public
     */
    public function getSettings(): array;

    /**
     * Execute the filters and so on
     *
     * @return void
     * @access public
     */
    public function execute(): void;
}
