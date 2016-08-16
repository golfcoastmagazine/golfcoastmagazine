
<div class="wpspwpost-grid wpspw-medium-3 wpspw-columns">
 <div class="wpspwpost-grid-content">
 <div class="wpspwpost-image-bg">
			<?php the_post_thumbnail('url'); ?>
			</div>
				<?php if($showCategory == "true") { ?>
				<div class="wpspwpost-categories">	
							<?php echo $cate_name; ?>			
			
					</div>
				<?php } ?>
			 <h3 class="wpspwpost-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<?php if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="wpspwpost-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php }  ?>
		</div>
	
	</div>
  
	
