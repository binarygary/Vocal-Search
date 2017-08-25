<?php
/**
 * Vocal Search Admin Search Input Tests.
 *
 * @since   0.1.0
 * @package Vocal_Search
 */
class VS_Admin_Search_Input_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.1.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'VS_Admin_Search_Input' ) );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.1.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( 'VS_Admin_Search_Input', vocal_search()->admin_search_input );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.1.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
