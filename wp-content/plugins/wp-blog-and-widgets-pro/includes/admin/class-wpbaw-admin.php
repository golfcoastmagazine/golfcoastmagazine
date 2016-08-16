<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbaw_Pro_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpbaw_pro_blog_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wpbaw_pro_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpbaw_pro_register_menu'), 9 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wpbaw_pro_register_settings') );

		// Filter for blog category columns
		add_filter( 'manage_edit-'.WPBAW_PRO_CAT.'_columns', array($this, 'wpbaw_pro_manage_category_columns') );
		add_filter( 'manage_'.WPBAW_PRO_CAT.'_custom_column', array($this, 'wpbaw_pro_blog_category_data'), 10, 3 );
		
		// Action to add sorting link at Blog listing page
		add_filter( 'views_edit-'.WPBAW_PRO_POST_TYPE, array($this, 'wpbaw_pro_sorting_link') );

		// Action to add custom column to Blog listing
		add_filter( 'manage_'.WPBAW_PRO_POST_TYPE.'_posts_columns', array($this, 'wpbaw_pro_posts_columns') );

		// Action to add custom column data to Blog listing
		add_action('manage_'.WPBAW_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wpbaw_pro_post_columns_data'), 10, 2);

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wpbaw_pro_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wpbaw_pro_update_post_order', array($this, 'wpbaw_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wpbaw_pro_update_post_order',array( $this, 'wpbaw_pro_update_post_order'));

		// Filter to change post data for main query
		add_filter( 'pre_get_posts', array($this, 'wpbaw_pro_blog_display_tags') );
		
		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpbaw_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPBAW_PRO_PLUGIN_BASENAME, array( $this, 'wpbaw_pro_plugin_action_links' ) );
	}

	/**
	 * Blog Post Settings Metabox
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_blog_metabox() {
		add_meta_box( 'wpbaw-pro-post-sett', __( 'Blog Settings', 'wp-blog-and-widgets' ), array($this, 'wpbaw_pro_blog_sett_mb_content'), WPBAW_PRO_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Blog Post Settings Metabox HTML
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_blog_sett_mb_content() {
		include_once( WPBAW_PRO_DIR .'/includes/admin/metabox/wpbaw-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.0.0
	 */
	function wpbaw_pro_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPBAW_PRO_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPBAW_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? wpbaw_pro_slashes_deep(trim($_POST[$prefix.'more_link'])) : '';

		update_post_meta($post_id, $prefix.'more_link', $read_more_link);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPBAW_PRO_POST_TYPE, __('Settings', 'wp-blog-and-widgets'), __('Settings', 'wp-blog-and-widgets'), 'manage_options', 'wpbaw-pro-settings', array($this, 'wpbaw_pro_settings_page') );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_register_settings() {
		register_setting( 'wpbaw_pro_plugin_options', 'wpbaw_pro_options', array($this, 'wpbaw_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_validate_options( $input ) {
		
		$input['default_img'] = isset($input['default_img']) ? wpbaw_pro_slashes_deep(trim($input['default_img'])) : '';
		$input['custom_css'] = isset($input['custom_css']) ? wpbaw_pro_slashes_deep($input['custom_css']) : '';
		
		return $input;
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_settings_page() {
		include_once( WPBAW_PRO_DIR . '/includes/admin/settings/wpbaw-settings.php' );
	}

	/**
	 * Add extra column to blog category
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_manage_category_columns( $columns ) {

	    $new_columns['blog_shortcode'] = __( 'Blog Category Shortcode', 'wp-blog-and-widgets' );

		$columns = wpbaw_pro_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to blog category
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_blog_category_data($ouput, $column_name, $tax_id) {

	    if( $column_name == 'blog_shortcode' ){
			$ouput .= '[blog category="' . $tax_id. '"]';
			$ouput .= '[recent_blog_post category="' . $tax_id. '"]<br />';
			$ouput .= '[recent_blog_post_slider category="' . $tax_id. '"]<br />';
	    }

	    return $ouput;
	}

	/**
	 * Add 'Sort Blog' link at Blog listing page
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort Blog', 'wp-blog-and-widgets' ) . '</a>';

	    return $views;
	}

	/**
	 * Add custom column to Blog listing page
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_posts_columns( $columns ){

	    $new_columns['wpbaw_pro_order'] = __('Order', 'wp-blog-and-widgets');

	    $columns = wpbaw_pro_add_array( $columns, $new_columns, 4 );

	    return $columns;
	}

	/**
	 * Add custom column data to Blog listing page
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_post_columns_data( $column, $data ) {

	    global $post;

	    if( $column == 'wpbaw_pro_order' ){
	        $post_id            = isset($post->ID) ? $post->ID : '';
	        $post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
	        echo $post_menu_order;
	        echo "<input type='hidden' value='{$post_id}' name='wpbaw_pro_post[]' class='wpbaw-blog-order' id='wpbaw-blog-order-{$post_id}' />";
	    }
	}

	/**
	 * Add Save button to Blog listing page
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_restrict_manage_posts(){

		global $typenow, $wp_query;

		if( $typenow == WPBAW_PRO_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wpbaw-spinner'></span>";
			$html .= "<input type='button' name='wpbaw_save_order' class='button button-secondary right wpbaw-save-order' id='wpbaw-save-order' value='".__('Save Sort Order', 'wp-blog-and-widgets')."' />";
			echo $html;
		}
	}

	/**
	 * Update Blog order
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'wp-blog-and-widgets');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wpbaw_posts 	= !empty($output_arr['wpbaw_pro_post']) ? $output_arr['wpbaw_pro_post'] : '';

			if( !empty($wpbaw_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wpbaw_posts as $wpbab_post_key => $wpbaw_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wpbaw_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('Blog order saves successfully.', 'wp-blog-and-widgets');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to change main query data
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_blog_display_tags( $query ) {
	    if( is_tag() && $query->is_main_query() ) {
			$post_types = array( 'post', WPBAW_PRO_POST_TYPE );
			$query->set( 'post_type', $post_types );
	    }
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPBAW_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://wponlinesupport.com/pro-plugin-document/document-wp-blog-and-widgets-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'wp-blog-and-widgets' ) ) . '" target="_blank">' . __( 'Docs', 'wp-blog-and-widgets' ) . '</a>',
				'support' => '<a href="' . esc_url('http://wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'wp-blog-and-widgets' ) ) . '" target="_blank">' . __( 'Support', 'wp-blog-and-widgets' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package WP Blog and Widgets Pro
	 * @since 1.1.7
	 */
	function wpbaw_pro_plugin_action_links( $links ) {

		$license_url = add_query_arg( array('page' => 'blogpro-license'), admin_url('plugins.php') );

		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'wp-blog-and-widgets' ) ) . '">' . __( 'License', 'wp-blog-and-widgets' ) . '</a>';

		return $links;
	}
}

$wpbaw_pro_admin = new Wpbaw_Pro_Admin();