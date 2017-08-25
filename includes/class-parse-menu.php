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

		$submenu_commands = array();

		foreach ( $submenu as $parent => $submenu_item ) {
			$submenu_commands = array_merge( $submenu_commands, $this->get_submenu_commands( $parent, $submenu_item, $commands ) );
		}

		$cleansed_commands = array();
		foreach ( array_merge( $commands, $submenu_commands ) as $command => $url ) {
			$command_array = explode( '<span', $command );
			$cleansed_commands[ trim( $command_array[0] ) ] = $url;
		}
		$commands = $cleansed_commands;

		update_option( 'vocal_search_admin_commands', $commands, true );
	}

	private function get_submenu_commands( $parent, $submenu, $commands ) {

		$new_commands = array();

		foreach ( $submenu as $item ) {
			if ( in_array( $parent, $commands ) ) {
				if ( 'Add New' == $item[0] ) {
					$parent_menu_item = array_search( $parent, $commands );
					$item[0] = $item[0] . ' ' . rtrim( $parent_menu_item, 's' );
				}

				if ( strpos( $item[2], 'php' ) == false ) {
					$item[2] = 'admin.php?page=' . $item[2];
				}

				$new_commands[ $item[0] ] = $item[2];
			}
		}

		return $new_commands;
	}

	private function get_commands( $menu_item ) {
		$command[ $menu_item[0] ] = $menu_item[2];

		return $command;
	}

	public function eq_commands() {
		return get_option( 'vocal_search_admin_commands' );
	}
}
