<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbaw_Pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpbaw_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpbaw_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpbaw_pro_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpbaw_pro_admin_script') );
	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_front_style() {

		// Registring and enqueing public css
		wp_register_style( 'wpbaw-pro-public-style', WPBAW_PRO_URL.'assets/css/blog-pro-style.css', array(), WPBAW_PRO_VERSION );
		wp_enqueue_style( 'wpbaw-pro-public-style' );

		// Registring and enqueing slick slider css
		wp_register_style( 'wpbaw-pro-slick', WPBAW_PRO_URL.'assets/css/slick.css', array(), WPBAW_PRO_VERSION );
		wp_enqueue_style( 'wpbaw-pro-slick' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPBAW_PRO_URL.'assets/js/slick.min.js', array('jquery'), WPBAW_PRO_VERSION, true );
			wp_enqueue_script( 'wpos-slick-jquery' );
		}
		
		// Registring news ticker script
		if( !wp_script_is( 'wpos-vticker-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-vticker-jquery', WPBAW_PRO_URL.'assets/js/jquery.blogtape.js', array('jquery'), WPBAW_PRO_VERSION, true );
			wp_enqueue_script( 'wpos-vticker-jquery' );
		}
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_admin_style( $hook ) {

		// Pages array
		$pages_array = array( 'blog_post_page_wpbaw-pro-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_style( 'wpbaw-pro-admin-css', WPBAW_PRO_URL.'assets/css/wpbaw-pro-admin.css', null, WPBAW_PRO_VERSION );
			wp_enqueue_style( 'wpbaw-pro-admin-css' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Pages array
		$pages_array = array( 'blog_post_page_wpbaw-pro-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wpbaw-pro-admin-js', WPBAW_PRO_URL.'assets/js/wpbaw-pro-admin.js', array('jquery'), WPBAW_PRO_VERSION, true );
			wp_localize_script( 'wpbaw-pro-admin-js', 'WpbawProAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wpbaw-pro-admin-js' );
			wp_enqueue_media(); // For media uploader
		}

		// Product sorting - only when sorting by menu order on the blog listing page
	    if ( $post_type == WPBAW_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wpbaw-pro-ordering', WPBAW_PRO_URL . 'assets/js/wpbaw-pro-ordering.js', array( 'jquery-ui-sortable' ), WPBAW_PRO_VERSION, true );
	        wp_enqueue_script( 'wpbaw-pro-ordering' );
	    }
	}
}

$wpbaw_pro_script = new Wpbaw_Pro_Script();