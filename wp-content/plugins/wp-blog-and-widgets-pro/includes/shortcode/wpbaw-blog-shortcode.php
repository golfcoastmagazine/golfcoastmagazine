<?php
/**
 * 'blog' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pro_get_wpbaw_blog( $atts, $content = null ){
	
	// Shortcode Parameter
    extract(shortcode_atts(array(
		"limit" 				=> '',	
		"category" 				=> '',
		"category_name" 		=> '',
		"grid" 					=> '',
		"design" 				=> '',
		"show_author" 			=> 'true',
		"pagination" 			=> 'true',
        "show_date" 			=> 'true',
        "show_category_name" 	=> 'true',
		"show_full_content" 	=> 'false',
        "show_content" 			=> 'true',
        "content_words_limit" 	=> '20',
		"show_read_more" 		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'post_date',
		'content_tail'			=> '...',
		'link_target'			=> 'self',
		'image_height'			=> '',
	), $atts));

    $content_tail = html_entity_decode($content_tail);

    $posts_per_page 	= !empty($limit) 			? $limit 			: '-1';
    $cat 				= !empty($category) 		? $category 		: '';
	$blogcategory_name	= !empty($category_name)	? $category_name 	: '';
	$blogdesign 		= !empty( $design )			? trim($design) 	: 'design-16';
	$showAuthor 		= ($show_author == 'true')	? 'true'			: 'false';
	$blogpagination 	= ($pagination == 'true')	? 'true'			: 'false';
	$showDate 			= ( $show_date == 'true' ) 	? 'true'			: 'false';
	$gridcol 			= !empty($grid) ? $grid : '0';
	$showCategory 		= ( $show_category_name == 'true' )	? 'true' 	: 'false';
	$showContent 		= ( $show_content == 'true' ) 		? 'true' 	: 'false';
	$words_limit 		= !empty( $content_words_limit ) ? $content_words_limit : 20;
	$showFullContent 	= ( $show_full_content == 'true' )	? 'true' 	: 'false';
	$showreadmore 		= ( $show_read_more == 'true' )		? 'true' 	: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) ? $orderby : 'post_date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';
	
	ob_start();
	
	global $post, $paged;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

    $args = array ( 
        'post_type'      => WPBAW_PRO_POST_TYPE,
        'orderby'        => $orderby,
        'order'          => $order,
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
	);

    if($cat != "") {
		$args['tax_query'] = array( array( 'taxonomy' => WPBAW_PRO_CAT, 'field' => 'id', 'terms' => $cat) );
    }

	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	$count 			= 0; 
	$newscount 		= 0;
	$grid_count		= 1;
	$default_img	= wpbaw_pro_get_option('default_img');

	// Shortcode file
	$blogdesign_file 		= !empty($blogdesign) ? trim($blogdesign).'.php' : 'design-16.php';
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/'.$blogdesign_file;

	// Check file exist else take default
	if( !file_exists( $blogdesign_file_path ) ) {
		$blogdesign 			= 'design-16';
		$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/design-16.php';
	}
?>
		  
	<div class="sp_blog_static <?php echo $blogdesign; ?> wpbaw-grid-<?php echo $gridcol; ?>">

		<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31") { ?>
		<div class="blog-block">
		<?php }
		   
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

			$count++;
			$feat_image = wpbaw_pro_get_post_featured_image( $post->ID );
			$feat_image = ($feat_image) ? $feat_image : $default_img;
			$post_link 	= wpbaw_pro_get_post_link( $post->ID );
			$terms 		= get_the_terms( $post->ID, 'blog-category' );

            $news_links = array();
			if($terms) {
                foreach ( $terms as $term ) {
                    $term_link 		= get_term_link( $term );
                    $news_links[] 	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                }
            }
			$cate_name = join( " ", $news_links );
			$css_class = "blogfirstlast";

            if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
            if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }

            // Include shortcode html file
        	include( $blogdesign_file_path );
				
			$newscount++;
			$grid_count++;
            endwhile; ?>
			 
			<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31") { ?>
		   		</div><!-- end .blog-block -->
		   	<?php }
		   	
		endif; ?>

	</div><!-- end .sp_blog_static -->

	<?php if($blogpagination == "true") { ?>
	
	<div class="blog_pagination">
		<div class="button-blog-p"><?php next_posts_link( ' Next >>', $query->max_num_pages ); ?></div>
		<div class="button-blog-n"><?php previous_posts_link( '<< Previous' ); ?> </div>
	</div>

	<?php }

    wp_reset_query();
	$content .= ob_get_clean();
	return $content;
}

// `Blog` shortcode
add_shortcode('blog','pro_get_wpbaw_blog');