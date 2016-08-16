<div class="wpbawm-blog-grid blog-grid wpbawm-medium-<?php echo $grid_clmn; ?> wpbawm-columns">
	<div class="blog-grid-content <?php echo $thumb_cls; ?>">

		<div class="blog-image-bg">
			
			<?php if ( $post_featured_image ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-blog-and-widget'); ?>" />
				</a>
			<?php } ?>

			<div class="blog-while-overlay">
				<div class="blog-while-overlay-inner">
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
				</div><!-- end .blog-while-overlay-inner -->
			</div><!-- end .blog-while-overlay -->

		</div><!-- end .blog-grid-content -->

		<?php do_action( 'wpbawm_blog_content_bottom', $post, $shortcode_atts ); ?>

	</div><!-- end .blog-grid-content -->
</div><!-- end .wpbawm-blog-grid -->