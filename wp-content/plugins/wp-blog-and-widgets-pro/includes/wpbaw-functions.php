<?php
/**
 * Plugin generic functions file
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_default_settings() {
	
	global $wpbaw_pro_options;
	
	$wpbaw_pro_options = array(
							'default_img'	=> '',
							'custom_css' 	=> '',
						);

	$default_options = apply_filters('wpbaw_pro_options_default_values', $wpbaw_pro_options );
	
	// Update default options
	update_option( 'wpbaw_pro_options', $default_options );

	// Overwrite global variable when option is update
	$wpbaw_pro_options = wpbaw_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_settings() {
	
	$options = get_option('wpbaw_pro_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_option( $key = '', $default = false ) {
	global $wpbaw_pro_options;

	$value = ! empty( $wpbaw_pro_options[ $key ] ) ? $wpbaw_pro_options[ $key ] : $default;
	$value = apply_filters( 'wpbaw_pro_get_option', $value, $key, $default );
	return apply_filters( 'wpbaw_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_slashes_deep($data = array(), $flag = false) {
	
	if($flag != true) {
		$data = wpbaw_pro_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wpbaw_pro_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Function to get limited words
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0
 */
function pro_blog_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
		array_pop($words);
	return implode(' ', $words);
}

/**
 * Function to unique number value
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.5
 */
function wpbaw_pro_get_unique() {
  static $unique = 0;
  $unique++;

  return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.6
 */
function wpbaw_pro_add_array(&$array, $value, $index) {
	
	if( is_array($array) && is_array($value) ){
		$split_arr 	= array_splice($array, max(0, $index));
    	$array 		= array_merge( $array, $value, $split_arr);
	}

	return $array;
}

/**
 * Function to get post featured image
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_featured_image( $post_id = '', $size = 'full' ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	
	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
	}

	return $image;
}

/**
 * Function to get post excerpt
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '55';

	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {

			$has_excerpt 	= true;
			$content 		= get_the_excerpt();

		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}

	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Function to get post external link or permalink
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		$prefix = WPBAW_META_PREFIX;

		$post_link = get_post_meta( $post_id, $prefix.'more_link', true );

		if( empty($post_link) ) {
			$post_link = get_post_permalink( $post_id );	
		}
	}
	return $post_link;
}