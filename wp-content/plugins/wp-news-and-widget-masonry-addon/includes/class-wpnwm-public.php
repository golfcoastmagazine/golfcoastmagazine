<?php
/**
 * Public Class
 * 
 * Handles shortcodes functionality of plugin
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnwm_Public {
	
	var $model;

	function __construct() {
		
		global $wpnwm_model;
		$this->model = $wpnwm_model;

		// Ajax call to update option
		add_action( 'wp_ajax_wpnwm_get_more_post', array($this, 'wpnwm_get_more_post'));
		add_action( 'wp_ajax_nopriv_wpnwm_get_more_post',array( $this, 'wpnwm_get_more_post'));

		// Filter to enable jetpack sharing
		add_filter( 'sharing_show', array($this, 'wpnwm_enable_jetpack_sharing'), 10, 2 );

		// Action to add jetpack sharing button
		add_action('wpnwm_news_content_bottom', array($this, 'wpnwm_show_jetpack_sharing'), 5, 2);
	}

	/**
	 * Get more news post througn ajax
	 *
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_get_more_post() {

		// Taking some defaults
		$result = array();

		if( !empty($_POST['shrt_param']) ) {

			global $post, $wpnwm_in_shrtcode;

			extract( $_POST['shrt_param'] );

			$design_file_path 	= WPNWM_DIR . '/templates/' . $newdesign . '.php';
			$design_file 		= (file_exists($design_file_path)) 	? $design_file_path 	: '';
			$pro_active 		= wpnwm_plugins_active(true);
			$count 				= (isset($_POST['count'])) 			? (int)$_POST['count'] 	: 0;
			$shortcode_atts 	= $_POST['shrt_param']; // Assigning it to variable

			$args = array (
					'post_type'      	=> WPNWM_POST_TYPE, 
					'orderby'        	=> !empty($orderby) 	? $orderby : 'post_date',
					'order'          	=> !empty($order) 		? $order 	: 'DESC',
					'posts_per_page' 	=> !empty($posts_per_page) 		? $posts_per_page 	: '10',
					'paged'          	=> !empty($_POST['paged']) 		? $_POST['paged'] 	: '1',
					'post_not_in'		=> !empty($exclude_post) ? $exclude_post : array(),
					'post_in'			=> !empty($posts) ? $posts : array(),
				);

			if($cat != "") {
				$args['tax_query'] = array( array( 'taxonomy' => WPNWM_CAT, 'field' => 'id', 'terms' => $cat) );
			}

			$news_post = $this->model->wpnwm_get_news( $args );

			ob_start();

			if ( $news_post->have_posts() ) {

				$wpnwm_in_shrtcode = true; // Determine shortcode is running

				while ( $news_post->have_posts() ) : $news_post->the_post();

					$count++;
					$news_links 			= array();
					$terms 					= get_the_terms( $post->ID, WPNWM_CAT );
		            $post_link 				= ($pro_active) ? wpnw_pro_get_post_link( $post->ID ) : get_permalink( $post->ID );
					$post_featured_image 	= wpnwm_get_post_featured_image( $post->ID, '', true );
					$thumb_cls 				= empty($post_featured_image) ? 'wpnwm-no-thumb' : '';
					$terms 					= get_the_terms( $post->ID, WPNWM_CAT );
					
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
	                }
	                $cate_name = join( " ", $news_links );
	                
				if( $design_file ) {
              		include( $design_file );
              	}

				endwhile;
			}

			$data = ob_get_clean();

			$wpnwm_in_shrtcode = false;
			
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
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_enable_jetpack_sharing( $show, $post ) {

		global $wpnwm_in_shrtcode;

		if( isset($post->post_type) && $post->post_type == WPNWM_POST_TYPE && $wpnwm_in_shrtcode == 1 ) {
			$show = true;
		}

		return $show;
	}

	/**
	 * Enable jetpack sharing
	 * 
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_show_jetpack_sharing( $post, $shortcode_atts ) {

		// Jetpack sharing
		if( (isset($shortcode_atts) && $shortcode_atts['jet_sharing'] == 'true') ) {
			
			// Checking sharing status
			$sharing_status = get_post_meta( $post->ID, 'sharing_disabled', false );
			
			if ( function_exists('sharing_display') && empty( $sharing_status ) ) {

				echo '<div class="wpnwm-share-icon"><img src="'.WPNWM_URL.'assets/images/share.png" alt="" title="'.__('Share', 'sp-news-and-widget').'" /></div>';

				echo '<div class="wpnwm-jet-sharing"><span class="wpnwm-share-close" title="'.__('Close', 'sp-news-and-widget').'">X</span>';
						sharing_display( '', true );
				echo '</div><!-- end .jet_sharing -->';
			}
		}
	}
}

$wpnwm_public = new Wpnwm_Public();