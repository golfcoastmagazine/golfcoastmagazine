<div class="news-slides">  
	<div class="news-grid-content">
		<div class="news-overlay">

			<div class="wpnews-medium-6 wpnews-columns">
				<div class="news-image-bg">
					
					<?php if( !empty($post_featured_image) ) { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
					</a>
					<?php } ?>

					<?php if( $showCategory == "true" && $cate_name !='' ) { ?>
					<div class="news-categories">	
					<?php echo $cate_name; ?>
					</div>
					<?php } ?>

				</div><!-- end .news-image-bg -->
			</div><!-- end .wpnews-medium-6 wpnews-columns -->

			<div class="wpnews-medium-6 wpnews-columns">
				<div class="news-short-content">
					<div class="bottom-content">

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
							
							<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
							
							<?php if($showreadmore == 'true') { ?>
							<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget' ); ?></a>
							<?php } ?>
						</div>
						<?php } ?>
						
					</div><!-- end .bottom-content -->
				</div><!-- end .news-short-content -->
			</div><!-- end .wpnews-medium-6 wpnews-columns -->

		</div><!-- end .news-overlay -->
	</div><!-- end .news-grid-content -->
</div><!-- end .news-slides -->