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
<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
	<div class="blog-image-bg">
		
		<?php if( !empty($feat_image) ) { ?>
		<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
		</a>
		<?php } ?>
	
		<div class="blog-while-overlay">
			<div class="blog-while-overlay-inner">

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
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>
				
			</div><!-- end .blog-while-overlay-inner -->
		</div><!-- end .blog-while-overlay -->
	</div><!-- end .blog-image-bg -->
</div><!-- end .blog-grid -->