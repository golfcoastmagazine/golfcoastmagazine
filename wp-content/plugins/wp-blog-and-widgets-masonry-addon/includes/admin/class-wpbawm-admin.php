<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbawm_Admin {
	
	function __construct() {

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpbawm_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPBAWM_PLUGIN_BASENAME, array( $this, 'wpbawm_pro_plugin_action_links' ) );
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP Blog and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpbawm_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPBAWM_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://wponlinesupport.com/pro-plugin-document/document-wp-blog-and-widget-masonry-add-on/') . '" title="' . esc_attr( __( 'View Documentation', 'wp-blog-and-widgets' ) ) . '" target="_blank">' . __( 'Docs', 'wp-blog-and-widgets' ) . '</a>',
				'support' => '<a href="' . esc_url('http://wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'wp-blog-and-widgets' ) ) . '" target="_blank">' . __( 'Support', 'wp-blog-and-widgets' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package WP Blog and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpbawm_pro_plugin_action_links( $links ) {

		$license_url = add_query_arg( array('page' => 'wpbawm-license'), admin_url('plugins.php') );

		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'wp-blog-and-widgets' ) ) . '">' . __( 'License', 'wp-blog-and-widgets' ) . '</a>';

		return $links;
	}
}

$wpbawm_admin = new Wpbawm_Admin();