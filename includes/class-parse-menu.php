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
			$commands[] = $this->get_commands( $menu_item );
		}

		//sleep( 4 );
	}

	public function get_commands( $menu_item ) {
		$command[ $menu_item[0] ] = $menu_item[2];

		return $command;
	}
}
