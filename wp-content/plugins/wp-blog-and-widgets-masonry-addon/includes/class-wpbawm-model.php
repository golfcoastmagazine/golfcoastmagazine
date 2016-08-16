<?php
/**
 * Model Class
 *
 * Handles shortcodes functionality of plugin
 *
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbawm_Model {

	function __construct() {
	}

	function wpbawm_get_blogs( $args = array() ) {

		// Taking defaults
		$result_data = array();

		$wpbawm_args['post_type'] 		= !empty($args['post_type']) 		? $args['post_type'] 		: WPBAWM_POST_TYPE;
		$wpbawm_args['posts_per_page'] 	= !empty($args['posts_per_page']) 	? $args['posts_per_page'] 	: -1;

		// get order by records
		$wpbawm_args['order']		= !empty($args['order']) 	? $args['order'] 	: 'DESC';
		$wpbawm_args['orderby'] 	= !empty($args['orderby']) 		? $args['orderby'] 	: 'date';

		// Show per page records
		if(isset($args['paged']) && !empty($args['paged'])) {
			$wpbawm_args['paged'] =	$args['paged'];
		}

		// Pagination Parameter
		if( isset($args['offset']) ){
			$wpbawm_args['offset'] = $args['offset'];
		}

		// Meta query
		if(isset($args['meta_query']) && !empty($args['meta_query'])) {
			$wpbawm_args['meta_query'] = $args['meta_query'];
		}

		// Taxonomy query
		if(isset($args['tax_query']) && !empty($args['tax_query'])) {
			$wpbawm_args['tax_query'] = $args['tax_query'];
		}

		// Get only specific post
		if( isset($args['post_in']) && !empty($args['post_in']) ) {
			$wpbawm_args['post__in'] = $args['post_in'];	
		}

		// Exclude some posts
		if( isset($args['post_not_in']) && !empty($args['post_not_in']) ) {
			$wpbawm_args['post__not_in'] = $args['post_not_in'];	
		}

		// Run WP Query
		$result = new WP_Query( $wpbawm_args );
		
		// If only want to get count
		if(isset($args['getcount']) && $args['getcount'] == '1') {
			
			$result_data = $result->post_count;

		}  elseif ( isset($args['list_data']) && !empty($args['list_data']) ) { // Data with post and count in array format
			
			// retrived post data is in object format so assign that data to array for listing
			$result_data = wpbawm_object_to_array($result->posts);
			
			// Fetch data with count
		   	if( isset($args['list_data']) && !empty($args['list_data']) ) {
		    	
	    		$data_res = array();
		        
		    	$data_res['data']  = $result_data;
		    	
		    	// To get total count of post
		    	$data_res['total'] = isset($result->found_posts) ? $result->found_posts : '';
		    	
		    	// Assigning it in to returned array
		    	$result_data = $data_res;
			}

		} else { // Simply pass whole query
			$result_data = $result;
		}

		return $result_data;
	}
}

$wpbawm_model = new Wpbawm_Model();