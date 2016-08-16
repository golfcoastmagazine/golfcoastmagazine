<?php 
/*Latest News Slider Widget*/
class SP_Newspro_Widget extends WP_Widget {

    function __construct() {
		
        $widget_ops = array('classname' => 'SP_Newspro_Widget', 'description' => __('Displayed Latest News Items with slider', 'sp-news-and-widget') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_newspro_widget' );
        parent::__construct( 'sp_newspro_widget', __('Latest News Slider Widget', 'sp-news-and-widget'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
		'arrows'            => "true",
        'autoplay'          => "true",      
        'autoplayInterval'  => 5000,                
        'speed'             => 500,
        'link_target'       => 0
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
     <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'sp-news-and-widget' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'sp-news-and-widget' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
 <!-- Widget Order: Select Arrows -->
        <p>
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['arrows'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>		
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] ); 
		$instance['arrows']             = esc_attr( $new_instance['arrows'] );
        $instance['autoplay']           = esc_attr( $new_instance['autoplay'] );
        $instance['autoplayInterval']   = intval( $new_instance['autoplayInterval'] );
        $instance['speed']              = intval( $new_instance['speed'] );
        $instance['link_target']        = !empty($new_instance['link_target']) ? 1 : 0;
        return $instance;
    }
	
	 function get_other_options () {
		
         $args = array(
                    'true' => __( 'True', 'sp-news-and-widget' ),
                    'false' => __( 'False', 'sp-news-and-widget' )
                    );    
         return $args;
        }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        if ( isset( $instance['arrows'] ) && in_array( $instance['arrows'], array_keys( $this->get_other_options() ) ) ) { $args['arrows'] = $instance['arrows']; }
        if ( isset( $instance['autoplay'] ) && in_array( $instance['autoplay'], array_keys( $this->get_other_options() ) ) ) { $args['autoplay'] = $instance['autoplay']; }
        if ( isset( $instance['autoplayInterval'] ) && ( 0 < count( $instance['autoplayInterval'] ) ) ) { $args['autoplayInterval'] = intval( $instance['autoplayInterval'] ); }
        if ( isset( $instance['speed'] ) && ( 0 < count( $instance['speed'] ) ) ) { $args['speed'] = intval( $instance['speed'] ); }
		$link_target = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $postcount = 0;
        $unique = wpnw_pro_get_unique();

        echo $before_widget;

?>
             <h2 class="widget-title"><?php echo $title ?></h2>
            
            <div class="wpnw-pro-sp-news-slider-<?php echo $unique; ?> sp_news_slider wpnw-has-slider design-w1">
              
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
                    $post_link              = wpnw_pro_get_post_link( $post->ID );
                    $post_featured_image    = wpnw_get_post_featured_image( $post->ID, '', true );
                    $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( " ", $news_links );
                    ?>
					
					 <div class="news-slides">  
						<div class="news-grid-content">
						<div class="news-overlay">
							<div class="news-image-bg">
							
                                <?php if( !empty($post_featured_image) ) { ?>
                                    <img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
                                <?php } ?>

								<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							</div>
							<div class="news-short-content">
							 <h2 class="news-title">
								<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h2>
						<?php if($date == "true") { ?>
							<div class="news-date">		
								<?php echo get_the_date(); ?>
								</div>
						<?php }?>
							</div>	
							</div>	
								
						</div>
					</div>
				
                 
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

  
            </div>
			 <script type="text/javascript">
    jQuery(document).ready(function(){
   
	     jQuery('.wpnw-pro-sp-news-slider-<?php echo $unique; ?>').slick({
			dots: false,
			infinite: true,
			speed: <?php echo $instance['speed']?>,
			arrows:<?php echo $instance['arrows']?>,
			autoplay: <?php echo $instance['autoplay']?>,
			autoplaySpeed:<?php echo $instance['autoplayInterval']?>,
			slidesToShow: 1,
			slidesToScroll: 1
	  });
	  

    });


  </script>
<?php
        echo $after_widget;
    }
}

function sp_news_widgetpro_load_widgets() {
    register_widget( 'SP_Newspro_Widget' );
}

add_action( 'widgets_init', 'sp_news_widgetpro_load_widgets' );

/*Latest News List/Slider-1*/
class SP_Newslistpro_Widget extends WP_Widget {

