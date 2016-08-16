<?php
/*
Plugin Name: WP Blog and Widget - Masonry Layout
Plugin URL: http://www.wponlinesupport.com/
Text Domain: wp-blog-and-widgets
Domain Path: /languages/
Description: WP Blog and Widget - Masonry Layout is the addon of WP Blog and Widgets plugin and it works with both the free and PRO plugin. Convert Blog to masonry layout with Ajax load more and with various shortcode parameters.
Version: 1.0
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
if( !defined( 'WPBAWM_VERSION' ) ) {
    define( 'WPBAWM_VERSION', '1.0' ); // Version of plugin
}
if( !defined( 'WPBAWM_DIR' ) ) {
    define( 'WPBAWM_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPBAWM_URL' ) ) {
    define( 'WPBAWM_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPBAWM_POST_TYPE' ) ) {
    define( 'WPBAWM_POST_TYPE', 'blog_post' ); // Plugin post type
}
if( !defined( 'WPBAWM_CAT' ) ) {
    define( 'WPBAWM_CAT', 'blog-category' ); // Plugin category name
}
if( !defined( 'WPBAWM_PLUGIN_BASENAME' ) ) {
    define( 'WPBAWM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Check WP Blog and Widget Plugin active
 *
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_check_activation() {
	
	if ( !wpbawm_plugins_active() ) {
		// is this plugin active?
		if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
			// deactivate the plugin
	 		deactivate_plugins( plugin_basename( __FILE__ ) );
	 		// unset activation notice
	 		unset( $_GET[ 'activate' ] );
	 		// display notice
	 		add_action( 'admin_notices', 'wpbawm_admin_notices' );
		}
	}
}

// Check required plugin is activated or not
add_action( 'admin_init', 'wpbawm_check_activation' );

/**
 * Admin notices
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_admin_notices() {
	
	if ( !wpbawm_plugins_active() ) {
		echo '<div class="error notice is-dismissible">';
		echo sprintf( __('<p><strong>%s</strong> recommends the following plugin to use.</p>', 'wp-blog-and-widgets'), 'WP Blog and Widget - Masonry Layout' );
		echo sprintf( __('<p><strong><a href="%s" target="_blank">%s</a> </strong> OR <strong><a href="%s" target="_blank">%s</a></strong></p>', 'wp-blog-and-widgets'), 'https://wordpress.org/plugins/wp-blog-and-widgets/', 'WP Blog and Widget (Free)', 'http://wponlinesupport.com/wp-plugin/wp-blog-and-widgets/', 'WP Blog and Widgets' );
		echo '</div>';
	}
}

/***** Updater Code Starts *****/
define( 'EDD_WPBAWM_STORE_URL', 'http://wponlinesupport.com' );
define( 'EDD_WPBAWM_ITEM_NAME', 'WP Blog and Widget - Masonry Layout' );

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_edd_sl_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_wpbawm_license_key' ) );
	
	$edd_updater = new EDD_SL_Plugin_Updater( EDD_WPBAWM_STORE_URL, __FILE__, array(
            'version' 	=> WPBAWM_VERSION,			// current version number
            'license' 	=> $license_key,        	// license key (used get_option above to retrieve from DB)
            'item_name' => EDD_WPBAWM_ITEM_NAME, 	// name of this plugin
            'author' 	=> 'WP Online Support'  	// author of this plugin
		)
	);
}
add_action( 'admin_init', 'wpbawm_edd_sl_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wpbawm-plugin-license.php' );
/***** Updater Code Ends *****/

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpbawm_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_install() {
}

/**
 * Load the plugin after the main plugin is loaded.
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_load_plugin() {

	// Check main plugin is active or not
	if( wpbawm_plugins_active() ) {

		/**
		 * Load Text Domain
		 * This gets the plugin ready for translation
		 * 
		 * @package WP Blog and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		load_plugin_textdomain( 'wp-blog-and-widgets', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );

		/**
		 * Deactivation Hook
		 * 
		 * Register plugin deactivation hook.
		 * 
		 * @package WP Blog and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		register_deactivation_hook( __FILE__, 'wpbawm_uninstall');

		/**
		 * Plugin Setup (On Deactivation)
		 * 
		 * Delete  plugin options.
		 * 
		 * @package WP Blog and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		function wpbawm_uninstall() {
			// Uninstall functionality
		}

		global $wpbawm_model, $wpbawm_in_shrtcode;

		// Functions file
		require_once( WPBAWM_DIR . '/includes/wpbawm-functions.php' );

		// Model Class
		require_once( WPBAWM_DIR . '/includes/class-wpbawm-model.php' );

		// Script Class
		require_once( WPBAWM_DIR . '/includes/class-wpbawm-scripts.php' );

		// Admin Class
		require_once( WPBAWM_DIR . '/includes/admin/class-wpbawm-admin.php' );

		// Shortcode Class
		require_once( WPBAWM_DIR . '/includes/class-wpbawm-shortcode.php' );

		// Public Class
		require_once( WPBAWM_DIR . '/includes/class-wpbawm-public.php' );

		// Design file
		include_once( WPBAWM_DIR . '/includes/admin/wpbawm-designs.php' );
		
	} // Check plugin active
}

// Action to load plugin after the main plugin is loaded
add_action('plugins_loaded', 'wpbawm_load_plugin', 15);

/**
 * Check Required Plugin is active or not
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpbawm_plugins_active( $pro = false ) {

	// Must needed for front end
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if( $pro && is_plugin_active('wp-blog-and-widgets-pro/wp-blog-and-widgets.php') ) {
		
		return true;

	} elseif( $pro == false ) {

		if( is_plugin_active('wp-blog-and-widgets-pro/wp-blog-and-widgets.php') ) {
			return true;
		} elseif ( is_plugin_active('wp-blog-and-widgets/wp-blog-and-widgets.php') ) {
			return true;
		}
	}

	return false;
}