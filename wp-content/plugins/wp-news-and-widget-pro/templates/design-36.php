<div class="news-grid wpnews-medium-12 wpnews-columns <?php echo $css_class; ?>">
	
	<div class="wpnews-medium-4 wpnews-columns">

		<?php if($showDate == "true") {  ?>	
			<div class="news-date">		
				<?php echo get_the_date(); ?>
			</div>
		<?php } ?>

		<h2 class="news-title">
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
		</h2>
		
		<?php if($showCategory == "true") { ?>
		<div class="news-categories">	
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>
		
	</div><!-- end .wpnews-medium-4 wpnews-columns -->
	
	<div class="wpnews-medium-8 wpnews-columns">

		<?php if ( has_post_thumbnail() ) { ?>
		<div class="news-image-bg">
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo wpnw_get_post_featured_image($post->ID, 'medium'); ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
			</a>
		</div>
		<?php } ?>

		<?php if($showContent == "true") { ?>
		<div class="news-content">				
			<?php  if($showFullContent == "false" ) { ?>
				
				<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget'); ?></a>
				<?php } 
			} else { 
				the_content();
			} ?>
		</div>
		<?php } ?>

	</div><!-- end .wpnews-medium-8 wpnews-columns -->
	
</div><!-- end .news-grid -->