    function __construct() {
		
        $widget_ops = array('classname' => 'SP_Newslistpro_Widget', 'description' => __('Displayed Latest News Items in list view OR in Slider', 'sp-news-and-widget') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_newslistpro_widget' );
        parent::__construct( 'sp_newslistpro_widget', __('Latest News List/Slider-1', 'sp-news-and-widget'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
		'active_slider'     => "false",
		'dots'              => "true",
        'autoplay'          => "true",      
        'autoplayInterval'  => 5000,                
        'speed'             => 500,
        'link_target'       => 0
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'sp-news-and-widget' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>	
		<!-- Active Slider -->
		 <p>
		<h3><?php esc_html_e( 'News Slider Setting:', 'sp-news-and-widget' ); ?></h3> 
		 <hr />
            <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox"<?php checked( $instance['active_slider'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( '<b>Check this box to Display News in Slider View.</b> <br /><em>By default News Display in List View</em>', 'sp-news-and-widget' ); ?></label>
        </p>
		
		<!-- Widget Order: Select dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['dots'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
		$instance['active_slider'] = (bool) esc_attr( $new_instance['active_slider'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );
		$instance['dots']             = esc_attr( $new_instance['dots'] );
        $instance['autoplay']           = esc_attr( $new_instance['autoplay'] );
        $instance['autoplayInterval']   = intval( $new_instance['autoplayInterval'] );
        $instance['speed']              = intval( $new_instance['speed'] );
        $instance['link_target']        = !empty($new_instance['link_target']) ? 1 : 0;
        return $instance;
    }
	
	 function get_other_options () {
		
         $args = array(
                    'true' => __( 'True', 'sp-news-and-widget' ),
                    'false' => __( 'False', 'sp-news-and-widget' )
                    );    
         return $args;
        }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
		if ( isset( $instance['active_slider'] ) && ( 1 == $instance['active_slider'] ) ) { $activeSlider = "true"; } else { $activeSlider = "false"; }	
		if ( isset( $instance['dots'] ) && in_array( $instance['dots'], array_keys( $this->get_other_options() ) ) ) { $args['dots'] = $instance['dots']; }
        if ( isset( $instance['autoplay'] ) && in_array( $instance['autoplay'], array_keys( $this->get_other_options() ) ) ) { $args['autoplay'] = $instance['autoplay']; }
        if ( isset( $instance['autoplayInterval'] ) && ( 0 < count( $instance['autoplayInterval'] ) ) ) { $args['autoplayInterval'] = intval( $instance['autoplayInterval'] ); }
        if ( isset( $instance['speed'] ) && ( 0 < count( $instance['speed'] ) ) ) { $args['speed'] = intval( $instance['speed'] ); }
        $link_target    = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $slider_cls     = ($activeSlider == 'true') ? 'wpnw-has-slider' : '';
        $postcount = 0;
        $unique = wpnw_pro_get_unique();

        echo $before_widget;

?>
             <h2 class="widget-title"><?php echo $title ?></h2>
           
            <div class="wpnw-pro-sp-news-static-<?php echo $unique; ?> <?php echo $slider_cls; ?> sp_news_static design-w2">
            
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
            global $post;
            $post_count = $cust_loop->post_count;
            $count = 0;
            
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                $count++;
                $post_link              = wpnw_pro_get_post_link( $post->ID );
                $post_featured_image    = wpnw_get_post_featured_image( $post->ID, '', true );
                $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $news_links );
                    ?>
					
					
					 <div class="news-grid">
						  <div class="news-image-bg">
								
                                <?php if( !empty($post_featured_image) ) { ?>
                                <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
                                    <img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
                                </a>
                                <?php } ?>
								
                                <?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
								</div>
								<div class="news-grid-content">
								<div class="news-content">
									 <div class="news-title">
										<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</div>
									<?php if($date == "true") { ?>
							<div class="news-date">		
								<?php echo get_the_date(); ?>
								</div>
						<?php }?>
										</div>
								</div>
								
							</div>
				
                 
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

  
            </div>
		<?php $activeSlider =  $instance['active_slider'];
			if($activeSlider == 'true') { ?>
			
			<script type="text/javascript">
    jQuery(document).ready(function(){
   
	     jQuery('.wpnw-pro-sp-news-static-<?php echo $unique; ?>').slick({
			dots: <?php echo $instance['dots']?>,
			infinite: true,
			speed: <?php echo $instance['speed']?>,
			arrows:false,
			autoplay: <?php echo $instance['autoplay']?>,
			autoplaySpeed:<?php echo $instance['autoplayInterval']?>,
			slidesToShow: 1,
			slidesToScroll: 1
	  });
	  

    });


  </script>  
			
<?php
			}
        echo $after_widget;
    }
}

function sp_news_widgetlistpro_load_widgets() {
    register_widget( 'SP_Newslistpro_Widget' );
}

add_action( 'widgets_init', 'sp_news_widgetlistpro_load_widgets' );

/*Latest News Widget*/
class PRO_SP_News_Widget extends WP_Widget {

    function __construct() {
		
        $widget_ops = array('classname' => 'PRO_SP_News_Widget', 'description' => __('Displayed Latest News Items from the News  in a sidebar', 'sp-news-and-widget') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'pro_sp_news_widget' );
        parent::__construct( 'pro_sp_news_widget', __('Latest News Widget', 'sp-news-and-widget'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
        'link_target'       => 0
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
     <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'sp-news-and-widget' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'sp-news-and-widget' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>	
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );
        $instance['link_target']   = !empty($new_instance['link_target']) ? 1 : 0;
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        $link_target = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $postcount = 0;

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>

            <div class="recent-news-items">
                <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
                    $post_link              = wpnw_pro_get_post_link( $post->ID );
                    $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( " ", $news_links );
                    ?>
                     <li class="news_li">
					<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
                       <div class="news-title"> <a class="post-title" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php if($date == "true") { ?>
							<div class="news-date"><?php echo get_the_date(); ?></div>
						<?php } ?>
                    </li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

                </ul>
            </div>
<?php
        echo $after_widget;
    }
}

function pro_sp_news_widget_load_widgets() {
    register_widget( 'PRO_SP_News_Widget' );
}

add_action( 'widgets_init', 'pro_sp_news_widget_load_widgets' );

/* Latest News Scrolling Widget */
class PRO_SP_News_scrolling_Widget extends WP_Widget {
	
    function __construct() {
		
        $widget_ops = array('classname' => 'PRO_SP_News_scrolling_Widget', 'description' => __('Displayed Latest News Items from the News  in a sidebar', 'sp-news-and-widget') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'pro_sp_news_scrolling_widget' );
        parent::__construct( 'pro_sp_news_scrolling_widget', __('Latest News Scrolling Widget', 'sp-news-and-widget'), $widget_ops, $control_ops );
    }
    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
		'show_thumb'     	=> false,
        'category'         	=> 0,
		'height'          	=> 400,      
        'pause'  			=> 2000,                
        'speed'             => 500,
        'link_target'       => 0
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;              
    ?>
     <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>
		 <p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox"<?php checked( $instance['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( '<strong>Check this box to display Thumbnail in left side<br /></strong><em>By default display without Thumbnail </em>', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'sp-news-and-widget' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" />
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
    <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];

        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
		$instance['show_thumb'] = (bool) esc_attr( $new_instance['show_thumb'] );
        $instance['category']      = intval( $new_instance['category'] ); 
		$instance['height']   = intval( $new_instance['height'] );
        $instance['pause']              = intval( $new_instance['pause'] ); 
		$instance['speed']              = intval( $new_instance['speed'] );
        $instance['link_target']        = !empty($new_instance['link_target']) ? 1 : 0;
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);
        $current_post_name = get_query_var('name');
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);  
		$num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);  
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
		if ( isset( $instance['show_thumb'] ) && ( 1 == $instance['show_thumb'] ) ) { $show_thumb = "true"; } else { $show_thumb = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
		if ( isset( $instance['height'] ) && ( 0 < count( $instance['height'] ) ) ) { $args['height'] = intval( $instance['height'] ); }
		if ( isset( $instance['pause'] ) && ( 0 < count( $instance['pause'] ) ) ) { $args['pause'] = intval( $instance['pause'] ); }
		if ( isset( $instance['speed'] ) && ( 0 < count( $instance['speed'] ) ) ) { $args['speed'] = intval( $instance['speed'] ); }
        $link_target = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $postcount = 0;
        $unique = wpnw_pro_get_unique();

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>
          
            <div class="recent-news-items">
               <div class="wpnw-pro-newsticker-jcarousellite-<?php echo $unique; ?> newsticker-jcarousellite">
			   <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
       							'posts_per_page' => $num_items,                   
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                $count++;
                $post_link              = wpnw_pro_get_post_link( $post->ID );
                $post_featured_image    = wpnw_get_post_featured_image( $post->ID, array(80,80), true );
                $terms = get_the_terms( $post->ID, 'news-category' );
                $news_links = array();
                    
                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }

