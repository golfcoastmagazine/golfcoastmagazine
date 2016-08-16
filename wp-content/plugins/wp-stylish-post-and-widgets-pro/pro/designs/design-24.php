
<?php
 if(0 == $newscount % 2 ) { ?>	
	 <div class="wpspwpost-list">
		<div class="wpspwpost-list-content">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wpspw-medium-6 wpspw-columns">
		<div class="wpspwpost-image-bg">
			<?php the_post_thumbnail('url'); ?>
			</div>
			</div>
			<?php } ?>
			<div class="<?php if ( !has_post_thumbnail() ) { echo 'wpspw-medium-12 wpspw-columns'; } else { echo 'wpspw-medium-6 wpspw-columns'; } ?>">
			<?php if($showCategory == "true")  {
					if($cate_name !='') {	?>
			<div class="wpspwpost-categories">	
			<?php echo $cate_name; ?>			
	
		</div>
			<?php } } ?>
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
				<?php  if($showFullContent == "false" ) {
				$customExcerpt = get_the_excerpt();				
					if (has_excerpt($post->ID))  { ?>
						<div><?php echo $customExcerpt ; ?></div>
					<?php } else { 
					$excerpt = strip_tags(get_the_content()); ?>
					<div><?php echo wpspw_pro_limit_words($excerpt,$words_limit); ?></div>					
					<?php } 
					if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wpspw-post-and-widgets' ); ?></a>
					<?php } 
					 } 
					 else { 
							the_content();
						 } ?>
				</div>
				<?php } ?>
				
				</div>
		</div>
	</div>
	
<?php } else { ?>
	  <div class="wpspwpost-list">
		<div class="wpspwpost-list-content">
		
			<div class="<?php if ( !has_post_thumbnail() ) { echo 'wpspw-medium-12 wpspw-columns'; } else { echo 'wpspw-medium-6 wpspw-columns'; } ?>">
			<?php if($showCategory == "true")  {
					if($cate_name !='') {	?>
			<div class="wpspwpost-categories">	
			<?php echo $cate_name; ?>			
	
		</div>
			<?php } } ?>
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
				<?php  if($showFullContent == "false" ) {
				$customExcerpt = get_the_excerpt();				
					if (has_excerpt($post->ID))  { ?>
						<div><?php echo $customExcerpt ; ?></div>
					<?php } else { 
					$excerpt = strip_tags(get_the_content()); ?>
					<div><?php echo wpspw_pro_limit_words($excerpt,$words_limit); ?></div>					
					<?php } 
					if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'wpspw-post-and-widgets' ); ?></a>
					<?php } 
					 } 
					 else { 
							the_content();
						 } ?>
				</div>
				<?php } ?>
				
				</div>
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="wpspw-medium-6 wpspw-columns">
		<div class="wpspwpost-image-bg">
			<?php the_post_thumbnail('url'); ?>
			</div>
			</div>
				<?php } ?>
		</div>
	</div>
	
<?php } ?>
  
	
