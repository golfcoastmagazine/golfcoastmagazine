<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnwm_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnwm_pro_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnwm_pro_front_script'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP News and Widget - Masonry Layout
 	 * @since 1.0
	 */
	function wpnwm_pro_front_style() {
		
		// Registring public style
		wp_register_style( 'wpnwm-public-style', WPNWM_URL.'assets/css/wpnwm-public-style.css', null, WPNWM_VERSION );
		wp_enqueue_style('wpnwm-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP News and Widget - Masonry Layout
 	 * @since 1.0
	 */
	function wpnwm_pro_front_script() {
		
		// Registring public style
		wp_register_script( 'wpnwm-public-script', WPNWM_URL.'assets/js/wpnwm-public-script.js', array('jquery'), WPNWM_VERSION, true );
		wp_localize_script( 'wpnwm-public-script', 'Wpnwm', array(
																	'ajaxurl' 		=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																	'no_post_msg'	=> __('Sorry, No more post to display.', 'sp-news-and-widget')
																));
	}
}

$wpnwm_script = new Wpnwm_Script();