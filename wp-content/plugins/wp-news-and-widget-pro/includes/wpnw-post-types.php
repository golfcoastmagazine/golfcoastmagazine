<?php
/**
 * Register Post type functionality
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.6
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_register_post_type() {

  	// 'News' post type
	$news_labels = array(
		'name'                 => _x('News', 'sp-news-and-widget'),
		'singular_name'        => _x('News', 'sp-news-and-widget'),
		'add_new'              => _x('Add News Item', 'sp-news-and-widget'),
		'add_new_item'         => __('Add New News Item', 'sp-news-and-widget'),
		'edit_item'            => __('Edit News Item', 'sp-news-and-widget'),
		'new_item'             => __('New News Item', 'sp-news-and-widget'),
		'view_item'            => __('View News Item', 'sp-news-and-widget'),
		'search_items'         => __('Search  News Items', 'sp-news-and-widget'),
		'not_found'            => __('No News Items found', 'sp-news-and-widget'),
		'not_found_in_trash'   => __('No  News Items found in Trash', 'sp-news-and-widget'), 
		'_builtin'             =>  false,
		'parent_item_colon'    => '',
		'menu_name'            => 'News Pro'
	);

	$news_args = array(
		'labels'              => $news_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 
										'slug'       => apply_filters('wpnw_pro_news_post_slug', 'news'),
										'with_front' => false
									),
		'capability_type'   => 'post',
		'has_archive'       => true,
		'hierarchical'      => false,
		'menu_position'     => 5,
		'menu_icon'         => 'dashicons-feedback',
		'supports'          => array('title','editor','thumbnail','excerpt','comments', 'page-attributes', 'publicize'),
		'taxonomies'        => array('post_tag')
	);

	// Register news post type
    register_post_type( WPNW_PRO_POST_TYPE, apply_filters('wpnw_pro_register_post_type_news', $news_args) );
}

// Action to register plugin post type
add_action('init', 'wpnw_pro_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.1.6
 */
function wpnw_pro_register_taxonomies() {

    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Category' ),
        'all_items'         => __( 'All Category' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'News Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('wpnw_pro_news_cat_slug', 'news-category'), ),
    );

    // Register 'news-category' taxonomies
    register_taxonomy( WPNW_PRO_CAT, array( WPNW_PRO_POST_TYPE ), apply_filters('wpnw_pro_register_category_news', $args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wpnw_pro_register_taxonomies');