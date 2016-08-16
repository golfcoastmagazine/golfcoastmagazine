<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbawm_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpbawm_pro_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpbawm_pro_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Blog and Widget - Masonry Layout
 	 * @since 1.0
	 */
	function wpbawm_pro_front_style() {
		
		// Registring public style
		wp_register_style( 'wpbawm-public-style', WPBAWM_URL.'assets/css/wpbawm-public-style.css', null, WPBAWM_VERSION );
		wp_enqueue_style('wpbawm-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Blog and Widget - Masonry Layout
 	 * @since 1.0
	 */
	function wpbawm_pro_front_script() {
		
		// Registring public style
		wp_register_script( 'wpbawm-public-script', WPBAWM_URL.'assets/js/wpbawm-public-script.js', array('jquery'), WPBAWM_VERSION, true );
		wp_localize_script( 'wpbawm-public-script', 'Wpbawm', array( 
																	'ajaxurl' 		=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																	'no_post_msg'	=> __('Sorry, No more post to display.', 'wp-blog-and-widgets')
																));
	}
}

$wpbawm_script = new Wpbawm_Script();