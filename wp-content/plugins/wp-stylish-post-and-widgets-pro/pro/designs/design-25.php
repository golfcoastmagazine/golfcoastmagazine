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

 <?php if(0 == $newscount % 2 ) { ?>
 <div class="wpspwpost-grid wpspw-medium-<?php echo $wpspwpostprogrid; ?> wpspw-columns <?php echo $css_class; ?>">
  <div class="wpspwpost-image-bg">
			<img src="<?php echo $wpspwpostfeat_image; ?>"alt="<?php the_title(); ?>" />
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
	
 <?php } else {  ?> 
	   <div class="wpspwpost-grid wpspw-medium-<?php echo $wpspwpostprogrid; ?> wpspw-columns noimage">
 <div class="wpspwpost-grid-content">
 
		
			<?php if($showCategory == "true") { ?>
				<div class="wpspwpost-categories">	
							<?php echo $cate_name; ?>			
		
					</div>
				<?php } ?>
			 <h2 class="wpspwpost-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if($showContent == "true") {  ?>	
				<div class="wpspwpost-content">
				<?php 
				$customExcerpt = get_the_excerpt();				
					if (has_excerpt($post->ID))  { ?>
						<div><?php echo $customExcerpt ; ?></div>
					<?php } else { 
					$excerpt = strip_tags(get_the_content()); ?>
					<div><?php echo wpspw_pro_limit_words($excerpt,$words_limit); ?></div>					
					<?php } 
					if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wpspw-post-and-widgets' ); ?></a>
					<?php }   ?>
				</div>
				<?php }
				if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="wpspwpost-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php }  ?>
		</div>
	</div>
	 
 <?php } ?> 
	
  
	
