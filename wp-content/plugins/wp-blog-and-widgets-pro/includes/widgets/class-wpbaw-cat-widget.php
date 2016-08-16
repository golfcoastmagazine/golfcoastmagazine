<?php
/**
 * Widget API: WP_Widget_Categories class
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

function wpbaw_pro_register_blog_category_widget() {
    register_widget( 'Wpbaw_Widget_Blog_Categories' );
}

// Action to register widget
add_action( 'widgets_init', 'wpbaw_pro_register_blog_category_widget' );

/**
 * Core class used to implement a Categories widget.
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
class Wpbaw_Widget_Blog_Categories extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @package WP Blog and Widgets Pro
 	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'wpbaw-widget-cats', 'description' => __( "A list or dropdown of blog categories.", 'wp-blog-and-widgets' ) );
		parent::__construct('wpbaw_categories', __('Blog Categories', 'wp-blog-and-widgets'), $widget_ops);
	}

	/**
	 * Outputs the content for the current Categories widget instance.
	 *
	 * @package WP Blog and Widgets Pro
 	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {

		static $first_dropdown = true;

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Blog Categories', 'wp-blog-and-widgets' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) 			? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) 	? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) 		? '1' : '0';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h,
			'taxonomy'     => WPBAW_PRO_CAT,
		);

		if ( $d ) {
			$dropdown_id = ( $first_dropdown ) ? 'wpbaw-cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] 	= __( 'Select Category', 'wp-blog-and-widgets' );
			$cat_args['id'] 				= $dropdown_id;
			$cat_args['value_field'] 		= 'slug';
			$cat_args['selected'] 			= get_query_var('blog-category');

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @package WP Blog and Widgets Pro
 	 		 * @since 1.0.0
			 */
			wp_dropdown_categories( apply_filters( 'wpbaw_pro_widget_cat_dropdown_args', $cat_args ) );
		?>

<script type='text/javascript'>
/* <![CDATA[ */
(function() {
	var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
	function Wpbaw_Cat_Change() {
		if ( dropdown.options[ dropdown.selectedIndex ].value != -1 ) {
			location.href = "<?php echo home_url(); ?>/?blog-category=" + dropdown.options[ dropdown.selectedIndex ].value;
		}
	}
	dropdown.onchange = Wpbaw_Cat_Change;
})();
/* ]]> */
</script>

<?php
		} else {
?>
		<ul class="wpbaw-cat-list">
<?php
		$cat_args['title_li'] = '';

		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */
		wp_list_categories( apply_filters( 'wpbaw_pro_widget_cats_args', $cat_args ) );
?>
		</ul><!-- end .wpbaw-cat-list -->
<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Categories widget instance.
	 *
	 * @package WP Blog and Widgets Pro
 	 * @since 1.0.0
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
		$instance['count'] 			= !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] 	= !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] 		= !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @package WP Blog and Widgets Pro
 	 * @since 1.0.0
	 */
	public function form( $instance ) {

		// Defaults
		$instance 		= wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 			= sanitize_text_field( $instance['title'] );
		$count 			= isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical 	= isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown 		= isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
		<?php
	}
}