                    $cate_name = join( " ", $news_links );
                    ?>
                     <li class="news_li">
					 <?php if($show_thumb == 'true') { ?>					
					 
					<div class="news-list-content">
						<div class="news-left-img">
						<div class="news-image-bg">
							<?php if( !empty($post_featured_image) ) { ?>
                            <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
                                <img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
                            </a>
                            <?php } ?>
						</div>
							</div>
							<div class="news-right-content">
							<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							 <div class="news-title">
									<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</div>
							<?php if($date == "true") { ?>
							<div class="news-date">		
								<?php echo get_the_date(); ?>
								</div>
						<?php }?>
								
								</div>
						</div> 
					 
					  <?php } else { ?>
					 
					 
					<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
                       <div class="news-title"> <a class="post-title" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php if($date == "true") { ?>
							<div class="news-date"><?php echo get_the_date(); ?></div>
						<?php } ?>
                    
											
	<?php } ?>
					</li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>
                </ul>
	            </div>
            </div>
<script>
   jQuery(function() {
  jQuery('.wpnw-pro-newsticker-jcarousellite-<?php echo $unique; ?>').vTicker(
  {
	  speed:<?php echo $instance['speed']?>,
	  height:<?php echo $instance['height']?>,
	  padding:5,
	  pause:<?php echo $instance['pause']?>
	  
  });
});
</script>
<?php
        echo $after_widget;
    }
}

