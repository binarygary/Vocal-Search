<?php
/**
 * Vocal Search Setup.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */

/**
 * Vocal Search Setup.
 *
 * @since 0.1.0
 */
class VS_Setup {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.1.0
	 *
	 * @var   Vocal_Search
	 */
	protected $plugin = null;

	protected $settings = null;

	protected $phrase = null;

	protected $form_selector = null;

	protected $input_selector = null;

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
		add_action( 'init', [ $this, 'setup_vocal_search_params' ] );
	}

	public function setup_vocal_search_params() {
		$this->settings = get_option( 'vocal_search_settings' );

		$this->phrase         = $this->setup_phrase();
		$this->form_selector  = $this->setup_form_selector();
		$this->input_selector = $this->setup_input_selector();

//		update_option( 'vocal_search_settings', array(
//			''
//		));
	}

	protected function setup_phrase() {
		if ( isset( $this->settings['phrase'] ) && ! empty( $this->settings ) ) {
			return $this->settings['phrase'];
		}

		return __( 'Search for', 'vocal-search' );

	}

	protected function setup_form_selector() {
		if ( isset( $this->settings['form'] ) && ! empty( $this->settings['form'] ) ) {
			return $this->settings['form'];
		}

		return $this->plugin->search_form_parser->get_form_selector();
	}

	protected function setup_input_selector() {
		if ( isset( $this->settings['input'] ) && ! empty( $this->settings['input'] ) ) {
			return $this->settings['input'];
		}

		return $this->plugin->search_form_parser->get_form_selector();
	}
}
