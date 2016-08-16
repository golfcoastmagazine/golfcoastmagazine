<?php
/**
 * Public Class
 *
 * Handles the public side functionality of plugin
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbaw_Pro_Public {
	
	function __construct() {

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpbaw_pro_custom_css'), 20 );
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.5
	 */
	function wpbaw_pro_custom_css() {

		$custom_css = wpbaw_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpbaw_pro_public = new Wpbaw_Pro_Public();