<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Pro_Admin {
	
	function __construct() {

		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpnw_pro_news_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this,'wpnw_pro_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpnw_pro_register_menu'), 9 );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this,'wpnw_pro_register_settings') );

		// Filter to add extra column in `news-category` table
		add_filter( 'manage_'.WPNW_PRO_CAT.'_custom_column', array($this, 'wpnw_pro_news_category_data'), 10, 3 );
		add_filter( 'manage_edit-'.WPNW_PRO_CAT.'_columns', array($this, 'wpnw_pro_manage_category_columns') ); 

		// Action to add sorting link at News listing page
		add_filter( 'views_edit-'.WPNW_PRO_POST_TYPE, array($this, 'wpnw_pro_sorting_link') );

		// Action to add custom column to News listing
		add_filter( 'manage_'.WPNW_PRO_POST_TYPE.'_posts_columns', array($this, 'wpnw_pro_posts_columns') );

		// Action to add custom column data to News listing
		add_action('manage_'.WPNW_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wpnw_pro_post_columns_data'), 10, 2);

		// Action to add `Save Order` button
		add_action( 'restrict_manage_posts', array($this, 'wpnw_pro_restrict_manage_posts') );

		// Ajax call to update option
		add_action( 'wp_ajax_wpnw_pro_update_post_order', array($this, 'wpnw_pro_update_post_order'));
		add_action( 'wp_ajax_nopriv_wpnw_pro_update_post_order',array( $this, 'wpnw_pro_update_post_order'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpnw_pro_plugin_row_meta' ), 10, 2 );
		add_filter( 'plugin_action_links_' . WPNW_PRO_PLUGIN_BASENAME, array( $this, 'wpnw_pro_plugin_action_links' ) );
	}

	/**
	 * News Post Settings Metabox
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_news_metabox() {
		add_meta_box( 'wpnw-pro-post-sett', __( 'News Settings', 'sp-news-and-widget' ), array($this, 'wpnw_pro_news_sett_mb_content'), WPNW_PRO_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * News Post Settings Metabox HTML
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_news_sett_mb_content() {
		include_once( WPNW_PRO_DIR .'/includes/admin/metabox/wpnw-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.0.0
	 */
	function wpnw_pro_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPNW_PRO_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = WPNW_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$read_more_link = isset($_POST[$prefix.'more_link']) ? wpnw_pro_slashes_deep(trim($_POST[$prefix.'more_link'])) : '';

		update_post_meta($post_id, $prefix.'more_link', $read_more_link);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPNW_PRO_POST_TYPE, __('Settings', 'sp-news-and-widget'), __('Settings', 'sp-news-and-widget'), 'manage_options', 'wpnw-pro-settings', array($this, 'wpnw_pro_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_settings_page() {
		include_once( WPNW_PRO_DIR . '/includes/admin/settings/wpnw-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_register_settings(){
		register_setting( 'wpnw_pro_plugin_options', 'wpnw_pro_options', array($this, 'wpnw_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_validate_options( $input ) {
		
		$input['default_img'] 	= isset($input['default_img']) 	? wpnw_pro_slashes_deep($input['default_img']) 	: '';
		$input['custom_css'] 	= isset($input['custom_css']) 	? wpnw_pro_slashes_deep($input['custom_css']) 	: '';
		
		return $input;
	}

	/**
	 * Add extra column to news category
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.0.0
	 */
	function wpnw_pro_manage_category_columns($columns) {

		$new_columns['news_shortcode'] = __( 'News Category Shortcode', 'sp-news-and-widget' );

		$columns = wpnw_pro_add_array( $columns, $new_columns, 2 );

		return $columns;
	}

	/**
	 * Add data to extra column to news category
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.0.0
	 */
	function wpnw_pro_news_category_data($ouput, $column_name, $tax_id) {
		
		if( $column_name == 'news_shortcode' ){
			$ouput .= '[sp_news category="' . $tax_id. '"]<br/>';
			$ouput .= '[sp_news_slider category="' . $tax_id. '"]';
	    }
		
	    return $ouput;
	}

	/**
	 * Add 'Sort News' link at News listing page
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_sorting_link( $views ) {
	    
	    global $post_type, $wp_query;

	    $class            = ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) ? 'current' : '';
	    $query_string     = remove_query_arg(array( 'orderby', 'order' ));
	    $query_string     = add_query_arg( 'orderby', urlencode('menu_order title'), $query_string );
	    $query_string     = add_query_arg( 'order', urlencode('ASC'), $query_string );
	    $views['byorder'] = '<a href="' . esc_url( $query_string ) . '" class="' . esc_attr( $class ) . '">' . __( 'Sort News', 'sp-news-and-widget' ) . '</a>';

	    return $views;
	}

	/**
	 * Add custom column to News listing page
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_posts_columns( $columns ){

	    $new_columns['wpnw_pro_order'] = __('Order', 'sp-news-and-widget');

	    $columns = wpnw_pro_add_array( $columns, $new_columns, 4 );

	    return $columns;
	}

	/**
	 * Add custom column data to News listing page
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_post_columns_data( $column, $data ) {

	    global $post;

	    if( $column == 'wpnw_pro_order' ){
	        $post_id            = isset($post->ID) ? $post->ID : '';
	        $post_menu_order    = isset($post->menu_order) ? $post->menu_order : '';
	        
	        echo $post_menu_order;
	        echo "<input type='hidden' value='{$post_id}' name='wpnw_pro_post[]' class='wpnw-news-order' id='wpnw-news-order-{$post_id}' />";
	    }
	}

	/**
	 * Add Save button to News listing page
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_restrict_manage_posts(){

		global $typenow, $wp_query;

		if( $typenow == WPNW_PRO_POST_TYPE && isset($wp_query->query['orderby']) && $wp_query->query['orderby'] == 'menu_order title' ) {

			$html  = '';
			$html .= "<span class='spinner wpnw-spinner'></span>";
			$html .= "<input type='button' name='wpnw_save_order' class='button button-secondary right wpnw-save-order' id='wpnw-save-order' value='".__('Save Sort Order', 'sp-news-and-widget')."' />";
			echo $html;
		}
	}

	/**
	 * Update News order
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_update_post_order() {

		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'sp-news-and-widget');

		if( !empty($_POST['form_data']) ) {

			$form_data 		= parse_str($_POST['form_data'], $output_arr);
			$wpnw_posts 	= !empty($output_arr['wpnw_pro_post']) ? $output_arr['wpnw_pro_post'] : '';

			if( !empty($wpnw_posts) ) {

				$post_menu_order = 0;

				// Loop od ids
				foreach ($wpnw_posts as $wpnw_post_key => $wpnw_post) {
					
					// Update post order
					$update_post = array(
						'ID'           => $wpnw_post,
						'menu_order'   => $post_menu_order,
					);

					// Update the post into the database
					wp_update_post( $update_post );

					$post_menu_order++;
				}

				$result['success'] 	= 1;
				$result['msg'] 		= __('News order saved successfully.', 'sp-news-and-widget');
			}
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPNW_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('http://wponlinesupport.com/pro-plugin-document/document-wp-news-and-scrolling-widgets-pro') . '" title="' . esc_attr( __( 'View Documentation', 'sp-news-and-widget' ) ) . '" target="_blank">' . __( 'Docs', 'sp-news-and-widget' ) . '</a>',
				'support' => '<a href="' . esc_url('http://wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'sp-news-and-widget' ) ) . '" target="_blank">' . __( 'Support', 'sp-news-and-widget' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

	/**
	 * Function to add extra plugins link
	 * 
	 * @package WP FAQ Pro
	 * @since 1.1.5
	 */
	function wpnw_pro_plugin_action_links( $links ) {

		$license_url = add_query_arg( array('page' => 'newspro-license'), admin_url('plugins.php') );

		$links['license'] = '<a href="' . esc_url($license_url) . '" title="' . esc_attr( __( 'Activate Plugin License', 'sp-news-and-widget' ) ) . '">' . __( 'License', 'sp-news-and-widget' ) . '</a>';

		return $links;
	}
}

$wpnw_pro_admin = new Wpnw_Pro_Admin();