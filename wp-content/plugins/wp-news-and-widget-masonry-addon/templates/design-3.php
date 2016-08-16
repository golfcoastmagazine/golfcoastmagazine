<div class="wpnwm-news-grid news-grid wpnwm-medium-<?php echo $grid_clmn; ?> wpnwm-columns">
	<div class="news-grid-content <?php echo $thumb_cls; ?>">

		<div class="news-overlay">

			<div class="news-image-bg">
				<?php if( $post_featured_image ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
				</a>
				<?php } ?>
			</div><!-- end .news-image-bg -->
			
			<div class="news-short-content">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="news-categories">
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h3 class="news-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h3>
				
				<?php if($showDate == "true") {  ?>	
					<div class="news-date">
						<?php echo get_the_date(); ?>
					</div><!-- end .news-date -->
				<?php } ?>			
			</div> <!-- end .news-grid-short-contnet -->
			
		</div><!-- end .news-grid-overlay -->

		<?php do_action( 'wpnwm_news_content_bottom', $post, $shortcode_atts ); ?>

	</div><!-- end .news-grid-content -->
</div><!-- end .wpnwm-news-grid -->