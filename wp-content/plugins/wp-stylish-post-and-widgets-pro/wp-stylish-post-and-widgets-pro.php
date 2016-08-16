<?php
/*
Plugin Name: WP Stylist Post and Widgets Pro
Plugin URL: http://www.wponlinesupport.com/
Description: Display Post on your website with PRO designs.
Version: 1.0.2
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/

if( !defined( 'WPSPW_PRO_VERSION' ) ) {
    define( 'WPSPW_PRO_VERSION', '1.0.2' ); // Version of plugin
}
if( !defined('WPSPW_POST_TYPE') ){
    define('WPSPW_POST_TYPE', 'post'); // Post type name
}
if( !defined('WPSPW_CAT') ){
    define('WPSPW_CAT', 'category'); // Plugin category name
}

register_activation_hook( __FILE__, 'wpspw_blog_rewrite_flush' );
function wpspw_blog_rewrite_flush(){
}

define( 'EDD_SPOST_STORE_URL', 'http://wponlinesupport.com' );
define( 'EDD_SPOST_ITEM_NAME', 'WP Stylist Post and Widgets Pro' ); 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

function wpspw_pro_edd_sl_post_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_wpspwpost_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_SPOST_STORE_URL, __FILE__, array(
			'version' 	=> WPSPW_PRO_VERSION, 	// current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => EDD_SPOST_ITEM_NAME, // name of this plugin
			'author' 	=> 'WP Online Support'  // author of this plugin
		)
	);

}
add_action( 'admin_init', 'wpspw_pro_edd_sl_post_plugin_updater', 0 );

include( dirname( __FILE__ ) . '/edd-wpspw-post-plugin.php' );

add_action('plugins_loaded', 'wpspw_load_textdomain');
function wpspw_load_textdomain() {
    load_plugin_textdomain( 'wpspw-post-and-widgets', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

add_action( 'wp_enqueue_scripts','wpspw_post_css_script' );
function wpspw_post_css_script() {
    wp_enqueue_style( 'wpspw-pro-style', plugin_dir_url( __FILE__ ). 'pro/css/wpspw-pro-style.css', null, WPSPW_PRO_VERSION );
    wp_enqueue_style( 'wpspw-pro-slick',  plugin_dir_url( __FILE__ ). 'pro/css/slick.css', null, WPSPW_PRO_VERSION );		 	
    wp_enqueue_script( 'wpspw-slickjs', plugin_dir_url( __FILE__ ) . 'pro/js/slick.min.js', array('jquery'), WPSPW_PRO_VERSION );
    wp_enqueue_script( 'wpspw-vticker', plugin_dir_url( __FILE__ ) . 'pro/js/jquery.blogtape.js', array('jquery'), WPSPW_PRO_VERSION );
}

require_once( 'pro/pro_blogShortcode.php' );
require_once( 'pro/pro_recentblogShortcode.php' );
require_once( 'pro/pro_recentblogsliderShortcode.php' );
require_once( 'pro/widget_pro_function.php' );
require_once( 'blog_menu_function.php' );

function wpspw_pro_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}	

function wpspw_pro_display_tags( $query ) {
    if( is_tag() && $query->is_main_query() ) {       
       $post_types = array( 'post' );
        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'wpspw_pro_display_tags' );

// Manage Category Shortcode Columns
add_filter("manage_category_custom_column", 'wpspw_pro_post_category_columns', 10, 3);
add_filter("manage_edit-category_columns", 'wpspw_pro_post_category_manage_columns'); 
function wpspw_pro_post_category_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'blog_shortcode' => __( 'Blog Category Shortcode', 'blog' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);
    return $new_columns;
}

function wpspw_pro_post_category_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'category');
    switch ($column_name) {      

        case 'title':
            echo get_the_title();
        break;
        case 'blog_shortcode':        

             echo '[wpspw_post category="' . $theme_id. '"]<br />';
			 echo '[wpspw_recent_post category="' . $theme_id. '"]<br />';
			 echo '[wpspw_recent_post_slider category="' . $theme_id. '"]<br />';
        break;

        default:
            break;
    }
    return $out;
}

/**
 * Function to unique number value
 * 
 * @package WP Stylist Post and Widgets Pro
 * @since 1.0.1
 */
function wpspw_pro_get_unique() {
  static $unique = 0;
  $unique++;

  return $unique;
}