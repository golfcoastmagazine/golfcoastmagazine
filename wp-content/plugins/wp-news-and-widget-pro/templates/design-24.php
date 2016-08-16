<?php if(0 == $newscount % 2 ) { ?>

	<div class="news-list">
		<div class="news-list-content">

			<?php if ( has_post_thumbnail() ) { ?>
			<div class="wpnews-medium-6 wpnews-columns">
				<div class="news-image-bg">
					<?php if( !empty($post_featured_image) ) { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
					</a>
					<?php } ?>
				</div>
			</div><!-- end .wpnews-medium-6 wpnews-columns -->
			<?php } ?>

			<div class="<?php if ( !has_post_thumbnail() ) { echo 'wpnews-medium-12 wpnews-columns'; } else { echo 'wpnews-medium-6 wpnews-columns'; } ?>">
				
				<?php if($showCategory == "large" && $cate_name !='') { ?>
				<div class="news-categories">	
				<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h2 class="news-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true") { ?>
				<div class="news-date">		
					<?php echo get_the_date(); ?>
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

			</div>

		</div><!-- end .news-list-content -->
	</div><!-- end .news-list -->
	
<?php } else { ?>

	<div class="news-list">
		<div class="news-list-content">
		
			<div class="wpnews-medium-6 wpnews-columns">
				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="news-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h2 class="news-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true") { ?>
				<div class="news-date">		
					<?php echo get_the_date(); ?>
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
			</div><!-- end .wpnews-medium-6 wpnews-columns -->

			<div class="wpnews-medium-6 wpnews-columns">
				<div class="news-image-bg">
					<?php if( !empty($post_featured_image) ) { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
					</a>
					<?php } ?>
				</div>
			</div><!-- end .wpnews-medium-6 wpnews-columns -->

		</div><!-- end .news-list-content -->
	</div><!-- end .news-list -->
	
<?php } ?>