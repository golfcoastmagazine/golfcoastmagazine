<div class="blog-slides"> 
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
	<div class="blog-grid-content">
		<div class="blog-overlay">

			<div class="blog-image-bg">
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				<?php } ?>

				<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>
			</div><!-- end .blog-image-bg -->

			<div class="blog-short-content">
				<div class="bottom-content">

				 <h2 class="blog-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="blog-date">		
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				</div><!-- end .bottom-content -->
			</div><!-- end .blog-short-content -->

		</div><!-- end .blog-overlay -->
	</div><!-- end .blog-grid-content -->
</div><!-- end .blog-slides -->