function pro_sp_news_scroll_widget_load_widgets() {
    register_widget( 'PRO_SP_News_scrolling_Widget' );
}

add_action( 'widgets_init', 'pro_sp_news_scroll_widget_load_widgets' );

/* Latest News List/Slider-2 */
class PRO_SP_News_thmb_Widget extends WP_Widget {

    function __construct() {
		
        $widget_ops = array('classname' => 'PRO_SP_News_thmb_Widget', 'description' => __('Displayed Latest News Items in list view OR in Slider ', 'sp-news-and-widget') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'pro_sp_news_thumb_widget' );
        parent::__construct( 'pro_sp_news_thumb_widget', __('Latest News List/Slider-2', 'sp-news-and-widget'), $widget_ops, $control_ops );
    }

    function form($instance) {	
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
		'active_slider'     => "false",
		'dots'            => "true",
        'autoplay'          => "true",      
        'autoplayInterval'  => 5000,                
        'speed'             => 500,
        'link_target'       => 0
        );
		
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
     <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'sp-news-and-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
    	<p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'sp-news-and-widget' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'sp-news-and-widget' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'sp-news-and-widget' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
		<!-- Active Slider -->
		 <p>
		<h3><?php esc_html_e( 'News Slider Setting:', 'sp-news-and-widget' ); ?></h3> 
		 <hr />
            <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox"<?php checked( $instance['active_slider'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( '<b>Check this box to Display News in Slider View.</b> <br /><em>By default News Display in List View</em>', 'sp-news-and-widget' ); ?></label>
        </p>
		
