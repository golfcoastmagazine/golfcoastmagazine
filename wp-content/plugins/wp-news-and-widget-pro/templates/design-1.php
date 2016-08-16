<div class="news-slides">

	<?php if($showCategory == "true") {
			if($cate_name !='') { ?>
				<div class="news-categories">
				<?php echo $cate_name; ?>
				</div>
	<?php } } ?>

	<h2 class="news-title">
		<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
	</h2>

	<?php if($showDate == "true") { ?>
	<div class="news-date">		
		<?php echo get_the_date(); ?>
	</div>
	<?php } ?>

	<div class="news-image-bg">
		<?php if( !empty($post_featured_image) ) { ?>
		<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
			<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
		</a>
		<?php } ?>
	</div><!-- end .news-image-bg -->

</div><!-- end .news-slides -->