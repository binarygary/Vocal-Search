<?php
/**
 * Vocal Search Admin Search Input.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */

/**
 * Vocal Search Admin Search Input.
 *
 * @since 0.1.0
 */
class VS_Admin_Search_Input {
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
		add_action( 'admin_bar_menu', array( $this, 'add_input' ), PHP_INT_MAX );
	}

	public function add_input( $wp_admin_bar ) {
		$args = array(
			'id'    => 'vocal_search_input',
			'title'  => $this->get_input_markup(),
		);
		$wp_admin_bar->add_node( $args );
	}

	private function get_input_markup() {
		return '<form id="vocal-search" action="admin.php">
					<input name="s">
					<input name="page" value="vocal_search_admin_search" type="hidden">
				</form>';
	}
}
