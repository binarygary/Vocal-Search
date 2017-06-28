<?php
/**
 * Vocal Search Search Form Parser.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */

/**
 * Vocal Search Search Form Parser.
 *
 * @since 0.1.0
 */
class VS_Search_Form_Parser {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.1.0
	 *
	 * @var   Vocal_Search
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.1.0
	 *
	 * @param  Vocal_Search $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.1.0
	 */
	public function hooks() {

	}
}
