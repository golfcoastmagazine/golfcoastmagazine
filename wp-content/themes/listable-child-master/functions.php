<?php
/**
 * Listable Child functions and definitions
 *
 * Bellow you will find several ways to tackle the enqueue of static resources/files
 * It depends on the amount of customization you want to do
 * If you either wish to simply overwrite/add some CSS rules or JS code
 * Or if you want to replace certain files from the parent with your own (like style.css or main.js)
 *
 * @package ListableChild
 */



/**
 * Setup Listable Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function listable_child_theme_setup() {
	load_child_theme_textdomain( 'listable-child-theme', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'listable_child_theme_setup' );





/**
 *
 * 1. Add a Child Theme "style.css" file
 * ----------------------------------------------------------------------------
 *
 * If you want to add static resources files from the child theme, use the
 * example function written below.
 *
 */

function listable_child_enqueue_styles() {
	$theme = wp_get_theme();
	// use the parent version for cachebusting
	$parent = $theme->parent();

	if ( is_rtl() ) {
		wp_enqueue_style( 'listable-rtl-style', get_template_directory_uri() . '/rtl.css', array(), $parent->get( 'Version' ) );
	} else {
		wp_enqueue_style( 'listable-main-style', get_template_directory_uri() . '/style.css', array(), $parent->get( 'Version' ) );
	}

    wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );

    wp_enqueue_style( 'fontawesome-style', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
    wp_enqueue_style( 'googlefont-pontano-style', 'https://fonts.googleapis.com/css?family=Pontano+Sans' );
    wp_enqueue_style( 'googlefont-roboto-style', 'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' );
    wp_enqueue_style( 'googlefont-indie-flower-style', 'https://fonts.googleapis.com/css?family=Indie+Flower' );


	// Here we are adding the child style.css while still retaining
	// all of the parents assets (style.css, JS files, etc)
	wp_enqueue_style( 'listable-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array('listable-style') //make sure the the child's style.css comes after the parents so you can overwrite rules
	);

    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ) );

    wp_enqueue_script( 'init-js', get_stylesheet_directory_uri().'/assets/js/init.js', [], null, true );

}

add_action( 'wp_enqueue_scripts', 'listable_child_enqueue_styles' );





/**
 *
 * 2. Overwrite Static Resources (eg. style.css or main.js)
 * ----------------------------------------------------------------------------
 *
 * If you want to overwrite static resources files from the parent theme
 * and use only the ones from the Child Theme, this is the way to do it.
 *
 */


/*

function listable_child_overwrite_files() {

	// 1. The "main.js" file
	//
	// Let's assume you want to completely overwrite the "main.js" file from the parent

	// First you will have to make sure the parent's file is not loaded
	// See the parent's function.php -> the listable_scripts_styles() function
	// for details like resources names

		wp_dequeue_script( 'listable-scripts' );


	// We will add the main.js from the child theme (located in assets/js/main.js)
	// with the same dependecies as the main.js in the parent
	// This is not required, but I assume you are not modifying that much :)

		wp_enqueue_script( 'listable-child-scripts',
			get_stylesheet_directory_uri() . '/assets/js/main.js',
			array( 'jquery' ),
			'1.0.0', true );



	// 2. The "style.css" file
	//
	// First, remove the parent style files
	// see the parent's function.php -> the hive_scripts_styles() function for details like resources names

		wp_dequeue_style( 'listable-style' );


	// Now you can add your own, modified version of the "style.css" file

		wp_enqueue_style( 'listable-child-style',
			get_stylesheet_directory_uri() . '/style.css'
		);
}

// Load the files from the function mentioned above:

	add_action( 'wp_enqueue_scripts', 'listable_child_overwrite_files', 11 );

// Notes:
// The 11 priority parameter is need so we do this after the function in the parent so there is something to dequeue
// The default priority of any action is 10

*/

//require get_template_directory() . '/theme-options.php';
require get_stylesheet_directory() . '/theme-options.php';

add_image_size('story', 360, 285, true);
add_image_size('story-featured', 100, 55, true);

/**
 * generate excerpt with custom length
 *
 * @param $charlength
 */
function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

function view_all_posts( $example ) {
    // Maybe modify $example in some way.
    global $authordata;
    if ( ! is_object( $authordata ) ) {
        return;
    }
    $link = sprintf(
        '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
        esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
        esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ),
        'View all posts'
    );
    return $link;
}
add_filter( 'the_author_posts_link', 'view_all_posts' );

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );

/********************* AJAX FRAMEWORK ***************************/


define('SN_AJAX_CONTROLLER',admin_url() . 'admin-ajax.php?action=do_ajax_html');  // 'url' parameters for jQuery.ajax()

/*** for AJAX calls that return 'HTML' **/
add_action('wp_ajax_nopriv_do_ajax_html', 'do_SN_AJAX');
add_action('wp_ajax_do_ajax_html', 'do_SN_AJAX');

function do_SN_AJAX() {

    header('HTTP/1.1 200 OK');

    switch ($_REQUEST['fn']) {

        case "user-vault-status-handler":

            //require get_template_directory() . '/vault/request/user-vault-status-handler.php';

            exit;

            break;

        default:

            exit ("No request made");

    }

    exit; // need exit.

}



/****************************************************************/


function gm_custom_post_types() {

    $labels = array(
        'name'               => _x( 'Video', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Video', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Video', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Video', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Video', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Video', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Video', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Video', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Videos', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Videos', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Videos:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No videos found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No videos found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'video' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'taxonomies'    => array(
            'video_category'
        ),
        'supports'           => array( 'title', 'thumbnail')
    );

    register_post_type( 'video', $args );

    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Categories', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Categories' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'video_category' ),
    );

    register_taxonomy( 'video_category', array( 'video' ), $args );

}

add_action('init', 'gm_custom_post_types');

