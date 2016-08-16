<?php
/**
 * Public Class
 * 
 * Handles the front side functionality of plugin
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Pro_Public {
	
	function __construct() {
	
		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpnw_pro_custom_css'), 20 );

		// Filter to set tag in query
		add_filter( 'pre_get_posts', array($this, 'wpnw_pro_news_display_tags') );
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_custom_css() {

		$custom_css = wpnw_pro_get_option('custom_css');

		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
	
	/**
	 * Set `post_tag` to main query.
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.0.0
	 */
	function wpnw_pro_news_display_tags( $query ) {

		if( is_tag() && $query->is_main_query() ) {
			$post_types = array( 'post', 'news' );
			$query->set( 'post_type', $post_types );
		}
	}

}

$wpnw_pro_public = new Wpnw_Pro_Public();