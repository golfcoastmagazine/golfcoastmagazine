<?php
	if($newscount == "0") {
		$wpnw_post_large_image 	= wpnw_get_post_featured_image( $post->ID, 'large', true ); // Post large image
?>
	<div class="wpnews-medium-6 wpnews-columns">

		<div class="news-image-bg">
			<?php if(!empty($wpnw_post_large_image)) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $wpnw_post_large_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
			</a>
			<?php } ?>
		</div><!-- end .news-image-bg -->

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
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget'); ?></a>
			<?php } ?>
		</div><!-- end .news-content -->
		<?php } ?>
		
	</div><!-- end .wpnews-medium-6 wpnews-columns -->

<?php } else { ?>

	<div class="wpnews-medium-6 wpnews-columns flotRight">
		<div class="news-right-block">

			<?php if($showCategory == "true" && $cate_name !='') { ?>
			<div class="news-categories">	
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<h3 class="news-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h3>

			<?php if($showDate == "true") { ?>	
			<div class="news-date">		
				<?php echo get_the_date(); ?>
			</div>
			<?php } ?>
			
			<?php if($showContent == "true") { ?>
				<div class="news-content">

					<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

					<?php if($showreadmore == 'true') { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget'); ?></a>
					<?php } ?>

				</div><!-- end .news-content -->
			<?php } ?>

		</div><!-- end .news-right-block -->
	</div><!-- end .wpnews-medium-6 wpnews-columns -->

<?php } ?>