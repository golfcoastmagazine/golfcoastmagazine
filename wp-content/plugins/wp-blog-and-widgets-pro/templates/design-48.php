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

<div class="blog-list wp-medium-<?php echo $blogprogrid; ?> wpcolumns">
	<div class="blog-list-content">

		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wp-medium-5 wpcolumns">
			<div class="blog-image-bg">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
		</div>
		<?php } ?>

		<div class="<?php if ( !has_post_thumbnail() ) { echo 'wp-medium-12 wpcolumns'; } else { echo 'wp-medium-7 wpcolumns'; } ?>">

			<div class="blog-content-all">

			<h2 class="blog-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($showCategory == "true") { ?>
			<div class="blog-categories">	
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<?php if($showDate == "true" || $showAuthor == 'true') { ?>	
			<div class="blog-date">		
				<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div>
			<?php } ?>
			
			<?php if($showContent == "true") { ?>
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
			
			</div><!--end .blog-content-all-->

		</div>

	</div><!-- end .blog-list-content -->
</div><!-- end .blog-list -->