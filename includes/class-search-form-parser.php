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

	protected $search_form = null;

	protected $form_dom = null;

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

	private function get_search_form() {
		$this->search_form = get_search_form( false );
	}

	private function setup_search_dom() {
		if ( null === $this->search_form ) {
			$this->get_search_form();
		}

		$this->form_dom = new DOMDocument();
		$this->form_dom->loadHTML( $this->search_form );
	}

	public function get_form_selector() {
		if ( null === $this->form_dom ) {
			$this->setup_search_dom();
		}

		$forms = $this->form_dom->getElementsByTagName("form");
	}
}
