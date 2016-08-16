<?php

/*Latest Blog Slider Widget*/
class Wpspw_Pro_Post_Widget extends WP_Widget {

    function __construct() {
		 
        $widget_ops = array('classname' => 'wpspw_pro_post_widget', 'description' => __('Displayed Latest WP Post with slider', 'wpspw-post-and-widgets') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'wpspw_pro_post_widget' );
        parent::__construct( 'wpspw_pro_post_widget', __('Latest WP Post Slider Widget', 'wpspw-post-and-widgets'), $widget_ops, $control_ops );
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
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
     <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wpspw-post-and-widgets' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => WPSPW_CAT, 'class' => 'widefat', 'show_option_all' => __( 'All', 'wpspw-post-and-widgets' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
 <!-- Widget Order: Select Arrows -->
        <p>
            <label for="<?php echo $this->get_field_id( 'arrows' ); ?>"><?php _e( 'Arrows:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'arrows' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'arrows' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['arrows'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'wpspw-post-and-widgets' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wpspw-post-and-widgets' ); ?></label>
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
        return $instance;
    }
	
	 function get_other_options () {
		  
         $args = array(
                    'true' => __( 'True', 'wpspw-post-and-widgets' ),
                    'false' => __( 'False', 'wpspw-post-and-widgets' )
                    );    
         return $args;
        }
    function widget($blog_args, $instance) {
        extract($blog_args, EXTR_SKIP);

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
		$postcount    = 0;
        $unique       = wpspw_pro_get_unique();

        echo $before_widget;

?>
            <h2 class="widget-title"><?php echo $title ?></h2>
            
            <div class="wpspw-pro-sp-slider-<?php echo $unique; ?> wpspw-has-slider sp_wpspwpost_slider design-w1">
            
            <?php // setup the query
            $blog_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => WPSPW_POST_TYPE,
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$blog_args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($blog_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
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
                    ?>
					
					 <div class="wpspwpost-slides">  
						<div class="wpspwpost-grid-content">
						<div class="wpspwpost-overlay">
							<div class="wpspwpost-image-bg">
							<?php the_post_thumbnail('url'); ?>
								<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							</div>
							<div class="wpspwpost-short-content">
							 <h2 class="wpspwpost-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h2>
						<?php if($date == "true") { ?>
							<div class="wpspwpost-date">		
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
   
	     jQuery('.wpspw-pro-sp-slider-<?php echo $unique; ?>').slick({
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

function wpspw_pro_load_widgets() {
    register_widget( 'Wpspw_Pro_Post_Widget' );
}

add_action( 'widgets_init', 'wpspw_pro_load_widgets' );


/*Latest blog List/Slider-1*/
class Wpspw_Postlistpro_Widget extends WP_Widget {

    function __construct() {
		 
        $widget_ops = array('classname' => 'wpspw_pro_post_list_widget', 'description' => __('Displayed Latest WP Post in list view OR in Slider', 'wpspw-post-and-widgets') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'wpspw_pro_post_list_widget' );
        parent::__construct( 'wpspw_pro_post_list_widget', __('Latest WP Post List/Slider-1', 'wpspw-post-and-widgets'), $widget_ops, $control_ops );
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
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wpspw-post-and-widgets' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => WPSPW_CAT, 'class' => 'widefat', 'show_option_all' => __( 'All', 'wpspw-post-and-widgets' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>	
		<!-- Active Slider -->
		 <p>
		 <h3><?php esc_html_e( 'Post Slider Setting:', 'wpspw-post-and-widgets' ); ?></h3> 
		 <hr />
            <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox"<?php checked( $instance['active_slider'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( '<b>Check this box to Display Post in Slider View.</b> <br /><em>By default Post Display in List View</em>', 'wpspw-post-and-widgets' ); ?></label>
        </p>
		
		<!-- Widget Order: Select dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['dots'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'wpspw-post-and-widgets' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wpspw-post-and-widgets' ); ?></label>
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
        return $instance;
    }
	
	 function get_other_options () {
		  
         $args = array(
                    'true' => __( 'True', 'wpspw-post-and-widgets' ),
                    'false' => __( 'False', 'wpspw-post-and-widgets' )
                    );    
         return $args;
        }
    function widget($blog_args, $instance) {
        extract($blog_args, EXTR_SKIP);

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
        $postcount  = 0;
        $slider_cls = ($activeSlider == 'true') ? 'wpspw-has-slider' : '';
        $unique     = wpspw_pro_get_unique();

        echo $before_widget;

?>
             <h2 class="widget-title"><?php echo $title ?></h2>
           
            <div class="wpspw-pro-sp-static-<?php echo $unique; ?> <?php echo $slider_cls; ?> sp_wpspwpost_static design-w2">
              
            <?php // setup the query
            $blog_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => WPSPW_POST_TYPE,
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$blog_args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($blog_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
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
                    ?>
					
					
					 <div class="wpspwpost-grid">
						  <div class="wpspwpost-image-bg">
								 <a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_post_thumbnail('url'); ?></a>
								<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
								</div>
								<div class="wpspwpost-grid-content">
								<div class="wpspwpost-content">
									 <div class="wpspwpost-title">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</div>
									<?php if($date == "true") { ?>
							<div class="wpspwpost-date">		
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
   
	     jQuery('.wpspw-pro-sp-static-<?php echo $unique; ?>').slick({
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

function wpspw_pro_widgetlist_load_widgets() {
    register_widget( 'Wpspw_Postlistpro_Widget' );
}

add_action( 'widgets_init', 'wpspw_pro_widgetlist_load_widgets' );

/* Latest Blog List/Slider-2 */
class Wpspw_Pro_Post_Thumb_Widget extends WP_Widget {

    function __construct() {
		 
        $widget_ops = array('classname' => 'wpspw_pro_post_thumb_widget', 'description' => __('Displayed Latest WP Post in list view OR in Slider ', 'wpspw-post-and-widgets') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'wpspw_pro_post_thumb_widget' );
        parent::__construct( 'wpspw_pro_post_thumb_widget', __('Latest WP Post List/Slider-2', 'wpspw-post-and-widgets'), $widget_ops, $control_ops );
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
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
    	<p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wpspw-post-and-widgets' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => WPSPW_CAT, 'class' => 'widefat', 'show_option_all' => __( 'All', 'wpspw-post-and-widgets' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
		<!-- Active Slider -->
		 <p>
		 <h3><?php esc_html_e( 'Post Slider Setting:', 'wpspw-post-and-widgets' ); ?></h3> 
		 <hr />
            <input id="<?php echo $this->get_field_id( 'active_slider' ); ?>" name="<?php echo $this->get_field_name( 'active_slider' ); ?>" type="checkbox"<?php checked( $instance['active_slider'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'active_slider' ); ?>"><?php _e( '<b>Check this box to Display Post in Slider View.</b> <br /><em>By default Post Display in List View</em>', 'wpspw-post-and-widgets' ); ?></label>
        </p>
		
		<!-- Widget Order: Select dots -->
        <p>
            <label for="<?php echo $this->get_field_id( 'dots' ); ?>"><?php _e( 'Dots:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'dots' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'dots' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['dots'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>

         <!-- Widget Order: Select Auto play -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e( 'Auto Play:', 'wpspw-post-and-widgets' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'autoplay' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>">
                <?php foreach ( $this->get_other_options() as $k => $v ) { ?>
                <option value="<?php echo $k; ?>"<?php selected( $instance['autoplay'], $k ); ?>><?php echo $v; ?></option>
            <?php } ?>
            </select>
        </p>
        <!-- Widget ID:  AutoplayInterval -->
        <p>
            <label for="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>"><?php _e( 'Autoplay Interval:', 'wpspw-post-and-widgets' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'autoplayInterval' ); ?>"  value="<?php echo $instance['autoplayInterval']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'autoplayInterval' ); ?>" />
        </p>
        <!-- Widget ID:  Speed -->
        <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wpspw-post-and-widgets' ); ?></label>
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
        return $instance;
    }
	
	  function get_other_options () {
		   
         $args = array(
                    'true' => __( 'True', 'wpspw-post-and-widgets' ),
                    'false' => __( 'False', 'wpspw-post-and-widgets' )
                    );    
         return $args;
        }
    function widget($blog_args, $instance) {
        extract($blog_args, EXTR_SKIP);

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
        $postcount  = 0;
        $slider_cls = ($activeSlider == 'true') ? 'wpspw-has-slider' : '';
        $unique     = wpspw_pro_get_unique();

        echo $before_widget;
?>
             <h4 class="widget-title"><?php echo $title ?></h4>

            <div class="wpspw-pro-sp-static-<?php echo $unique; ?> <?php echo $slider_cls; ?> sp_wpspwpost_static design-w3">
			 
            <?php // setup the query
            $blog_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => WPSPW_POST_TYPE,
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$blog_args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $category) );
            }

            $cust_loop = new WP_Query($blog_args);
			global $post;
            $post_count = $cust_loop->post_count;
          $count = 0;
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
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
                    ?>
                   
				   
				    <div class="wpspwpost-list">
						<div class="wpspwpost-list-content">
						<div class="wpspwpost-left-img">
						<div class="wpspwpost-image-bg">
							 <a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">                   		
                  	<?php  the_post_thumbnail( array(80,80) ); ?>   </a>
							</div>
							</div>
							<div class="wpspwpost-right-content">
							<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							 <div class="wpspwpost-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</div>
							<?php if($date == "true") { ?>
							<div class="wpspwpost-date">		
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
   
	     jQuery('.wpspw-pro-sp-static-<?php echo $unique; ?>').slick({
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

function wpspw_pro_post_thumb_widget_load_widgets() {
    register_widget( 'Wpspw_Pro_Post_Thumb_Widget' );
}

add_action( 'widgets_init', 'wpspw_pro_post_thumb_widget_load_widgets' );


/*Latest Blog Simple Widget*/
class Wpspw_Pro_Post_Simple_Widget extends WP_Widget {

    function __construct() {
		 
        $widget_ops = array('classname' => 'wpspw_pro_post_simple_widget', 'description' => __('Displayed Latest WP Post in a sidebar', 'wpspw-post-and-widgets') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'wpspw_pro_post_simple_widget' );
         parent::__construct( 'wpspw_pro_post_simple_widget', __('Latest WP Post Widget', 'wpspw-post-and-widgets'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wpspw-post-and-widgets' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => WPSPW_CAT, 'class' => 'widefat', 'show_option_all' => __( 'All', 'wpspw-post-and-widgets' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
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
        $postcount = 0;

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>

            <div class="recent-wpspwpost-items">
                <ul>
            <?php // setup the query
            $blog_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => WPSPW_POST_TYPE,
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$blog_args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($blog_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
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
                    ?>
                     <li class="wpspwpost_li">
					<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
                       <div class="wpspwpost-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php if($date == "true") { ?>
							<div class="wpspwpost-date"><?php echo get_the_date(); ?></div>
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

function wpspw_pro_post_simple_widget_load_widgets() {
    register_widget( 'Wpspw_Pro_Post_Simple_Widget' );
}

add_action( 'widgets_init', 'wpspw_pro_post_simple_widget_load_widgets' );


/* Latest Blog Scrolling Widget */
class Wpspw_Pro_Post_scrolling_Widget extends WP_Widget {
   function __construct() {
		 
        $widget_ops = array('classname' => 'wpspw_pro_post_scrolling_widget', 'description' => __('Displayed Latest WP Post Items in a sidebar with vertical slider', 'wpspw-post-and-widgets') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'wpspw_pro_post_scrolling_widget' );
        parent::__construct( 'wpspw_pro_post_scrolling_widget', __('Latest WP Post Scrolling Widget', 'wpspw-post-and-widgets'), $widget_ops, $control_ops );
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
        );
		 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;              
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"> <?php esc_html_e( 'Title:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items:', 'wpspw-post-and-widgets' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo esc_attr($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'wpspw-post-and-widgets' ); ?></label>
        </p>
		 <p>
            <input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox"<?php checked( $instance['show_thumb'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( '<strong>Check this box to display Thumbnail in left side<br /></strong><em>By default display without Thumbnail </em>', 'wpspw-post-and-widgets' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'wpspw-post-and-widgets' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => WPSPW_CAT, 'class' => 'widefat', 'show_option_all' => __( 'All', 'wpspw-post-and-widgets' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'wpspw-post-and-widgets' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause:', 'wpspw-post-and-widgets' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" />
        </p>
		 <p>
            <label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed:', 'wpspw-post-and-widgets' ); ?></label>
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
        $postcount = 0;
        $unique = wpspw_pro_get_unique();

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>
          
            <div class="recent-wpspwpost-items">
               <div class="wpspw-pro-blogticker-jcarousellite-<?php echo $unique; ?> blogticker-jcarousellite">
			   <ul>
            <?php // setup the query
            $blog_args = array( 'suppress_filters' => true,
       							'posts_per_page' => $num_items,                   
                           'post_type' => WPSPW_POST_TYPE,
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$blog_args['tax_query'] = array( array( 'taxonomy' => WPSPW_CAT, 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($blog_args);
			global $post;
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
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
                    ?>
                     <li class="wpspwpost_li">
					 <?php if($show_thumb == 'true') { ?>					
					 
					<div class="wpspwpost-list-content">
						<div class="wpspwpost-left-img">
						<div class="wpspwpost-image-bg">
							 <a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">                   		
                  	<?php  the_post_thumbnail( array(80,80) ); ?>   </a>
							</div>
							</div>
							<div class="wpspwpost-right-content">
							<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
							 <div class="wpspwpost-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</div>
							<?php if($date == "true") { ?>
							<div class="wpspwpost-date">		
								<?php echo get_the_date(); ?>
								</div>
						<?php }?>
								
								</div>
						</div> 
					 
					  <?php } else { ?>
					 
					 
					<?php if($show_category == 'true') { 
								if($cate_name !='') {	?>
								<div class="wpspwpost-categories">		
							<?php echo $cate_name; ?>		
						</div>
								<?php } } ?>
                       <div class="wpspwpost-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php if($date == "true") { ?>
							<div class="wpspwpost-date"><?php echo get_the_date(); ?></div>
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
  jQuery('.wpspw-pro-blogticker-jcarousellite-<?php echo $unique; ?>').vTicker(
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

function wpspw_pro_blog_scroll_widget_load_widgets() {
    register_widget( 'Wpspw_Pro_Post_scrolling_Widget' );
}

add_action( 'widgets_init', 'wpspw_pro_blog_scroll_widget_load_widgets' );