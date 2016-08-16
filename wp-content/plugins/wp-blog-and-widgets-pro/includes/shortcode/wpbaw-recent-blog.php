<?php
/**
 * 'recent_blog_post' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function pro_get_wpbaw_homeblog( $atts, $content = null ){
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		"limit" 				=> '-1',	
		"category" 				=> '',
		"category_name" 		=> '',
		"grid" 					=> '0',
		"design" 				=> '',
		"show_author" 			=> 'true',
		"show_full_content" 	=> 'false',
        "show_date" 			=> 'true',
        "show_category_name" 	=> 'true',
        "show_content" 			=> 'true',
        "content_words_limit" 	=> '20',
		"show_read_more" 		=> 'true',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'post_date',
		'link_target'			=> 'self',
		'image_height'			=> '',
	), $atts));

	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 	? $limit 	: '-1';
	$cat 				= !empty($category) ? $category : '';
	$gridcol 			= !empty($grid) 	? $grid 	: 0;
	$blogcategory_name	= !empty($category_name) ? $category_name : '';
	$blogdesign 		= !empty($design) 	? trim($design) : 'design-16';
	$showFullContent 	= ( $show_full_content == 'true' ) 	? 'true' : 'false';
	$showDate 			= ( $show_date == 'true' ) 			? 'true' : 'false';
	$showCategory 		= ( $show_category_name == 'true' ) ? 'true' : 'false';
	$showContent 		= ( $show_content == 'true' ) 		? 'true' : 'false';
	$words_limit 		= !empty($content_words_limit) ? $content_words_limit : 20;
    $showAuthor 		= ( $show_author == 'true' ) 		? 'true' : 'false';
	$showreadmore 		= ( $show_read_more == 'true' ) 	? 'true' : 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) ? $orderby : 'post_date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41' || $blogdesign == 'design-49' || $blogdesign == 'design-50')) ? '500' : $image_height;
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
    $count 			= 0;
	$newscount 		= 0;
	$grid_count		= 1;
	$default_img	= wpbaw_pro_get_option('default_img');
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	// Shortcode file
	$blogdesign_file 		= !empty($blogdesign) ? trim($blogdesign).'.php' : 'design-16.php';
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/'.$blogdesign_file;

	// Check file exist else take default
	if( !file_exists( $blogdesign_file_path ) ) {
		$blogdesign 			= 'design-16';
		$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/design-16.php';
	}

	ob_start();

	?>
			
	<div class="sp_blog_static <?php echo $blogdesign; ?> wpbaw-grid-<?php echo $gridcol; ?>">

		<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31")     { ?>
		<div class="blog-block">		   
		<?php }

		if ($blogdesign == "design-23") { ?>
			<div class="blog-grid wp-medium-3 wpcolumns">
				<div class="blog-grid-content">
					<div class="latest-blog">
					<div class="latest-blog-inner">
						 <h1 class="blog-title">
							<?php echo $blogcategory_name; ?>
						</h1>
					</div>
					</div>
				</div>
	       	</div><!-- end .blog-grid -->
			<?php } else if ($blogdesign != "design-23" && $blogcategory_name != '') { ?>
				<h1 class="category-title-main">
					<?php echo $blogcategory_name; ?>
				</h1>
			<?php }
		  	
            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             	
             	$count++;
               	$terms 		= get_the_terms( $post->ID, 'blog-category' );
               	$feat_image = wpbaw_pro_get_post_featured_image( $post->ID );
               	$feat_image = ($feat_image) ? $feat_image : $default_img;
               	$post_link 	= wpbaw_pro_get_post_link( $post->ID );
				$news_links = array();

				if($terms) {
					foreach ( $terms as $term ) {
					    $term_link = get_term_link( $term );
					    $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
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
	
	<?php
		wp_reset_query();		
		$content .= ob_get_clean();
		return $content;
}

// Recent blog post shortcode
add_shortcode('recent_blog_post','pro_get_wpbaw_homeblog');