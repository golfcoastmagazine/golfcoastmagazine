<?php function wpspw_pro_post_slider( $atts, $content = null ){
            // setup the query
            extract(shortcode_atts(array(
		"limit" => '',	
		"category" => '',
		"category_name" => '',
		"show_read_more" => '',
		"design" => '',	
		"show_author" => '',		
        "show_date" => '',
        "show_category_name" => '',
        "show_content" => '',
        "content_words_limit" => '',
		"slides_column" => '',
		"slides_scroll" => '',
		"dots" => '',
		"arrows" => '',
		"autoplay" => '',
		"autoplay_interval" => '',
		"speed" => '',		
		"loop" => '',
		
		
		
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
	if( $show_read_more ) { 
		$showreadmore = $show_read_more; 
	} else {
		$showreadmore = 'true';
	}
	
	if( $design ) { 
		$blogdesign = $design; 
	} else {
		$blogdesign = 'design-8';
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
	
	if( $slides_column ) { 
		$blog_slides_column = $slides_column; 
	} else {
		$blog_slides_column = '3';
	}
	
	if( $slides_scroll ) { 
		$blog_slides_scroll = $slides_scroll; 
	} else {
		$blog_slides_scroll = '1';
	}
	
	if( $dots ) { 
		$blog_dots = $dots; 
	} else {
		$blog_dots = 'true';
	}
	
	if( $arrows ) { 
		$blog_arrows = $arrows; 
	} else {
		$blog_arrows = 'true';
	}
	
	if( $autoplay ) { 
		$blog_autoplay = $autoplay; 
	} else {
		$blog_autoplay = 'true';
	}
	
	if( $autoplay_interval ) { 
		$blog_autoplayInterval = $autoplay_interval; 
	} else {
		$blog_autoplayInterval = '2000';
	}
	
	if( $speed ) { 
		$blog_speed = $speed; 
	} else {
		$blog_speed = '300';
	}
	
	if( $loop ) { 
		$blog_loop = $loop; 
	} else {
		$blog_loop = 'true';
	}
	
	 if( $show_author ) { 
        $showAuthor = $show_author; 
    } else {
        $showAuthor = 'true';
    }
	
	
	ob_start();
	
	$unique			= wpspw_pro_get_unique();
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
		  $newscount = 0;	?>	  
		  
		  <div class="wpspw-pro-sp-slider-<?php echo $unique; ?> sp_wpspwpost_slider <?php echo $blogdesign; ?>">
		  
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             $count++;
               $terms = get_the_terms( $post->ID, WPSPW_CAT );
                    $blog_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $blog_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( " ", $blog_links );              
             
				
				switch ($blogdesign) {
				 case "design-1":
					include('designs/design-1.php');
					break;
				 case "design-2":
					include('designs/design-2.php');
					break;
				 case "design-3":
					include('designs/design-3.php');
					break;	
				 case "design-4":
					include('designs/design-4.php');
					break;
				 case "design-5":
					include('designs/design-5.php');
					break;	
				 case "design-6":
					include('designs/design-6.php');
					break;
				 case "design-7":
					include('designs/design-7.php');
					break;
                 case "design-8":
					include('designs/design-8.php');
					break;
				  case "design-9":
					include('designs/design-9.php');
					break;	
				 case "design-10":
					include('designs/design-10.php');
					break;	
                 case "design-11":
					include('designs/design-11.php');
					break;
				 case "design-12":
					include('designs/design-12.php');
					break;	
                  case "design-13":
					include('designs/design-13.php');
					break;	
				   case "design-14":
					include('designs/design-14.php');
					break;	
                   case "design-15":
					include('designs/design-15.php');
					break;
				  case "design-32":
					include('designs/design-32.php');
					break;
                   case "design-33":
					include('designs/design-33.php');
					break;
				 case "design-38":
					include('designs/design-38.php');
					break;		
				 default:					 
						include('designs/design-8.php');
					}
				
				
						   
			$newscount++;
            endwhile; 
			endif; ?>
			</div>          
				
			<?php			
             wp_reset_query();
			 
			 if ($blogdesign == 'design-1' || $blogdesign == 'design-2' || $blogdesign == 'design-3' || $blogdesign == 'design-4' || $blogdesign == 'design-5' || $blogdesign == 'design-38')
			{ ?>
	<script type="text/javascript">
    	jQuery(document).ready(function(){
		  	jQuery('.wpspw-pro-sp-slider-<?php echo $unique; ?>').slick({
		  	autoplay: <?php echo $blog_autoplay; ?>,
			dots: <?php echo $blog_dots; ?>,
			infinite: <?php echo $blog_loop; ?>,
			speed: <?php echo $blog_speed; ?>,
			arrows:<?php echo $blog_arrows; ?>,
			slidesToShow: 1,
			slidesToScroll: 1
		  });
    	});
  </script>
			<?php } else { ?>
	<script type="text/javascript">
    jQuery(document).ready(function(){
    
	  jQuery('.wpspw-pro-sp-slider-<?php echo $unique; ?>').slick({
	  	autoplay: <?php echo $blog_autoplay; ?>,
		dots: <?php echo $blog_dots; ?>,
		infinite: <?php echo $blog_loop; ?>,
		speed: <?php echo $blog_speed; ?>,
		arrows:<?php echo $blog_arrows; ?>,
		slidesToShow: <?php echo $blog_slides_column; ?>,
		slidesToScroll: <?php echo $blog_slides_scroll; ?>,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 800,
	  <?php if($blogdesign != 'design-14') { ?>
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
	  <?php } else { ?>
	   settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
	  <?php } ?>
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
   
  ]
	  });
	  

    });
  </script> 
				
			<?php }	return ob_get_clean();			             
	}
add_shortcode('wpspw_recent_post_slider','wpspw_pro_post_slider');