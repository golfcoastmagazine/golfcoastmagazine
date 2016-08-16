<?php 
global $post_id;
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) ); ?>
  <div class="wpspwpost-slides">
 <?php if($showCategory == "true") { ?>
				<div class="wpspwpost-categories">	
							<?php echo $cate_name; ?>			
			
					</div>
				<?php } ?>
  <h2 class="wpspwpost-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
		<?php if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="wpspwpost-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php }   ?>
		<div class="wpspwpost-image-bg">
	<img src="<?php echo $feat_image; ?>"alt="<?php the_title(); ?>" />
	</div>
	</div>
 
   
