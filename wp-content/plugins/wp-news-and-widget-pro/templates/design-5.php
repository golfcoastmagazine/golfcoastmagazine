<div class="news-slides">
	<div class="news-content-position">

		<div class="news-content-left wpnews-medium-8 wpnews-columns">
			
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
					
					<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

					<?php if($showreadmore == 'true') { ?>
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget' ); ?></a>
					<?php } ?>
				</div>
			<?php } ?>
			
		</div><!-- end .news-content-left -->
		
		<div class="news-image-bg">
			<?php if(!empty($post_featured_image)) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
			</a>
			<?php } ?>
		</div>
		
	</div><!-- end .news-content-position -->
</div><!-- end .news-slides -->