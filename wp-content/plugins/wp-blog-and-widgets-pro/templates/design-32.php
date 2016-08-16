<div class="blog-slides">  
	<div class="blog-grid-content">

		<div class="blog-overlay">
			
			<div class="blog-image-bg">
				<?php if( !empty($feat_image) ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				</a>
				<?php } ?>
			</div>
			
			<div class="blog-short-content">
				<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>
				
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
			</div><!-- end .blog-short-content -->

			<?php if($showContent == "true") { ?>
			<div class="blog-content">

				<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( 'Read More', 'wp-blog-and-widgets' ); ?></a>
				<?php } ?>
			</div>
			<?php } ?>
			
		</div><!-- end .blog-overlay -->

	</div><!-- end .blog-grid-content -->
</div><!-- end .blog-slides -->