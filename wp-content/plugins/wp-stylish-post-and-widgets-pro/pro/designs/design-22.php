<?php 
if($gridcol == '2')
		{
			$wpspwpostprogrid = "6";
		} else if($gridcol == '3')
		{
			$wpspwpostprogrid = "4";
		}  else if($gridcol == '4')
		{
			$wpspwpostprogrid = "3";
		} else if ($gridcol == '1')
		{
			$wpspwpostprogrid = "12";
		} else {
			$wpspwpostprogrid = "12";
		}
	global $post_id;	
	$wpspwpostfeat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );	
		?>
	 <div class="wpspwpost-grid wpspw-medium-<?php echo $wpspwpostprogrid; ?> wpspw-columns <?php echo $css_class; ?>">
	 <div class="wpspwpost_overlay">
  <div class="wpspwpost-image-bg">
				<img src="<?php echo $wpspwpostfeat_image; ?>"alt="<?php the_title(); ?>" />
			</div>
		<div class="wpspwpost-grid-content">
		
			<?php if($showCategory == "true") { ?>
				<div class="wpspwpost-categories">	
							<?php echo $cate_name; ?>			
			
					</div>
				<?php } ?>
		<div class="wpspwpost-content">
			 <h2 class="wpspwpost-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="wpspwpost-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php }  ?>
				</div>
		</div>
		</div>
	</div>
  
	
