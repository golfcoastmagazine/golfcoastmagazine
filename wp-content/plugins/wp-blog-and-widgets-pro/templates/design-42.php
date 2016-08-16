<?php 
if($gridcol == '2') {
	$blogprogrid = "6";
} else if($gridcol == '3') {
	$blogprogrid = "4";
}  else if($gridcol == '4') {
	$blogprogrid = "3";
} else if ($gridcol == '1') {
	$blogprogrid = "12";
} else {
	$blogprogrid = "12";
}
?>

<div class="blog-grid wpbaw-clr-<?php echo $grid_count; ?> wp-medium-<?php echo $blogprogrid; ?> wpcolumns <?php echo $css_class; ?>">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
	<div class="blog_overlay">
  		
  		<div class="blog-image-bg">
			<?php if( !empty($feat_image) ) { ?>
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div>

		<div class="blog-grid-content">

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
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>
			</div><!-- end .blog-content -->

		</div><!-- end .blog-grid-content -->

	</div><!-- end .blog_overlay -->
</div><!-- end .blog-grid -->
<?php
	if( $grid_count == 5 || ( $post_count == $count ) ) {
		$grid_count = 0;
?>
<?php } ?>