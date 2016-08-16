<div class="blog-slides">  
	<div class="blog-grid-content">
		<div class="blog-overlay">

		<?php if(0 == $newscount % 2 ) { ?>
			<div class="blog-image-bg withimage">
				
				<?php if( !empty($feat_image) ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				</a>
				<?php } ?>

				<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<div class="blog-content">
					<h2 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showDate == "true" || $showAuthor == 'true') { ?>
					<div class="blog-date">		
						<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
						<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
						<?php if($showDate == "true") { echo get_the_date(); } ?>
					</div>
					<?php } ?>
				</div><!-- end .blog-content -->
				
			</div><!-- end .blog-image-bg -->
			
		<?php } else { ?>

			<div class="blog-short-content withoutimgblue">

				<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
						<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<div class="bottom-content">
			
					<h2 class="blog-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showContent == "true") { ?>
					<div class="blog-content">
						<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

						<?php if($showreadmore == 'true') { ?>
							<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( 'Read More', 'wp-blog-and-widgets' ); ?></a>
						<?php } ?>
					</div><!-- end .blog-content -->
					<?php } ?>

					<?php if($showDate == "true" || $showAuthor == 'true') { ?>
					<div class="blog-date">
						<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By ', 'wp-blog-and-widgets' ) .the_author(); ?></span><?php } ?>
						<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
						<?php if($showDate == "true") { echo get_the_date(); } ?>
					</div>
					<?php } ?>

				</div><!--end .bottom-content -->
			</div><!-- end .blog-short-content -->
			
		<?php } ?>

		</div><!-- end .blog-overlay -->
	</div><!-- end .blog-grid-content -->
</div><!-- end .blog-slides -->