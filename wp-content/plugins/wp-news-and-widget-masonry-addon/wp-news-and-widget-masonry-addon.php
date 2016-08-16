<?php
/*
Plugin Name: WP News and Widget - Masonry Layout
Plugin URL: http://www.wponlinesupport.com/
Text Domain: sp-news-and-widget
Domain Path: /languages/
Description: WP News and Widget - Masonry Layout is the addon of WP News and Scrolling Widgets plugin and it works with both the free and PRO plugin. Convert News to masonry layout with Ajax load more and with various shortcode parameters.
Version: 1.0.1
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
if( !defined( 'WPNWM_VERSION' ) ) {
    define( 'WPNWM_VERSION', '1.0.1' ); // Version of plugin
}
if( !defined( 'WPNWM_DIR' ) ) {
    define( 'WPNWM_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPNWM_URL' ) ) {
    define( 'WPNWM_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPNWM_POST_TYPE' ) ) {
    define( 'WPNWM_POST_TYPE', 'news' ); // Plugin post type
}
if( !defined( 'WPNWM_CAT' ) ) {
    define( 'WPNWM_CAT', 'news-category' ); // Plugin category name
}
if( !defined( 'WPNWM_PLUGIN_BASENAME' ) ) {
    define( 'WPNWM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Check WP News and Widget Plugin active
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_check_activation() {
	
	if ( !wpnwm_plugins_active() ) {
		// is this plugin active?
		if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
			// deactivate the plugin
	 		deactivate_plugins( plugin_basename( __FILE__ ) );
	 		// unset activation notice
	 		unset( $_GET[ 'activate' ] );
	 		// display notice
	 		add_action( 'admin_notices', 'wpnwm_admin_notices' );
		}
	}
}

// Check required plugin is activated or not
add_action( 'admin_init', 'wpnwm_check_activation' );

/**
 * Admin notices
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_admin_notices() {
	
	if ( !wpnwm_plugins_active() ) {
		echo '<div class="error notice is-dismissible">';
		echo sprintf( __('<p><strong>%s</strong> recommends the following plugin to use.</p>', 'sp-news-and-widget'), 'WP News and Widget - Masonry Layout' );
		echo sprintf( __('<p><strong><a href="%s" target="_blank">%s</a> </strong> OR <strong><a href="%s" target="_blank">%s</a></strong></p>', 'sp-news-and-widget'), 'https://wordpress.org/plugins/sp-news-and-widget/', 'WP News and Scrolling Widgets (Free)', 'http://wponlinesupport.com/wp-plugin/sp-news-and-scrolling-widgets/', 'WP News and Five Widgets Pro' );
		echo '</div>';
	}
}

/***** Updater Code Starts *****/
define( 'EDD_WPNWM_STORE_URL', 'http://wponlinesupport.com' );
define( 'EDD_WPNWM_ITEM_NAME', 'WP News and Widget - Masonry Layout' );

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnwm_edd_sl_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_wpnwm_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_WPNWM_STORE_URL, __FILE__, array(
            'version' 	=> WPNWM_VERSION,		// current version number
            'license' 	=> $license_key,        // license key (used get_option above to retrieve from DB)
            'item_name' => EDD_WPNWM_ITEM_NAME, // name of this plugin
            'author' 	=> 'WP Online Support'  // author of this plugin
		)
	);
}
add_action( 'admin_init', 'wpnwm_edd_sl_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wpnwm-plugin-license.php' );
/***** Updater Code Ends *****/

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpnwm_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_install() {
}

/**
 * Load the plugin after the main plugin is loaded.
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_load_plugin() {

	// Check main plugin is active or not
	if( wpnwm_plugins_active() ) {

		/**
		 * Load Text Domain
		 * This gets the plugin ready for translation
		 * 
		 * @package WP News and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		load_plugin_textdomain( 'sp-news-and-widget', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );

		/**
		 * Deactivation Hook
		 * 
		 * Register plugin deactivation hook.
		 * 
		 * @package WP News and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		register_deactivation_hook( __FILE__, 'wpnwm_uninstall');

		/**
		 * Plugin Setup (On Deactivation)
		 * 
		 * Delete  plugin options.
		 * 
		 * @package WP News and Widget - Masonry Layout
		 * @since 1.0.0
		 */
		function wpnwm_uninstall() {
			// Uninstall functionality
		}

		global $wpnwm_model, $wpnwm_in_shrtcode;

		// Functions file
		require_once( WPNWM_DIR . '/includes/wpnwm-functions.php' );

		// Model Class
		require_once( WPNWM_DIR . '/includes/class-wpnwm-model.php' );

		// Script Class
		require_once( WPNWM_DIR . '/includes/class-wpnwm-scripts.php' );

		// Admin Class
		require_once( WPNWM_DIR . '/includes/admin/class-wpnwm-admin.php' );

		// Shortcode Class
		require_once( WPNWM_DIR . '/includes/class-wpnwm-shortcode.php' );

		// Public Class
		require_once( WPNWM_DIR . '/includes/class-wpnwm-public.php' );

		// Design file
		include_once( WPNWM_DIR . '/includes/admin/wpnwm-designs.php' );

	} // Check plugin active
}

// Action to load plugin after the main plugin is loaded
add_action('plugins_loaded', 'wpnwm_load_plugin', 15);

/**
 * Check Required Plugin is active or not
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_plugins_active( $pro = false ) {

	// Must needed for front end
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if( $pro && is_plugin_active('wp-news-and-widget-pro/sp-news-and-widget.php') ) {
		
		return true;

	} elseif( $pro == false ) {

		if( is_plugin_active('wp-news-and-widget-pro/sp-news-and-widget.php') ) {
			return true;
		} elseif ( is_plugin_active('sp-news-and-widget/sp-news-and-widget.php') ) {
			return true;
		}
	}

	return false;
}