<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Pro_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnw_pro_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnw_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpnw_pro_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpnw_pro_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP News and Five Widgets Pro
 	 * @since 1.1.5
	 */
	function wpnw_pro_front_style() {
		
		// Registring public style
		wp_register_style( 'wpnw-public-style', WPNW_PRO_URL.'assets/css/news-pro-style.css', null, WPNW_PRO_VERSION );
		wp_enqueue_style('wpnw-public-style');
		
		// Registring slick slider style
		wp_register_style( 'wpnw-slick-style', WPNW_PRO_URL.'assets/css/slick.css', null, WPNW_PRO_VERSION );
		wp_enqueue_style('wpnw-slick-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP News and Five Widgets Pro
 	 * @since 1.1.5
	 */
	function wpnw_pro_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPNW_PRO_URL . 'assets/js/slick.min.js', array('jquery'), WPNW_PRO_VERSION, true );
			wp_enqueue_script( 'wpos-slick-jquery' );
		}
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-vticker-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-vticker-jquery', WPNW_PRO_URL . 'assets/js/jquery.newstape.js', array('jquery'), WPNW_PRO_VERSION, true );
			wp_enqueue_script( 'wpos-vticker-jquery' );
		}
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_admin_style( $hook ) {
		
		// Pages array
		$pages_array = array( 'news_page_wpnw-pro-settings' );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_style( 'wpnw-pro-admin-css', WPNW_PRO_URL.'assets/css/wpnw-pro-admin.css', null, WPNW_PRO_VERSION );
			wp_enqueue_style( 'wpnw-pro-admin-css' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		// Pages array
		$pages_array = array( 'news_page_wpnw-pro-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wpnw-pro-admin-js', WPNW_PRO_URL.'assets/js/wpnw-pro-admin.js', array('jquery'), WPNW_PRO_VERSION, true );
			wp_localize_script( 'wpnw-pro-admin-js', 'WpnwProAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wpnw-pro-admin-js' );
			wp_enqueue_media(); // For media uploader
		}

		// Sorting - only when sorting by menu order on the news listing page
	    if ( $post_type == WPNW_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wpnw-pro-ordering', WPNW_PRO_URL . 'assets/js/wpnw-pro-ordering.js', array( 'jquery-ui-sortable' ), WPNW_PRO_VERSION, true );
	        wp_enqueue_script( 'wpnw-pro-ordering' );
	    }
	}
}

$wpnw_pro_script = new Wpnw_Pro_Script();