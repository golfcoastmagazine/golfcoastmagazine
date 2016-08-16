
 <div class="wpspwpost-slides">  
		<div class="wpspwpost-grid-content">
		<div class="wpspwpost-overlay">
			<div class="wpspwpost-image-bg">
					<?php the_post_thumbnail('url'); ?>
				 <?php if($showCategory == "true") { ?>
				<div class="wpspwpost-categories">	
							<?php echo $cate_name; ?>			
		
					</div>
				<?php } ?>
			</div>
			<div class="wpspwpost-short-content">
			 <h2 class="wpspwpost-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="wpspwpost-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>
			</div>	
			</div>	
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
					<?php } ?>
				</div>
				<?php } ?>
				
		</div>
	</div>