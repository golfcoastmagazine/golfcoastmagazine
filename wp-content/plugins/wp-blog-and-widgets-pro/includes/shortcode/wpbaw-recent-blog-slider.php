<?php
/**
 * 'recent_blog_post_slider' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pro_wpbaw_blog_slider( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		"limit" 				=> '-1',	
		"category" 				=> '',
		"category_name" 		=> '',
		"show_read_more"		=> 'true',
		"design" 				=> 'design-8',	
		"show_author" 			=> 'true',
        "show_date" 			=> 'true',
        "show_category_name"	=> 'true',
        "show_content" 			=> 'true',
        "content_words_limit" 	=> '20',
		"slides_column" 		=> '3',
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
		'image_height'			=> '',
	), $atts));

	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 	? $limit 	: '-1';
	$cat 				= !empty($category) ? $category : '';
	$showreadmore 		= ( $show_read_more == 'true' ) 	? 'true' : 'false';
	$blogdesign 		= !empty($design) 	? trim($design) : 'design-8';
	$showDate 			= ( $show_date == 'true' ) 			? 'true' : 'false';
	$showCategory 		= ( $show_category_name == 'true' ) ? 'true' : 'false';
	$showContent 		= ( $show_content == 'true' ) 		? 'true' : 'false';
	$words_limit 		= !empty($content_words_limit) ? $content_words_limit : 20;
	$blog_slides_column = !empty($slides_column) ? $slides_column : '3';
    $blog_slides_scroll = !empty($slides_scroll) ? $slides_scroll : '1';
	$blog_dots 			= ( $dots == 'true' ) 		? 'true' : 'false';
    $blog_arrows 		= ( $arrows == 'true' ) 	? 'true' : 'false';
	$blog_autoplay 		= ( $autoplay == 'true' ) 	? 'true' : 'false';
	$blog_autoplayInterval = !empty($autoplay_interval) ? $autoplay_interval : '2000';
	$blog_speed 		= !empty($speed) ? $speed : '300';
	$blog_loop 			= ( $loop == 'true' ) 	? 'true' : 'false';
	$showAuthor 		= ( $show_author == 'true' ) 		? 'true' : 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) ? $orderby : 'post_date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';

    $args = array (
        'post_type'      => WPBAW_PRO_POST_TYPE,
        'orderby'        => $orderby,
        'order'          => $order,
        'posts_per_page' => $posts_per_page,
    );

	if($cat != ""){
		$args['tax_query'] = array( array( 'taxonomy' => 'blog-category', 'field' => 'id', 'terms' => $cat) );
	}

	global $post;

    $query 			= new WP_Query($args);
    $post_count 	= $query->post_count;
	$count 			= 0;
	$newscount 		= 0;
	$grid_count 	= 1;
	$unique 		= wpbaw_pro_get_unique();
	$default_img	= wpbaw_pro_get_option('default_img');

	// Shortcode file
	$blogdesign_file 		= !empty($blogdesign) ? trim($blogdesign).'.php' : 'design-8.php';
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/'.$blogdesign_file;

	// Check file exist else take default
	if( !file_exists( $blogdesign_file_path ) ) {
		$blogdesign 			= 'design-8';
		$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/design-8.php';
	}

	ob_start();
?>	  

	<div class="wpbaw-pro-blog-slider-<?php echo $unique; ?> sp_blog_slider <?php echo $blogdesign; ?> wpbaw-grid-<?php echo $blog_slides_column; ?>">
		  
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
			$count++;
			$feat_image 	= wpbaw_pro_get_post_featured_image( $post->ID );
			$feat_image 	= ( $feat_image ) ? $feat_image : $default_img;
			$post_link 		= wpbaw_pro_get_post_link( $post->ID );
			$terms 			= get_the_terms( $post->ID, 'blog-category' );
			$blog_links 	= array();

            if($terms) {
                foreach ( $terms as $term ) {
                    $term_link = get_term_link( $term );
                    $blog_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                }
            }
            $cate_name = join( " ", $blog_links );              
            
			// Include shortcode html file
    		include( $blogdesign_file_path );
			
			$newscount++;
			$grid_count++;
            endwhile; 
			endif; ?>
	</div><!-- end .sp_blog_slider -->
				
<?php			
	wp_reset_query();
			 
	if ($blogdesign == 'design-1' || $blogdesign == 'design-2' || $blogdesign == 'design-3' || $blogdesign == 'design-4' || $blogdesign == 'design-5' || $blogdesign == 'design-38' || $blogdesign == 'design-40' || $blogdesign == 'design-41' || $blogdesign == 'design-46' ) { ?>
		
		<script type="text/javascript">
	    jQuery(document).ready(function() {
			jQuery('.wpbaw-pro-blog-slider-<?php echo $unique; ?>').slick({
				dots 		: <?php echo $blog_dots; ?>,
				infinite 	: <?php echo $blog_loop; ?>,
				speed 		: <?php echo $blog_speed; ?>,
				arrows 		: <?php echo $blog_arrows; ?>,
				autoplay 	: <?php echo $blog_autoplay; ?>,		
				autoplaySpeed : <?php echo $blog_autoplayInterval; ?>,
				slidesToShow 	: 1,
				slidesToScroll 	: 1
			});
	    });
	  </script>

<?php } else { ?>

	<script type="text/javascript">
    jQuery(document).ready(function() {
		jQuery('.wpbaw-pro-blog-slider-<?php echo $unique; ?>').slick({
			dots 		: <?php echo $blog_dots; ?>,
			infinite 	: <?php echo $blog_loop; ?>,
			speed 		: <?php echo $blog_speed; ?>,
			arrows 		: <?php echo $blog_arrows; ?>,
			autoplay 	: <?php echo $blog_autoplay; ?>,		
			autoplaySpeed 	: <?php echo $blog_autoplayInterval; ?>,
			slidesToShow 	: <?php echo $blog_slides_column; ?>,
			slidesToScroll 	: <?php echo $blog_slides_scroll; ?>,
	  		responsive: [{
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 1,
		        infinite: true,
		        dots: false
		      }
	    	},{
      			breakpoint: 800,
	  			<?php if($blogdesign != 'design-14') { ?>
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

<?php }	
	
	$content .= ob_get_clean();
	return $content;
}

// Recent blog post slider shortcode
add_shortcode('recent_blog_post_slider','pro_wpbaw_blog_slider');