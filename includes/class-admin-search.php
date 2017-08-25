<?php
/**
 * Vocal Search Admin Search.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */



/**
 * Vocal Search Admin Search class.
 *
 * @since 0.1.0
 */
class VS_Admin_Search {
	/**
	 * Parent plugin class.
	 *
	 * @var    Vocal_Search
	 * @since  0.1.0
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected static $key = 'vocal_search_admin_search';

	/**
	 * Options page metabox ID.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected static $metabox_id = 'vocal_search_admin_search_metabox';

	/**
	 * Options Page title.
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $title = '';

	/**
	 * Options Page hook.
	 *
	 * @var string
	 */
	protected $options_page = '';

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

		// Set our title.
		$this->title = esc_attr__( 'Vocal Search Admin Search', 'vocal-search' );
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.1.0
	 */
	public function hooks() {

		// Hook in our actions to the admin.
		
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  0.1.0
	 */
	public function add_options_page_metabox() {

		// Add our CMB2 metabox.
		$cmb = new_cmb2_box( array(
			'id'           => self::$metabox_id,
			'title'        => $this->title,
			'object_types' => array( 'options-page' ),

			/*
			 * The following parameters are specific to the options-page box
			 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
			 */

			'option_key'   => self::$key, // The option key and admin menu page slug.
			// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
			// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
			'parent_slug'        => 'null', // Make options page a submenu item of the themes menu.
			// 'capability'      => 'manage_options', // Cap required to view options-page.
			// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			'display_cb'         => array( $this, 'search_results' ), // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		) );

	}

	public function search_results() {
		echo '<h2>Search Results</h2>';

		$posts = $this->get_posts();

		while ( $posts->have_posts() ) {
			$posts->the_post();
			the_title();
			the_date();
			the_author_posts_link();
			echo get_post_status( get_the_ID() );
			echo get_post_type( get_the_ID() );
			the_content();
		}

		wp_reset_postdata();

	}

	private function get_posts() {
		$args = array(
			'post_type'      => $this->get_post_types(),
			's'              => $_GET['s'],
			'post_status'    => $this->get_post_stati(),
			'posts_per_page' => 100,
		);

		$posts = new WP_Query( $args );
		return $posts;
	}

	private function get_post_types() {
		$post_types = get_post_types( array(), 'names' );

		return array_keys( $post_types );
	}

	private function get_post_stati() {
		$post_stati = get_post_stati();

		return array_keys( $post_stati );
	}
}
