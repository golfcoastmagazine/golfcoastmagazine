<div class="wpnwm-news-grid news-grid wpnwm-medium-<?php echo $grid_clmn; ?> wpnwm-columns">	
	
	<div class="wpnwm-news-grid-inr">
		
		<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		
		<div class="news_overlay <?php echo $thumb_cls; ?>">
			
			<?php if ( $post_featured_image ) { ?>
			<div class="news-image-bg">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
				</a>
			</div>
			<?php } ?>
			
			<div class="news-grid-content">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="news-categories">
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>
				
				<div class="news-content">
					<h3 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h3>
					
					<?php if($showDate == "true") {  ?>	
						<div class="news-date">
							<?php echo get_the_date(); ?>
						</div><!-- end .news-date -->
					<?php } ?>
				</div><!-- end .news-content -->
			</div><!-- end .news-grid-content -->

		</div><!-- end .news_overlay -->

		<?php do_action( 'wpnwm_news_content_bottom', $post, $shortcode_atts ); ?>
		
	</div><!-- end .wpnwm-news-grid-inr -->
</div><!-- end .wpnwm-news-grid -->