<div class="wpbawm-blog-grid blog-grid wpbawm-medium-<?php echo $grid_clmn; ?> wpbawm-columns">	
	<div class="wpbawm-blog-grid-inr">
		<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		
		<div class="blog_overlay <?php echo $thumb_cls; ?>">

			<?php if ( $post_featured_image ) { ?>
			<div class="blog-image-bg">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-blog-and-widget'); ?>" />
				</a>
			</div>
			<?php } ?>
				
			<div class="blog-grid-content">
				<div class="blog-content">
					<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="blog-categories">
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
					
					<h3 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h3>
						
					<?php if($showDate == "true") {  ?>	
						<div class="blog-date">
							<?php echo get_the_date(); ?>
						</div><!-- end .blog-date -->
					<?php } ?>
				</div><!-- end .blog-content -->
			</div><!-- end .blog-grid-content -->

		</div><!-- end .blog_overlay -->
	
		<?php do_action( 'wpbawm_blog_content_bottom', $post, $shortcode_atts ); ?>
		
	</div><!-- end .wpbawm-blog-grid-inr -->
</div><!-- end .wpbawm-blog-grid -->