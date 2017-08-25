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
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_eq_scripts' ] );
	}

	public function eq_scripts() {
		if ( ! $this->plugin->settings->get_setting( 'make_public' ) ) {
			return;
		}

		wp_enqueue_script( 'annyang', $this->plugin->url . 'assets/js/annyang.js', array() );
		wp_enqueue_script( 'vocal-search', $this->plugin->url . 'assets/js/components/main.js', array( 'jquery' ) );
		wp_localize_script( 'vocal-search', 'vsSettings', $this->get_settings( 'frontend' ) );
	}

	public function admin_eq_scripts() {
		wp_enqueue_script( 'annyang', $this->plugin->url . 'assets/js/annyang.js', array() );
		wp_enqueue_script( 'vocal-search', $this->plugin->url . 'assets/js/components/main.js', array( 'jquery' ) );
		wp_localize_script( 'vocal-search', 'vsSettings', $this->get_settings( 'backend' ) );
	}

	private function get_settings( $where = 'backend' ) {
		if ( 'backend' !== $where ) {
			return array(
				'search_field' => $this->plugin->settings->get_setting( 'input' ),
				'search_form' => $this->plugin->settings->get_setting( 'form' ),
				'command' => $this->plugin->settings->get_setting( 'phrase' ),
				'backend' => false,
			);
		}

		return array(
			'search_field' => '.vocal-search-input',
			'search_form' => '#vocal-search',
			'command' => $this->plugin->settings->get_setting( 'phrase' ),
			'backend' => true,
			'admin_commands' => $this->plugin->parse_menu->eq_commands(),
		);
	}
}
