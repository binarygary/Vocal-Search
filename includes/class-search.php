<?php
/**
 * Vocal Search Search.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */

/**
 * Vocal Search Search.
 *
 * @since 0.1.0
 */
class VS_Search {
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
		add_action( 'wp_enqueue_scripts', [ $this, 'eq_scripts' ] );
	}

	public function eq_scripts() {
		wp_enqueue_script( 'annyang', $this->plugin->url . 'assets/js/annyang.js', array() );
		wp_enqueue_script( 'vocal-search', $this->plugin->url . 'assets/js/components/main.js', array( 'jquery' ) );
	}
}
