<?php
/*
Plugin Name: WP Blog and Widgets Pro
Plugin URL: http://www.wponlinesupport.com/
Description: Display Blog on your website with PRO designs.
Version: 1.1.8
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/

if( !defined( 'WPBAW_PRO_VERSION' ) ) {
    define( 'WPBAW_PRO_VERSION', '1.1.8' ); // Version of plugin
}
if( !defined( 'WPBAW_PRO_DIR' ) ) {
    define( 'WPBAW_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPBAW_PRO_URL' ) ) {
    define( 'WPBAW_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPBAW_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WPBAW_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPBAW_PRO_POST_TYPE' ) ) {
    define( 'WPBAW_PRO_POST_TYPE', 'blog_post' ); // Plugin post type
}
if( !defined( 'WPBAW_PRO_CAT' ) ) {
    define( 'WPBAW_PRO_CAT', 'blog-category' ); // Plugin category name
}
if( !defined( 'WPBAW_META_PREFIX' ) ) {
    define( 'WPBAW_META_PREFIX', '_wpbaw_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
add_action('plugins_loaded', 'wpbaw_pro_blog_load_textdomain');
function wpbaw_pro_blog_load_textdomain() {
    load_plugin_textdomain( 'wp-blog-and-widgets', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpbaw_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpbaw_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function wpbaw_pro_install() {  
    
    wpbaw_pro_register_post_type();
    wpbaw_pro_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Get settings for the plugin
    $wpbaw_pro_options = get_option( 'wpbaw_pro_options' );
    
    if( empty( $wpbaw_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpbaw_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wpbaw_pro_plugin_version', '1.0' );
    }

    if( is_plugin_active('wp-blog-and-widgets/wp-blog-and-widgets.php') ) {
        add_action('update_option_active_plugins', 'proBlog_deactivate_premium_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function wpbaw_pro_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function proBlog_deactivate_premium_version() {
    deactivate_plugins('wp-blog-and-widgets/wp-blog-and-widgets.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function proBlog_rpfs_admin_notice() {

    $dir = ABSPATH . 'wp-content/plugins/wp-blog-and-widgets/wp-blog-and-widgets.php';

    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'wp-blog-and-widgets-pro/wp-blog-and-widgets.php' ) && file_exists($dir) ) {

        global $pagenow;

        if( $pagenow == 'plugins.php' ) {
            if ( current_user_can( 'install_plugins' ) ) {
                echo '<div id="message" class="updated notice is-dismissible">
                        <p><strong>'.__('Thank you for activating  WP Blog and Widget Pro', 'wp-blog-and-widgets').'</strong><br />
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-blog-and-widgets'), '<strong>(WP Blog and Widget)</strong>' ).'
                        </p>
                     </div>';
            }
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'proBlog_rpfs_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_BLOG_STORE_URL', 'http://wponlinesupport.com' );
define( 'EDD_BLOG_ITEM_NAME', 'WP Blog and Widgets Pro' ); 

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function edd_sl_blog_plugin_updater() {
    
    $license_key = trim( get_option( 'edd_blog_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_BLOG_STORE_URL, __FILE__, array(
            'version'   => WPBAW_PRO_VERSION,   // current version number
            'license'   => $license_key,        // license key (used get_option above to retrieve from DB)
            'item_name' => EDD_BLOG_ITEM_NAME,  // name of this plugin
            'author'    => 'WP Online Support'  // author of this plugin
        ));
}
add_action( 'admin_init', 'edd_sl_blog_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/edd-blog-plugin.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $wpbaw_pro_options;

// Functions file
require_once( WPBAW_PRO_DIR . '/includes/wpbaw-functions.php' );
$wpbaw_pro_options = wpbaw_pro_get_settings();

// Plugin Post type file
require_once( WPBAW_PRO_DIR . '/includes/wpbaw-post-types.php' );

// Script Class
require_once( WPBAW_PRO_DIR . '/includes/class-wpbaw-script.php' );

// Widget Class
require_once( WPBAW_PRO_DIR . '/includes/widgets/class-wpbaw-widget.php' );
require_once( WPBAW_PRO_DIR . '/includes/widgets/class-wpbaw-cat-widget.php' );

// Admin Class
require_once( WPBAW_PRO_DIR . '/includes/admin/class-wpbaw-admin.php' );

// Plugin design file
require_once( WPBAW_PRO_DIR . '/includes/wpbaw-pro-plugin-designs.php' );

// Public Class
require_once( WPBAW_PRO_DIR . '/includes/class-wpbaw-public.php' );

// Shortcode files
require_once( WPBAW_PRO_DIR . '/includes/shortcode/wpbaw-blog-shortcode.php' );
require_once( WPBAW_PRO_DIR . '/includes/shortcode/wpbaw-recent-blog.php' );
require_once( WPBAW_PRO_DIR . '/includes/shortcode/wpbaw-recent-blog-slider.php' );