<?php
/**
 * Plugin generic functions file
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to unique number value
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Convert Object To Array
 * 
 * Converting Object Type Data To Array Type
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_object_to_array($result) {
    
    $array = array();
    
    foreach ($result as $key=>$value) {
        if (is_object($value)) {
            $array[$key] = wpnwm_object_to_array($value);
        } else {
        	$array[$key] = $value;
        }
    }
    return $array;
}

/**
 * Function to get `sp_news_masonry` shortcode designs
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_news_masonry_designs() {
	$design_arr = array(
						'design-1'	=> __('Design 1', 'sp-news-and-widget'),
						'design-2'	=> __('Design 2', 'sp-news-and-widget'),
						'design-3'	=> __('Design 3', 'sp-news-and-widget'),
						'design-4'	=> __('Design 4', 'sp-news-and-widget'),
						'design-5'	=> __('Design 5', 'sp-news-and-widget'),
						'design-6'	=> __('Design 6', 'sp-news-and-widget'),
						'design-7'	=> __('Design 7', 'sp-news-and-widget'),
						'design-8'	=> __('Design 8', 'sp-news-and-widget'),
						'design-9'	=> __('Design 9', 'sp-news-and-widget'),
						'design-10'	=> __('Design 10', 'sp-news-and-widget'),
						'design-11'	=> __('Design 11', 'sp-news-and-widget'),
						'design-12'	=> __('Design 12', 'sp-news-and-widget'),
					);
	return apply_filters('wpnwm_sp_news_designs', $design_arr );
}

/**
 * Function to get masonry effect
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_news_masonry_effects() {
	$effects_arr = array(
						'effect-1'	=> __('Effect 1', 'sp-news-and-widget'),
						'effect-2'	=> __('Effect 2', 'sp-news-and-widget'),
						'effect-3'	=> __('Effect 3', 'sp-news-and-widget'),
						'effect-4'	=> __('Effect 4', 'sp-news-and-widget'),
						'effect-5'	=> __('Effect 5', 'sp-news-and-widget'),
						'effect-6'	=> __('Effect 6', 'sp-news-and-widget'),
						'effect-7'	=> __('Effect 7', 'sp-news-and-widget'),
					);
	return apply_filters('wpnwm_sp_news_effects', $effects_arr );
}

/**
 * Function to get post excerpt
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

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
 * Function to get post featured image
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
	
	$size 	= !empty($size) ? $size : 'full';
	$image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	
	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
	}

	// Getting default image
	if( wpnwm_plugins_active(true) && $default_img && empty($image) ) {
		$image = wpnw_pro_get_option( 'default_img' );
	}

	return $image;
}

/**
 * Function to get grid column based on grid
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_grid_column( $grid = '' ) {

	if($grid == '2') {
		$grid_clmn = '6';
	} else if($grid == '3') {
		$grid_clmn = '4';
	}  else if($grid == '4') {
		$grid_clmn = '3';
	} else if ($grid == '1') {
		$grid_clmn = '12';
	} else {
		$grid_clmn = '12';
	}
	
	return $grid_clmn;
}