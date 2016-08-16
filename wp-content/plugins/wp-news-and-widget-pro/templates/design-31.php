<?php if($newscount == "0") { ?>

	<div class="wpnews-medium-6 wpnews-columns">
		<div class="news-image-bg">
			<?php if( !empty($post_featured_image) ) { ?>
				<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
			<?php } ?>

			<div class="news-fetured-content">
				<div class="news-inner-content">

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

				</div><!-- end .news-inner-content -->
			</div><!-- end .news-fetured-content -->
		</div><!-- end .news-image-bg -->
	</div><!-- end .wpnews-medium-6 wpnews-columns -->
	
<?php } else {
	$wpnw_post_medium_image = wpnw_get_post_featured_image( $post->ID, 'medium', true ); // Post large image
?>
	
	<div class="wpnews-medium-6 wpnews-columns flotRight">
		<div class="news-right-block wpnews-medium-12 wpnews-columns">

			<div class="wpnews-medium-3 wpnews-columns">
				<div class="news-image-bg">
					<?php if(!empty($wpnw_post_medium_image)) { ?>
					<img src="<?php echo $wpnw_post_medium_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
					<?php } ?>
				</div>
			</div><!-- end .wpnews-medium-3 wpnews-columns -->

			<div class="wpnews-medium-9 wpnews-columns">
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
			</div><!-- end .wpnews-medium-9 wpnews-columns -->

		</div><!-- end .news-right-block -->
	</div><!-- end .wpnews-medium-6 wpnews-columns -->

<?php } ?>