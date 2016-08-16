<?php 
/* Home short code [recent_blog_post limit="10"] */

function wpspw_pro_get_homeblog( $atts, $content = null ){
            // setup the query
            extract(shortcode_atts(array(
		"limit" => '',	
		"category" => '',
		"category_name" => '',
		"grid" => '',
		"design" => '',
		"show_author" => '',
		"show_full_content" => '',
        "show_date" => '',
        "show_category_name" => '',
        "show_content" => '',
        "content_words_limit" => '',
		"show_read_more" => '',
	), $atts));
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	if( $category ) { 
		$cat = $category; 
	} else {
		$cat = '';
	}
	if( $grid ) { 
		$gridcol = $grid; 
	} else {
		$gridcol = '0';
	}
	
	if( $category_name ) { 
		$blogcategory_name = $category_name; 
	} else {
		$blogcategory_name = '';
	}
	
	if( $design ) { 
		$blogdesign = $design; 
	} else {
		$blogdesign = 'design-16';
	}
	
	 if( $show_full_content ) { 
        $showFullContent = $show_full_content; 
    } else {
        $showFullContent = 'false';
    }
    if( $show_date ) { 
        $showDate = $show_date; 
    } else {
        $showDate = 'true';
    }
	if( $show_category_name ) { 
        $showCategory = $show_category_name; 
    } else {
        $showCategory = 'true';
    }
    if( $show_content ) { 
        $showContent = $show_content; 
    } else {
        $showContent = 'true';
    }
	 if( $content_words_limit ) { 
        $words_limit = $content_words_limit; 
    } else {
        $words_limit = '20';
    }
	 if( $show_author ) { 
        $showAuthor = $show_author; 
    } else {
        $showAuthor = 'true';
    }
	if( $show_read_more ) { 
		$showreadmore = $show_read_more; 
	} else {
		$showreadmore = 'true';
	}
	ob_start();
	
	$post_type 		= WPSPW_POST_TYPE;
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				 
		
        $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,   
           
            ); 
            if($cat != ""){
                $args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $cat) );
            }      
        $query = new WP_Query($args);
		global $post;
      $post_count = $query->post_count;
          $count = 0;
		    $newscount = 0; ?>
			
			   <div class="sp_wpspwpost_static <?php echo $blogdesign; ?>">
		   <?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31")     { ?>
		   <div class="wpspwpost-block ">		   
		   <?php } 
		    if ( $blogcategory_name != '')      { ?>
		   <h1 class="category-title-main">
							<?php echo $blogcategory_name; ?>
						</h1>
		  
			<?php  }
		  
		  
             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             $count++;
               $terms = get_the_terms( $post->ID, WPSPW_CAT );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( " ", $news_links );
                $css_class="blogfirstlast";
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }
               
                ?>
			<?php
			switch ($blogdesign) {	
				 case "design-16":
					include('designs/design-16.php');
					break;
				case "design-17":
					include('designs/design-17.php');
					break;
                case "design-18":
					include('designs/design-18.php');
					break;
				 case "design-19":
					include('designs/design-19.php');
					break;	
                 case "design-20":
					include('designs/design-20.php');
					break;	
                   case "design-21":
					include('designs/design-21.php');
					break;	
                  case "design-22":
					include('designs/design-22.php');
					break;
                  case "design-25":
					include('designs/design-25.php');
					break;	
                  case "design-26":
					include('designs/design-26.php');
					break;	
				  case "design-27":
					include('designs/design-27.php');
					break;			
				case "design-28":
					include('designs/design-28.php');
					break;	
				case "design-29":
					include('designs/design-29.php');
					break;			
				case "design-31":
					include('designs/design-31.php');
					break;	
				case "design-34":
					include('designs/design-34.php');
					break;	
				case "design-35":
					include('designs/design-35.php');
					break;
				case "design-37":
					include('designs/design-37.php');
					break;		
				 default:					 
						include('designs/design-16.php');
					}
					
					

				
          $newscount++;
            endwhile; ?>
			 <?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31")     { ?>
		   </div>		   
		   <?php }
		   endif; ?>
			</div>
			<?php
             wp_reset_query(); 
				
		return ob_get_clean();			             
	}
add_shortcode('wpspw_recent_post','wpspw_pro_get_homeblog');