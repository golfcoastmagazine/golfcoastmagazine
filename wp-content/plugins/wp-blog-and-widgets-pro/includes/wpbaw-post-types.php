<?php
/**
 * Register Post type functionality
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_register_post_type() {

  	// Blog Post type
	$wpbaw_blog_labels = array(
		'name'                 => __('Blog', 'wp-blog-and-widgets'),
		'singular_name'        => __('Blog', 'wp-blog-and-widgets'),
		'add_new'              => __('Add Blog', 'wp-blog-and-widgets'),
		'add_new_item'         => __('Add New Blog', 'wp-blog-and-widgets'),
		'edit_item'            => __('Edit Blog', 'wp-blog-and-widgets'),
		'new_item'             => __('New Blog', 'wp-blog-and-widgets'),
		'view_item'            => __('View Blog', 'wp-blog-and-widgets'),
		'search_items'         => __('Search Blog', 'wp-blog-and-widgets'),
		'not_found'            =>  __('No Blog Items found', 'wp-blog-and-widgets'),
		'not_found_in_trash'   => __('No Blog Items found in Trash', 'wp-blog-and-widgets'),
		'parent_item_colon'    => '',
		'menu_name'            => __('Blog Pro', 'wp-blog-and-widgets')
	);

	$wpbaw_blog_args = array(
		'labels'              => $wpbaw_blog_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array(
									'slug' 			=> apply_filters('wpbaw_pro_blog_post_slug', 'blog-post'),
									'with_front' 	=> false
								),
		'capability_type'     	=> 'post',
		'has_archive'         	=> true,
		'hierarchical'        	=> false,
		'menu_position'       	=> 8,
		'menu_icon'   			=> 'dashicons-feedback',
		'supports'            	=> apply_filters('wpbaw_pro_blog_post_supports', array('title','editor','thumbnail','excerpt','comments', 'page-attributes', 'publicize')),
		'taxonomies'          	=> array('post_tag')
	);

	// Register blog post type
	register_post_type( WPBAW_PRO_POST_TYPE, apply_filters('wpbaw_pro_register_post_type_blog', $wpbaw_blog_args) );
}

// Action to register plugin post type
add_action('init', 'wpbaw_pro_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_register_taxonomies() {
	
    $labels = array(
        'name'              => __( 'Category', 'wp-blog-and-widgets' ),
        'singular_name'     => __( 'Category', 'wp-blog-and-widgets' ),
        'search_items'      => __( 'Search Category', 'wp-blog-and-widgets' ),
        'all_items'         => __( 'All Category', 'wp-blog-and-widgets' ),
        'parent_item'       => __( 'Parent Category', 'wp-blog-and-widgets' ),
        'parent_item_colon' => __( 'Parent Category:', 'wp-blog-and-widgets' ),
        'edit_item'         => __( 'Edit Category', 'wp-blog-and-widgets' ),
        'update_item'       => __( 'Update Category', 'wp-blog-and-widgets' ),
        'add_new_item'      => __( 'Add New Category', 'wp-blog-and-widgets' ),
        'new_item_name'     => __( 'New Category Name', 'wp-blog-and-widgets' ),
        'menu_name'         => __( 'Blog Category', 'wp-blog-and-widgets' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => apply_filters('wpbaw_pro_blog_cat_slug', WPBAW_PRO_CAT) ),
    );

    register_taxonomy( WPBAW_PRO_CAT, array( 'blog_post' ), apply_filters('wpbaw_pro_register_cat_blog', $args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wpbaw_pro_register_taxonomies');