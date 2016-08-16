<?php
/**
 * Public Class
 * 
 * Handles shortcodes functionality of plugin
 * 
 * @package WP Blog and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpbawm_Public {
	
	var $model;

	function __construct() {
		
		global $wpbawm_model;
		$this->model = $wpbawm_model;

		// Ajax call to update option
		add_action( 'wp_ajax_wpbawm_get_more_post', array($this, 'wpbawm_get_more_post'));
		add_action( 'wp_ajax_nopriv_wpbawm_get_more_post',array( $this, 'wpbawm_get_more_post'));

		// Filter to enable jetpack sharing
		add_filter( 'sharing_show', array($this, 'wpbam_show_jetpack_sharing'), 10, 2 );

		// Action to add jetpack sharing button
		add_action('wpbawm_blog_content_bottom', array($this, 'wpbawm_show_jetpack_sharing'), 5, 2);
	}

	/**
	 * Get more Blog post througn ajax
	 *
	 * @package WP Blog and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpbawm_get_more_post() {
		
		// Taking some defaults
		$result = array();
		
		if( !empty($_POST['shrt_param']) ) {
			
			global $post, $wpbawm_in_shrtcode;
			
			extract( $_POST['shrt_param'] );
			
			$design_file_path 	= WPBAWM_DIR . '/templates/' . $newdesign . '.php';
			$design_file 		= (file_exists($design_file_path)) 	? $design_file_path 	: '';
			$pro_active 		= wpbawm_plugins_active(true);
			$count 				= (isset($_POST['count'])) 			? (int)$_POST['count'] 	: 0;
			$sharing_cls 		= ($jet_sharing == 'true') 			? 'wpbawm-jet-shring' : '';
			$shortcode_atts 	= $_POST['shrt_param']; // Assigning it to variable
			
			$args = array (
					'post_type'      	=> WPBAWM_POST_TYPE, 
					'orderby'        	=> !empty($orderby) 	? $orderby : 'post_date',
					'order'          	=> !empty($order) 		? $order 	: 'DESC',
					'posts_per_page' 	=> !empty($posts_per_page) 		? $posts_per_page 	: '10',
					'paged'          	=> !empty($_POST['paged']) 		? $_POST['paged'] 	: '1',
					'post_not_in'		=> !empty($exclude_post) ? $exclude_post : array(),
					'post_in'			=> !empty($posts) ? $posts : array(),
				);

			if($cat != "") {
				$args['tax_query'] = array( array( 'taxonomy' => WPBAWM_CAT, 'field' => 'id', 'terms' => $cat) );
			}

			$blog_posts = $this->model->wpbawm_get_blogs( $args );

			ob_start();

			if ( $blog_posts->have_posts() ) {

				$wpbawm_in_shrtcode = true;

				while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
					
					$count++;
					$blog_links 			= array();
					$terms 					= get_the_terms( $post->ID, WPBAWM_CAT );
		            $post_link 				= ($pro_active) ? wpbaw_pro_get_post_link( $post->ID ) : get_permalink( $post->ID );
					$post_featured_image 	= wpbawm_get_post_featured_image( $post->ID, '', true );
					$thumb_cls 				= empty($post_featured_image) ? 'wpbawm-no-thumb' : '';
					$terms 					= get_the_terms( $post->ID, WPBAWM_CAT );
					
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$blog_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
	                }
	                $cate_name = join( " ", $blog_links );
	                
				if( $design_file ) {
              		include( $design_file );
              	}

				endwhile; // End while loop
			}
			
				$data = ob_get_clean();
				
				$wpbawm_in_shrtcode = false;
				
				$result['success'] 		= 1;
				$result['data'] 		= $data;
				$result['count']		= $count;
				$result['jet_sharing'] 	= ($jet_sharing == 'true') ? 1 : 0;
				
		} else {
			$result['success'] 	= 0;
		}

		echo json_encode($result);
		die();
	}

	/**
	 * Enable jetpack sharing
	 * 
	 * @package WP Blog and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpbam_show_jetpack_sharing( $show, $post ) {

		global $wpbawm_in_shrtcode;

		if( isset($post->post_type) && $post->post_type == WPBAWM_POST_TYPE && $wpbawm_in_shrtcode == 1 ) {
			$show = true;
		}

		return $show;
	}

	/**
	 * Enable jetpack sharing
	 * 
	 * @package WP Blog and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpbawm_show_jetpack_sharing( $post, $shortcode_atts ) {
		
		// Jetpack sharing
		if( (isset($shortcode_atts) && $shortcode_atts['jet_sharing'] == 'true') ) {
			
			// Checking sharing status
			$sharing_status = get_post_meta( $post->ID, 'sharing_disabled', false );
			
			if ( function_exists('sharing_display') && empty( $sharing_status ) ) {

				echo '<div class="wpbawm-share-icon"><img src="'.WPBAWM_URL.'assets/images/share.png" alt="" title="'.__('Share', 'wp-blog-and-widgets').'" /></div>';

				echo '<div class="wpbawm-jet-sharing"><span class="wpbawm-share-close" title="'.__('Close', 'wp-blog-and-widgets').'">X</span>';
						sharing_display( '', true );
				echo '</div><!-- end .jet_sharing -->';
			}
		}
	}
}

$wpbawm_public = new Wpbawm_Public();