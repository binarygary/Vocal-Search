<?php
/**
 * Vocal Search Parse Menu.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */

/**
 * Vocal Search Parse Menu.
 *
 * @since 0.1.0
 */
class VS_Parse_Menu {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.1.0
	 *
	 * @var   Vocal_Search
	 */
	protected $plugin = null;

	protected $commands = array();

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
		add_action( 'adminmenu', array( $this, 'capture_menu' ) );
	}

	public function capture_menu( $menu ) {
		global $menu;
		global $submenu;
		$commands = array();

		foreach ( $menu as $menu_item ) {
			if ( key( $this->get_commands( $menu_item ) ) ) {
				$commands[ key( $this->get_commands( $menu_item ) ) ] = $this->get_commands( $menu_item )[ key( $this->get_commands( $menu_item ) ) ];
			}
		}

		update_option( 'vocal_search_admin_commands', $commands, true );
	}

	private function get_commands( $menu_item ) {
		$command[ $menu_item[0] ] = $menu_item[2];

		return $command;
	}

	public function eq_commands() {
		return get_option( 'vocal_search_admin_commands' );
	}
}
