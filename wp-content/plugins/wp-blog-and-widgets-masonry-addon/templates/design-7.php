<?php if(1 == $count % 2 ) { ?>

<div class="wpbawm-blog-grid blog-grid wpbawm-medium-<?php echo $grid_clmn; ?> wpbawm-columns <?php echo $thumb_cls; ?>">	
	<div class="wpbawm-blog-grid-inr wpbawm-clearfix">
		
		<div class="blog-image-bg">
			
			<?php if ( $post_featured_image ) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-blog-and-widget'); ?>" />
			</a>
			<?php } ?>

			<div class="blog-grid-content <?php echo $sharing_cls; ?>">
				
				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="blog-categories">
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<div class="blog-content">
					<h3 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h3>
					
					<?php if($showDate == "true") {  ?>	
						<div class="blog-date">
							<?php echo get_the_date(); ?>
						</div><!-- end .blog-date -->
					<?php } ?>
				</div><!-- end .blog-content -->
				
			</div><!-- end .blog-while-overlay -->

		</div><!-- end .blog-image-bg -->

		<?php do_action( 'wpbawm_blog_content_bottom', $post, $shortcode_atts ); ?>

	</div><!-- end .wpbawm-blog-grid-inr -->
</div><!-- end .wpbawm-blog-grid -->

<?php } else { ?>

<div class="wpbawm-blog-grid blog-grid wpbawm-medium-<?php echo $grid_clmn; ?> wpbawm-columns noimage">
	<div class="blog-grid-content">	
		
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
		
		<?php if($showContent == "true") { ?>
			<div class="blog-content">
				
				<div><?php echo wpbawm_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
				
				<?php if($showreadmore == 'true') { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-blog-and-widget'); ?></a>
				<?php } ?>
				
			</div><!-- end .blog-content -->
		<?php } ?>
		
		<?php do_action( 'wpbawm_blog_content_bottom', $post, $shortcode_atts ); ?>

	</div><!-- end .blog-grid-content -->
</div><!-- end .wpbawm-blog-grid -->

<?php } ?>