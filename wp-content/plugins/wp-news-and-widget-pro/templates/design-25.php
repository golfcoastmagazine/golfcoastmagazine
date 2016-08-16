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

<?php if(0 == $newscount % 2 ) { ?>
	<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns <?php echo $css_class; ?>">
  		<div class="news-image-bg">

			<?php if( !empty($post_featured_image) ) { ?>
			<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
			<?php } ?>

			<div class="news-grid-content">
		
				<div class="slideline"></div>

				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="news-categories">	
					<?php echo $cate_name; ?>
				</div><!-- end .news-categories -->
				<?php } ?>

				<div class="news-content">

					<h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showDate == "true") { ?>
					<div class="news-date">		
						<?php echo get_the_date(); ?>
					</div>
					<?php } ?>

				</div><!-- end .news-content -->

			</div><!-- end .news-grid-content -->
		</div><!-- end .news-image-bg -->
	</div><!-- end .news-grid -->
	
 <?php } else {  ?>

	<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns noimage <?php echo $css_class; ?>">
 		<div class="news-grid-content"> 
			
			<?php if($showCategory == "true" && $cate_name !='') { ?>
			<div class="news-categories">
			<?php echo $cate_name; ?>
			</div>
			<?php } ?>

			<h2 class="news-title">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
			</h2>

			<?php if($showContent == "true") {  ?>	
			<div class="news-content">				
				
				<div><?php echo wpnw_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" class="readmorebtn"><?php esc_html_e( 'Read More', 'sp-news-and-widget'); ?></a>
				<?php } ?>
			</div>
			<?php } ?>
			
			<?php if($showDate == "true") { ?>
			<div class="news-date">
				<?php echo get_the_date(); ?>
			</div>
			<?php } ?>
			
		</div><!-- end .news-grid-content -->
	</div><!-- end .news-grid -->
	
 <?php } ?>