<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnwm_Admin {
	
	function __construct() {

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpnwm_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPNWM_PLUGIN_BASENAME, array( $this, 'wpnwm_pro_plugin_action_links' ) );
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPNWM_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://wponlinesupport.com/pro-plugin-document/document-wp-news-and-widget-masonry-add-on/') . '" title="' . esc_attr( __( 'View Documentation', 'sp-news-and-widget' ) ) . '" target="_blank">' . __( 'Docs', 'sp-news-and-widget' ) . '</a>',
				'support' => '<a href="' . esc_url('http://wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'sp-news-and-widget' ) ) . '" target="_blank">' . __( 'Support', 'sp-news-and-widget' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_pro_plugin_action_links( $links ) {

		$license_url = add_query_arg( array('page' => 'wpnwm-license'), admin_url('plugins.php') );

		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'sp-news-and-widget' ) ) . '">' . __( 'License', 'sp-news-and-widget' ) . '</a>';

		return $links;
	}
}

$wpnwm_admin = new Wpnwm_Admin();