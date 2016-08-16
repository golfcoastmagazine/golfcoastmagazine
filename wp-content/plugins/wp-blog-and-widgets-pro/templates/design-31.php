<?php if($newscount == "0") { ?>
	
	<div class="wp-medium-6 wpcolumns responsive-padding">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="blog-image-bg">
			
			<?php if( !empty($feat_image) ) { ?>
			<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			<?php } ?>
			
			<div class="blog-fetured-content">
				<div class="blog-inner-content">

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
				<?php }   ?>

				</div><!-- end .blog-inner-content -->
			</div><!-- end .blog-fetured-content -->

		</div><!-- end .blog-image-bg -->
	</div><!-- end .wp-medium-6 -->
	
<?php } else {

	$medium_image = wpbaw_pro_get_post_featured_image( $post->ID, 'medium' );
	$medium_image = ($medium_image) ? $medium_image : $default_img;
?>
	
	<div class="wp-medium-6 wpcolumns flotRight">
		<div class="blog-right-block wp-medium-12 wpcolumns">

			<div class="wp-medium-3 wpcolumns">
				<div class="blog-image-bg">
					<?php if( !empty($medium_image) ) { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						<img src="<?php echo $medium_image; ?>" alt="<?php the_title(); ?>" />
					</a>
					<?php } ?>
				</div>
			</div>

			<div class="wp-medium-9 wpcolumns">
				<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h3 class="blog-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h3>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="blog-date">		
					<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>
			</div><!-- end .wp-medium-9 -->

		</div><!-- end .blog-right-block -->
	</div><!-- end .wp-medium-6 -->
	
<?php } ?>