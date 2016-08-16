<?php 
if($gridcol == '2')
		{
			$blogprogrid = "6";
		} else if($gridcol == '3')
		{
			$blogprogrid = "4";
		}  else if($gridcol == '4')
		{
			$blogprogrid = "3";
		} else if ($gridcol == '1')
		{
			$blogprogrid = "12";
		} else {
			$blogprogrid = "12";
		}
		
		?>

	  <div class="blog-grid wpspw-medium-<?php echo $blogprogrid; ?> wpspw-columns <?php echo $css_class; ?>">			
	
<div class="blog-grid-content">
		<div class="blog-image-bg">
			<?php the_post_thumbnail('url'); ?>
			<?php if($showCategory == "true") { ?>
				<div class="blog-categories">	
							<?php echo $cate_name; ?>			
			
					</div>
				<?php } ?>
			</div>
			<div class="blog-inner-content">
			 <h2 class="blog-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if($showDate == "true" || $showAuthor == 'true')    {  ?>	
			<div class="blog-date">		
				<?php  if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wpspw-post-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
				<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php }  ?>
				</div>
				<?php if($showContent == "true") {  ?>	
				<div class="blog-content">
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
  
	
