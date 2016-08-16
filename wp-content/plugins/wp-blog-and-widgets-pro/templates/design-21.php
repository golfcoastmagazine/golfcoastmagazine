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

<div class="blog-grid wp-medium-<?php echo $blogprogrid; ?> wpcolumns <?php echo $css_class; ?>">
	<div class="blog-grid-content">

		<div class="blog-image-bg">
			
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

		</div><!-- end .blog-image-bg -->

		<div class="blog-inner-content">

			<h2 class="blog-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($showDate == "true" || $showAuthor == 'true') { ?>
			<div class="blog-date">		
				<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div><!-- end .blog-date -->
			<?php }  ?>

		</div><!-- end .blog-inner-content -->

		<?php if($showContent == "true") {  ?>
		<div class="blog-content">
		<?php  if($showFullContent == "false" ) { ?>
			<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
		<?php if($showreadmore == 'true') { ?>
			<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( 'Read More', 'wp-blog-and-widgets' ); ?></a>
		<?php } 
			} else { 
				the_content();
			} ?>
		</div><!-- end .blog-content -->
		<?php } ?>

	</div><!-- end .blog-grid-content -->
</div><!-- end .blog-grid -->