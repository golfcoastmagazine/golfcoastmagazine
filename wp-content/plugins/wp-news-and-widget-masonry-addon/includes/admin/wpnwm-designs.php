<?php
/**
 * Plugin Design Page HTML
 *
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to register admin menu
add_action( 'admin_menu', 'wpnwm_register_menu' );

/**
 * Function to register admin menus
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_register_menu() {
	add_submenu_page( 'edit.php?post_type='.WPNWM_POST_TYPE, __('Masonry Designs', 'sp-news-and-widget'), __('Masonry Designs', 'sp-news-and-widget'), 'manage_options', 'wpnwm-designs', 'wpnwm_designs_page' );
}

// Action to add custom css to admin head
add_action( 'admin_head', 'wpnwm_add_page_style', 15 );

/**
 * Function to add custom css to admin head
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_add_page_style(){

	global $current_screen;

	if( isset($current_screen->id) && $current_screen->id == 'news_page_wpnwm-designs' ){
		$css  = '';
		$css .= '<style type="text/css">
					.postdesigns{-moz-box-shadow: 0 0 5px #ddd;-webkit-box-shadow: 0 0 5px#ddd;box-shadow: 0 0 5px #ddd; background:#fff; padding:10px;  margin-bottom:15px;}
					.wpcolumn, .wpcolumns {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;  box-sizing: border-box;}
					.postdesigns img{width:100%; height:auto;}
					.wpos-clear{clear:both;}
					
					.shortcode-priview{background:#f7f7f7; border-bottom:2px solid #e7e7e7; font-weight:bold; padding:10px; clear:both; margin-bottom:10px;}
					.wpnwm-medium-4 .shortcode-priview{display:block; margin:0px;}
					.postdesigns{ min-height:340px;-moz-box-shadow: 0 0 5px #ddd;-webkit-box-shadow: 0 0 5px#ddd;box-shadow: 0 0 5px #ddd; background:#fff; padding:10px;  margin-bottom:15px;}
					.wpcolumn, .wpcolumns {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;  box-sizing: border-box;}
					.postdesigns img{width:100%; height:auto; }
					.wpcolumns-bg{background:#fff; width:100%; float:left;}
					
					@media only screen and (min-width: 40.0625em) {  
					.wpcolumn,
					.wpcolumns {position: relative;padding-left:10px;padding-right:10px;float: left;}
					.wpnwm-medium-1 { width: 8.33333%; }
					.wpnwm-medium-2 { width: 16.66667%; }
					.wpnwm-medium-3 { width: 25%; }
					.wpnwm-medium-4 { width: 33.33333%; }
					.wpnwm-medium-5 { width: 41.66667%; }
					.wpnwm-medium-6 { width: 50%; }
					.wpnwm-medium-7 { width: 58.33333%; }
					.wpnwm-medium-8 { width: 66.66667%; }
					.wpnwm-medium-9 { width: 75%; }
					.wpnwm-medium-10 { width: 83.33333%; }
					.wpnwm-medium-11 { width: 91.66667%; }
					.wpnwm-medium-12 { width: 100%; }
					}
				</style>';

		echo $css;
	}
}


/**
 * Function to display plugin design HTML
 * 
 * @package WP News and Widget - Masonry Layout
 * @since 1.0.0
 */
function wpnwm_designs_page() { 
?>
	
	<div class="wrap wpnwm-wrap">

		<div class="wpnwm-cnt-wrp">
			
			<h2>WP News and Widget - Masonry Layout</h2>

			<div class="wpnwm-medium-12 wpcolumns">
				<b>Complete shortcode is:</b><br>
				<div class="shortcode-priview">[sp_news_masonry limit="10" category="5" category_name="Sports" design="design-1" grid="2" pagination="false" show_date="true" show_category_name="true" show_content="true" content_words_limit="20" show_read_more="true" content_tail="..." link_target="self" load_more_text="Load More Post" order="desc" orderby="post_date" exclude_post="1,2" posts="5,10,15"]</div>
			</div>

			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-1.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-1"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-2.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-2"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-3.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-3"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns wpos-clear" ><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-4.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-4"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-5.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-5"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-6.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-6"]</span></p></p></div></div>				
			<div class="wpnwm-medium-4 wpcolumns wpos-clear" ><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-7.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-7"]</span></p></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-8.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-8"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-9.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-9"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns wpos-clear"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-10.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-10"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-11.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-11"]</span></p></div></div>
			<div class="wpnwm-medium-4 wpcolumns"><div class="postdesigns"><img src="<?php echo WPNWM_URL; ?>assets/images/designs/m-news-design-12.jpg"><p><span class="shortcode-priview">[sp_news_masonry design="design-12"]</span></p></div></div>

			<div class="wpnwm-medium-12 wpcolumns">
				<h2>Check the demo</h2>
				<p><strong>Check Demo Link</strong> <a href="http://demo.wponlinesupport.com/prodemo/masonry-add-on-wp-news-and-widget-demo/" target="_blank">WP News and Widget - Masonry Layout</a></p>
			</div>

		</div><!-- end .wpnwm-cnt-wrp -->

	</div><!-- end .wpnw-wrap -->

<?php
}