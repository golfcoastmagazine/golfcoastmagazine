<?php 
/**
 * `sp_news_slider` Shortcode
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pro_get_news_slider( $atts, $content = null ) {

	// Shortcode Parameters
	extract(shortcode_atts(array(
		"limit" 				=> '-1',
		"category" 				=> '',
		"category_name" 		=> '',
		"show_read_more" 		=> 'true',
		"design" 				=> '',
		"show_date" 			=> 'true',
		"show_category_name" 	=> 'true',
		"show_content" 			=> 'true',
		"content_words_limit" 	=> '20',
		"slides_column" 		=> '4',
		"slides_scroll" 		=> '1',
		"dots" 					=> 'true',
		"arrows" 				=> 'true',
		"autoplay" 				=> 'true',
		"autoplay_interval" 	=> '2000',
		"speed" 				=> '300',
		"loop" 					=> 'true',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'post_date',
		'link_target'			=> 'self',
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'image_height'			=> '',
	), $atts));

	// Shortcode Parameters
	$shortcode_designs 		= wpnw_sp_news_slider_designs();
	$content_tail 			= html_entity_decode($content_tail);
	$posts_per_page			= (!empty($limit)) 		? $limit 				: '-1';
	$cat 					= (!empty($category))	? $category 			: '';
	$showreadmore 			= ( $show_read_more == 'true' ) 	? 'true' 	: 'false';
	$newscategory_name 		= ($category_name) 					? $category_name : '';
	$showDate 				= ( $show_date == 'true' ) 			? 'true' : 'false';
	$showCategory 			= ( $show_category_name == 'true' ) ? 'true' : 'false';
	$showContent 			= ( $show_content == 'true' ) 		? 'true' : 'false';
	$words_limit 			= !empty($content_words_limit) 		? $content_words_limit 	: '20';
	$news_slides_column 	= !empty($slides_column) 			? $slides_column 		: '4';
	$news_slides_scroll 	= !empty($slides_scroll) 			? $slides_scroll	: '1';
	$news_dots 				= ( $dots == 'true' ) 				? 'true' : 'false';
	$news_arrows 			= ( $arrows == 'true' ) 			? 'true' : 'false';
	$news_autoplay 			= ( $autoplay == 'true' ) 			? 'true' : 'false';
	$news_autoplayInterval 	= !empty($autoplay_interval) 		? $autoplay_interval : 2000;
	$news_speed 			= !empty($speed) 					? $speed : '300';
	$news_loop 				= ( $loop == 'true' ) 				? 'true' : 'false';
	$order 					= ( strtolower($order) == 'asc' ) 	? 'ASC' : 'DESC';
	$orderby 				= (!empty($orderby))				? $orderby	: 'post_date';
	$link_target 			= ($link_target == 'blank') ? '_blank' : '_self';
	$newdesign 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-8';
	$exclude_post 			= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$posts 					= !empty($posts)					? explode(',', $posts) 			: array();
	$design_file_path 		= WPNW_PRO_DIR . '/templates/' . $newdesign . '.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';
	$image_height		= (empty($image_height) && ($newdesign == 'design-40' || $newdesign == 'design-41')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';

    $args = array ( 
            'post_type'      	=> WPNW_PRO_POST_TYPE,
            'orderby'        	=> $orderby,
            'order'          	=> $order,
            'posts_per_page' 	=> $posts_per_page,
            'post__not_in'		=> $exclude_post,
			'post__in'			=> $posts,
		);

	if($cat != "") {
		$args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $cat) );
	}

	global $post;

	// Taking some default
	$count 			= 0;
	$newscount 		= 0;
	$grid_count 	= 1;
	$default_img 	= wpnw_pro_get_option( 'default_img' );
	$unique			= wpnw_pro_get_unique();

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	if ($newscategory_name != '') { ?>
		<h1 class="category-title-main">		   
			<?php echo $newscategory_name; ?>
		</h1>
	<?php } ?>
		  	
		<div class="wpnw-pro-sp-news-slider-<?php echo $unique; ?> sp_news_slider <?php echo $newdesign; ?>">

            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            	$count++;
            	$post_link 				= wpnw_pro_get_post_link( $post->ID );
				$post_featured_image 	= wpnw_get_post_featured_image( $post->ID, '', true );
               	$terms 					= get_the_terms( $post->ID, 'news-category' );
				$news_links 			= array();

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
						   
				$newscount++;
				$grid_count++;
            	endwhile;

			endif; ?>
		</div><!-- end .sp_news_slider -->

		<?php if ($newdesign == 'design-1' || $newdesign == 'design-2' || $newdesign == 'design-3' || $newdesign == 'design-4' || $newdesign == 'design-5' || $newdesign == 'design-38' || $newdesign == 'design-40'
		|| $newdesign == 'design-41' || $newdesign == 'design-42' ) { ?>
			<script type="text/javascript">
    		jQuery(document).ready(function() {
				jQuery('.wpnw-pro-sp-news-slider-<?php echo $unique; ?>').slick({
					dots: <?php echo $news_dots; ?>,
					infinite: <?php echo $news_loop; ?>,
					speed: <?php echo $news_speed; ?>,
					arrows:<?php echo $news_arrows; ?>,
					autoplay: <?php echo $news_autoplay; ?>,		
					autoplaySpeed: <?php echo $news_autoplayInterval; ?>,
					slidesToShow: 1,
					slidesToScroll: 1
				});
    		});
 			</script>
		<?php } else { ?>

			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.wpnw-pro-sp-news-slider-<?php echo $unique; ?>').slick({
					dots: <?php echo $news_dots; ?>,
					infinite: <?php echo $news_loop; ?>,
					speed: <?php echo $news_speed; ?>,
					arrows:<?php echo $news_arrows; ?>,
					autoplay: <?php echo $news_autoplay; ?>,		
					autoplaySpeed: <?php echo $news_autoplayInterval; ?>,
					slidesToShow: <?php echo $news_slides_column; ?>,
					slidesToScroll: <?php echo $news_slides_scroll; ?>,
					responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: true,
							dots: false
						}
					},
					{
					breakpoint: 800,
					<?php if($newdesign != 'design-14') { ?>
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					  <?php } else { ?>
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
				      }
					  <?php } ?>
				    },
				    {
						breakpoint: 500,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
				    }]
				});
		    });
		  </script>
	<?php
		}
		wp_reset_query();	
		$content .= ob_get_clean();

		return $content;
}

// 'sp_news_slider' shortcode
add_shortcode('sp_news_slider','pro_get_news_slider');