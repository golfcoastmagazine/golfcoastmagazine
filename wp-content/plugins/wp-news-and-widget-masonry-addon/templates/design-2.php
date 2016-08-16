<div class="wpnwm-news-grid news-grid wpnwm-medium-<?php echo $grid_clmn; ?> wpnwm-columns">
	<div class="news-grid-content <?php echo $thumb_cls; ?>">

		<div class="news-overlay">
			<div class="news-image-bg">
				<?php if ( $post_featured_image ) { ?>
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
			</div>
		</div><!-- end .news-overlay -->

		<?php if($showContent == "true") { ?>
		<div class="news-content">
			
			<div><?php echo wpnwm_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
			
			<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget'); ?></a>
			<?php } ?>
			
		</div><!-- end .news-content -->
		<?php } ?>
		
		<?php do_action( 'wpnwm_news_content_bottom', $post, $shortcode_atts ); ?>

	</div><!-- end .news-grid-content -->
</div><!-- end .wpnwm-news-grid -->