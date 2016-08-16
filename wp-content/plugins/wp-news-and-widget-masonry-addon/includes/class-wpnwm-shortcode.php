<?php
/**
 * Shortcodes Class
 *
 * Handles shortcodes functionality of plugin
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnwm_Shortcodes {
	
	var $model;

	function __construct() {
		
		global $wpnwm_model;
		$this->model = $wpnwm_model;
		
		// Grid Slider shortcode
		add_shortcode( 'sp_news_masonry', array($this, 'wpnwm_news_masonry') );
	}

	/**
	 * Shortcodes Responsive Recent Post Slider Design
	 *
	 * @package WP News and Widget - Masonry Layout
	 * @since 1.0.0
	 */
	function wpnwm_news_masonry( $atts, $content = null ) {
		
		// Shortcode Parameters
		extract(shortcode_atts(array(
			"limit" 				=> '',
			"category" 				=> '',
			"category_name" 		=> '',
			"design"	 			=> 'design-1',
			"grid" 					=> '2',
			"pagination" 			=> 'false',
			"show_date" 			=> 'true',
			"show_category_name"	=> 'true',
			"show_content" 			=> 'true',
			"show_read_more" 		=> 'true',
			"content_words_limit" 	=> '20',
			'content_tail'			=> '...',
			'order'					=> 'DESC',
			'orderby'				=> 'post_date',
			'link_target'			=> 'self',
			'exclude_post'			=> array(),
			'posts'					=> array(),
			'load_more_text'		=> '',
			'effect'				=> 'effect-1',
			'jet_sharing'			=> 'false'
		), $atts));
		
		$shortcode_designs 	= wpnwm_news_masonry_designs();
		$msonry_effects 	= wpnwm_news_masonry_effects();
	    $content_tail 		= html_entity_decode($content_tail);
	    $posts_per_page		= (!empty($limit)) 		? $limit 			: '-1';
	    $cat 				= (!empty($category))	? explode(',',$category) : '';
		$newscategory_name 	= ($category_name) 		? $category_name 	: '';
		$newdesign 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
		$newspagination 	= ($pagination == 'true')			? 'true'		: 'false';
		$gridcol 			= (!empty($grid))					? $grid 		: '2';
		$showDate 			= ( $show_date == 'true' ) 			? 'true' 		: 'false';
		$showCategory 		= ( $show_category_name == 'true' ) ? 'true' : 'false';
		$showContent 		= ( $show_content == 'true' ) 		? 'true' : 'false';
	    $words_limit 		= !empty($content_words_limit) 		? $content_words_limit : '20';
		$showreadmore 		= ( $show_read_more == 'true' ) 	? 'true' : 'false';
		$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' : 'DESC';
		$orderby 			= (!empty($orderby))				? $orderby	: 'post_date';
		$link_target 		= ($link_target == 'blank') 		? '_blank' : '_self';
		$exclude_post 		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
		$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
		$load_more_text 	= !empty($load_more_text) 			? $load_more_text : __('Load More Posts', 'sp-news-and-widget');
		$effect 			= (!empty($effect) && array_key_exists(trim($effect), $msonry_effects))	? trim($effect) : 'effect-1';
		$jet_sharing 		= ($jet_sharing == 'false') 		? 'false' : 'true';
		
		$design_file_path 	= WPNWM_DIR . '/templates/' . $newdesign . '.php';
		$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
		$pro_active 		= wpnwm_plugins_active(true);
		$unique 			= wpnwm_pro_get_unique();
		$grid_clmn 			= wpnwm_grid_column( $gridcol ); // Taking grid column
		
		// Shortcode Parameters
		$shortcode_atts = compact('content_tail', 'posts_per_page', 'cat', 'newscategory_name', 'newdesign', 'newspagination', 'gridcol', 'showDate', 'showCategory', 'showContent', 'words_limit', 'showreadmore', 'order', 'orderby', 'link_target', 'exclude_post', 'posts', 'grid_clmn', 'jet_sharing');
		
		global $paged, $post, $wpnwm_in_shrtcode;
		
		if(is_home() || is_front_page()) {
			  $paged = get_query_var('page');
		} else {
			 $paged = get_query_var('paged');
		}

		$args = array ( 
			'post_type'      	=> WPNWM_POST_TYPE, 
			'orderby'        	=> $orderby,
			'order'          	=> $order,
			'posts_per_page' 	=> $posts_per_page,   
			'paged'          	=> $paged,
			'post_not_in'		=> $exclude_post,
			'post_in'			=> $posts,
		);

		if($cat != "") {
			$args['tax_query'] = array( array( 'taxonomy' => WPNWM_CAT, 'field' => 'id', 'terms' => $cat) );
		}

		// WP Query
		$query 			= $this->model->wpnwm_get_news( $args );
		$post_count 	= $query->post_count;
		$total_post 	= $query->found_posts;
		$count 			= 0;

		// Enqueue required script
		wp_enqueue_script('masonry', 'jquery');
		wp_enqueue_script('wpnwm-public-script');

		ob_start();

		// If News post is there
		if ( $query->have_posts() ) :

			$wpnwm_in_shrtcode = true; // To know shortcode start
	?>

		<div class="wpnwm-news-masonry-wrp" id="wpnwm-news-masonry-wrp-<?php echo $unique; ?>">

			<?php if ( $newscategory_name != '' ) { ?>
				<h1 class="category-title-main">
					<?php echo $newscategory_name; ?>
				</h1>
			<?php } ?>

			<div class="wpnwm-news-masonry wpnwm-<?php echo $effect; ?> <?php echo $newdesign; ?> wpnaw-grid-<?php echo $gridcol; ?>" id="wpnwm-news-masonry-<?php echo $unique; ?>">

	            <?php while ( $query->have_posts() ) : $query->the_post();
	            	
	            	$count++;
	            	$news_links 			= array();
	               	$terms 					= get_the_terms( $post->ID, WPNWM_CAT );
	               	$post_link 				= ($pro_active) ? wpnw_pro_get_post_link( $post->ID ) : get_permalink( $post->ID );
					$post_featured_image 	= wpnwm_get_post_featured_image( $post->ID, '', true );
	                $thumb_cls 				= empty($post_featured_image) ? 'wpnwm-no-thumb' : '';
	                
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
	           	?>
			</div><!-- end .wpnwm-news-masonry -->
			
			<?php if( ($posts_per_page != -1) && ($posts_per_page < $total_post) && ($newspagination != 'true') ) { ?>
			<div class="wpnwm-ajax-btn-wrap">
				<button class="wpnwm-load-more-btn more" data-ajax="1" data-paged="1" data-count="<?php echo $count; ?>">
					<i class="wpnwm-ajax-loader"><img src="<?php echo WPNWM_URL . 'assets/images/ajax-loader.gif'; ?>" alt="<?php _e('Loading', 'sp-news-and-widget'); ?>" /></i> <?php echo $load_more_text; ?>
				</button>
				<div class="wpnwm-hide wpnwm-shortcode-param"><?php echo wpnwm_esc_attr( json_encode($shortcode_atts)); ?></div>
			</div><!-- end .wpnwm-ajax-btn-wrap -->
			<?php } ?>

			<?php if($newspagination == "true") { ?>
				<div class="news_pagination wpnews-clearfix <?php echo $newdesign;?>">
					<div class="button-news-p"><?php next_posts_link( ' Next >>', $query->max_num_pages ); ?></div>
					<div class="button-news-n"><?php previous_posts_link( '<< Previous' ); ?> </div>
				</div>
			<?php } ?>

		</div><!-- end .wpnwm-news-masonry -->

	<?php
			$wpnwm_in_shrtcode = false;
		endif;

		wp_reset_query(); // Reset wp query

		// If jetpack sharing exist and enable
		if( function_exists('sharing_display') && ($jet_sharing == 'true') ) {
			wp_enqueue_script( 'sharing-js' );
			$sharing_js_options = array(
							        'lang'   => get_base_recaptcha_lang_code(),
							        'counts' => apply_filters( 'jetpack_sharing_counts', true )
							    );
			wp_localize_script( 'sharing-js', 'sharing_js_options', $sharing_js_options );
			wp_enqueue_style( 'sharing', WP_SHARING_PLUGIN_URL.'sharing.css', false, JETPACK__VERSION );
			wp_enqueue_style( 'genericons' );
		}

		$content .= ob_get_clean();
		return $content;
	}
}

$wpnwm_shortcodes = new Wpnwm_Shortcodes();