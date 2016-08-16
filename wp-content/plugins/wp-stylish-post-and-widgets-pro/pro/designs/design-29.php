
	<?php
	global $post_id;	
	$wpspwpostfeat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );	
	if($newscount == "0") { ?>
		
			
			<div class="wpspw-medium-6 wpspw-columns responsive-padding">
		<div class="wpspwpost-image-bg">
			<img src="<?php echo $wpspwpostfeat_image; ?>"alt="<?php the_title(); ?>" />
			</div>
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
				<?php }  
				if($showContent == "true") {  ?>	
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
					<?php } ?>
				</div>
				<?php } ?>
			</div>			
			
			
			
			
	<?php } else { ?>
			
				
				<div class="wpspw-medium-6 wpspw-columns flotRight">
				<div class="wpspwpost-right-block wpspw-medium-12 wpspw-columns">
				<div class="wpspw-medium-3 wpspw-columns">
				<div class="wpspwpost-image-bg">
				<?php the_post_thumbnail('medium'); ?>
				</div>
				</div>
				<div class="wpspw-medium-9 wpspw-columns">
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
				<?php }  
				if($showContent == "true") {  ?>	
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
					<?php }  ?>
				</div>
				<?php } ?>
				</div>
				</div>

				</div>
		
	<?php } ?>
	