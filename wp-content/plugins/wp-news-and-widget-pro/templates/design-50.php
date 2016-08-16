 <?php 
if($gridcol == '2') {
	$newsprogrid = "6";
} else if($gridcol == '3') {
	$newsprogrid = "4";
}  else if($gridcol == '4') {
	$newsprogrid = "3";
} else if ($gridcol == '1') {
	$newsprogrid = "12";
} else {
	$newsprogrid = "12";
}
?>

<div class="news-list wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns">
	<div class="news-list-content">

		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wpnews-medium-5 wpnews-columns">
			<div class="news-image-bg">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
		</div>
		<?php } ?>

		<div class="<?php if ( !has_post_thumbnail() ) { echo 'wpnews-medium-12 wpnews-columns'; } else { echo 'wpnews-medium-7 wpnews-columns'; } ?>">

			<div class="news-content-all">

			<h2 class="news-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($showCategory == "true") { ?>
			<div class="news-categories">	
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<?php if($showDate == "true") { ?>	
			<div class="news-date">
				<?php if($showDate == "true") { echo get_the_date(); } ?>
			</div>
			<?php } ?>
			
			<?php if($showContent == "true") { ?>
			<div class="news-content">
			<?php  if($showFullContent == "false" ) { ?>
				
				<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
				
				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( 'Read More', 'wp-news-and-widgets' ); ?></a>
				<?php } 
				 } else { 
					the_content();
				} ?>
			</div><!-- end .news-content -->
			<?php } ?>
			
			</div><!--end .news-content-all-->

		</div>

	</div><!-- end .news-list-content -->
</div><!-- end .news-list -->