		<!-- Widget Order: Select dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['dots'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'sp-news-and-widget' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'sp-news-and-widget' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
		$instance['active_slider'] = (bool) esc_attr( $new_instance['active_slider'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );
		$instance['dots']             = esc_attr( $new_instance['dots'] );
        $instance['autoplay']           = esc_attr( $new_instance['autoplay'] );
        $instance['autoplayInterval']   = intval( $new_instance['autoplayInterval'] );
        $instance['speed']              = intval( $new_instance['speed'] );
        $instance['link_target']        = !empty($new_instance['link_target']) ? 1 : 0;
        return $instance;
    }
	
	  function get_other_options () {
		  
         $args = array(
                    'true' => __( 'True', 'sp-news-and-widget' ),
                    'false' => __( 'False', 'sp-news-and-widget')
                    );    
         return $args;
        }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
		if ( isset( $instance['active_slider'] ) && ( 1 == $instance['active_slider'] ) ) { $activeSlider = "true"; } else { $activeSlider = "false"; }	
		if ( isset( $instance['dots'] ) && in_array( $instance['dots'], array_keys( $this->get_other_options() ) ) ) { $args['dots'] = $instance['dots']; }
        if ( isset( $instance['autoplay'] ) && in_array( $instance['autoplay'], array_keys( $this->get_other_options() ) ) ) { $args['autoplay'] = $instance['autoplay']; }
        if ( isset( $instance['autoplayInterval'] ) && ( 0 < count( $instance['autoplayInterval'] ) ) ) { $args['autoplayInterval'] = intval( $instance['autoplayInterval'] ); }
        if ( isset( $instance['speed'] ) && ( 0 < count( $instance['speed'] ) ) ) { $args['speed'] = intval( $instance['speed'] ); }
        $link_target    = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
        $slider_cls     = ($activeSlider == 'true') ? 'wpnw-has-slider' : '';
        $postcount = 0;
        $unique = wpnw_pro_get_unique();

        echo $before_widget;
?>
            <h4 class="widget-title"><?php echo $title ?></h4>

            <div class="wpnw-pro-sp-news-static-<?php echo $unique; ?> <?php echo $slider_cls; ?> sp_news_static design-w3">
			
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }

            $cust_loop = new WP_Query($news_args);
			global $post;
            $post_count = $cust_loop->post_count;
          $count = 0;
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
                    $post_link              = wpnw_pro_get_post_link( $post->ID );
                    $post_featured_image    = wpnw_get_post_featured_image( $post->ID, array(80,80), true );
                    $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms) {
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                        }
                    }
                    $cate_name = join( " ", $news_links );
                    ?>
                   
				   
				    <div class="news-list">
						<div class="news-list-content">
						<div class="news-left-img">
						<div class="news-image-bg">
                        <?php if( !empty($post_featured_image) ) { ?>
                        <a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
                            <img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
                        </a>
                        <?php } ?>
						</div>
							</div>
							<div class="news-right-content">
							<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="news-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							 <div class="news-title">
									<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</div>
							<?php if($date == "true") { ?>
							<div class="news-date">		
								<?php echo get_the_date(); ?>
								</div>
						<?php }?>
								
								</div>
						</div>
				</div>
				   
				   
				   
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

                 </div>
				<?php $activeSlider =  $instance['active_slider'];
			if($activeSlider == 'true') { ?> 
				 <script type="text/javascript">
    jQuery(document).ready(function(){
   
	     jQuery('.wpnw-pro-sp-news-static-<?php echo $unique; ?>').slick({
			dots: <?php echo $instance['dots']?>,
			infinite: true,
			speed: <?php echo $instance['speed']?>,
			arrows:false,
			autoplay: <?php echo $instance['autoplay']?>,
			autoplaySpeed:<?php echo $instance['autoplayInterval']?>,
			slidesToShow: 1,
			slidesToScroll: 1

	  });
	  

    });


  </script>
<?php
			}
        echo $after_widget;
    }
}

function pro_sp_news_thumb_widget_load_widgets() {
    register_widget( 'PRO_SP_News_thmb_Widget' );
}

add_action( 'widgets_init', 'pro_sp_news_thumb_widget_load_widgets' );