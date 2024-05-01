<?php

namespace WordPress\Ppfeufer\Plugin\WordPressTweaks\Interfaces;

interface TweaksInterface {
    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct();

    /**
     * Initialize the filters for the tweak
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function execute(): void;
}
