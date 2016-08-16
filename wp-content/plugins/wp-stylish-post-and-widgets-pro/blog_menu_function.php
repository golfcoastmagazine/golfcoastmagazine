<?php

add_action('admin_menu', 'wpspw_pro_register_submenu_page');

function wpspw_pro_register_submenu_page() {
	add_submenu_page( 'edit.php', 'Pro Designs', 'Pro Designs', 'manage_options', 'wpspw-pro-designs-page', 'wpspw_pro_designs_page_callback' );
}

function wpspw_pro_designs_page_callback() {
	
	$result ='<div class="wrap"><div id="icon-tools" class="icon32"></div><h2 style="padding:15px 0">Stylist Post Pro Designs</h2></div>	
	<div class="wpspw-medium-12 wpspw-columns"><h3>1) Stylist Post Slider/Carousel</h3>
	<p>Shortcode: <code>[wpspw_recent_post_slider]</code><br /><br />
	<strong>Where Designs for this shortcode is : design-1, design-2, design-3, design-4, design-5, design-6, design-7, design-8, design-9, design-10, design-11, design-12, design-13, design-14, design-15, design-32, design-33, design-38</strong></p>
	<p><b>Complete shortcode is:</b><br /><code>[wpspw_recent_post_slider design="design-1" show_author="true" slides_column="1" slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="300"
	loop="true" limit="5" category="5" category_name="Sports" show_read_more="false" show_date="true" show_category_name="true" show_content="true" content_words_limit="20"]</code></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-1.jpg"><p><code>[wpspw_recent_post_slider design="design-1"]</code></p></div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-2.jpg"><p><code>[wpspw_recent_post_slider design="design-2"]</code></p></div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-3.jpg"><p><code>[wpspw_recent_post_slider design="design-3"]</code></p></div></div>
				<div class="wpspw-medium-3 wpspw-columns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-4.jpg"><p><code>[wpspw_recent_post_slider design="design-4"]</code></p></div></div>
				<div class="wpspw-medium-3 wpspw-columns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-5.jpg"><p><code>[wpspw_recent_post_slider design="design-5"]</code></p></div></div>				
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-6.jpg"><p><code>[wpspw_recent_post_slider design="design-6" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>	
				<div class="wpspw-medium-3 wpspw-columns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-7.jpg"><p><code>[wpspw_recent_post_slider design="design-7" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</p></div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-8.jpg"><p><code>[wpspw_recent_post_slider design="design-8" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-9.jpg"><p><code>[wpspw_recent_post_slider design="design-9" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns" ><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-10.jpg"><p><code>[wpspw_recent_post_slider design="design-10" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-11.jpg"><p><code>[wpspw_recent_post_slider design="design-11" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-12.jpg"><p><code>[wpspw_recent_post_slider design="design-12" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-13.jpg"><p><code>[wpspw_recent_post_slider design="design-13" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-14.jpg"><p><code>[wpspw_recent_post_slider design="design-14" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-15.jpg"><p><code>[wpspw_recent_post_slider design="design-15" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-32.jpg"><p><code>[wpspw_recent_post_slider design="design-32" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-33.jpg"><p><code>[wpspw_recent_post_slider design="design-33" slides_column="3"]</code></p>Where slides_column is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-38.jpg"><p><code>[wpspw_recent_post_slider design="design-38" slides_column="1"]</code></p></div></div>
				<div class="wpspw-medium-12 wpspw-columns"><h3>2) Recent Post </h3>	
				<p> Shortcode: <code>[wpspw_recent_post]</code><br /><br />
	<strong>Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-25, design-26, design-27, design-28,
design-29, design-31, design-34, design-35, design-37	</strong></p>
<p><b>Complete shortcode is:</b><br /><code>[wpspw_recent_post design="design-16" limit="5" grid="2" show_author="true" category="5" category_name="Sports"  show_date="true" 
	show_category_name="true" show_content="true"  content_words_limit="20" show_read_more="false"]</code></p>
<h3>3) Post Grid View</h3>
<p> Shortcode: <code>[wpspw_post]</code><br /><br />
	<strong>Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-24, design-25, design-26, design-27, design-30,
design-34, design-35, design-36, design-37 </strong></p>
	<p><b>Complete shortcode is:</b><br />
	<code>[wpspw_post design="design-16" limit="5" grid="2" show_author="true" category="5" category_name="Sports" pagination="true"  show_date="true" 
	show_category_name="true" show_content="true" show_full_content="true" content_words_limit="20" show_read_more="false"]</code></p></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-16.jpg"><p><code>[wpspw_recent_post design="design-16" grid="2"] OR [wpspw_post design="design-16" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-17.jpg"><p><code>[wpspw_recent_post design="design-17" grid="2"] OR [wpspw_post design="design-17" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-18.jpg"><p><code>[wpspw_recent_post design="design-18" grid="2"] OR [wpspw_post design="design-18" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-19.jpg"><p><code>[wpspw_recent_post design="design-19" grid="2"] OR [wpspw_post design="design-19" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-20.jpg"><p><code>[wpspw_recent_post design="design-20" grid="2"] OR [wpspw_post design="design-20" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-21.jpg"><p><code>[wpspw_recent_post design="design-21" grid="2"] OR [wpspw_post design="design-21" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-22.jpg"><p><code>[wpspw_recent_post design="design-22" grid="2"] OR [wpspw_post design="design-22" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns" ><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-24.jpg"><p><code>[wpspw_post design="design-24" grid="2"]</code></p>Only List View</div></div>
				<div class="wpspw-medium-3 wpspw-columns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-25.jpg"><p><code>[wpspw_recent_post design="design-25" grid="2"] OR [wpspw_post design="design-25" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-26.jpg"><p><code>[wpspw_recent_post design="design-26" grid="2"] OR [wpspw_post design="design-26" ]</code></p>Only List View</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-27.jpg"><p><code>[wpspw_recent_post design="design-27" grid="2"] OR [wpspw_post design="design-27"]</code></p>Only List View</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-28.jpg"><p><code>[wpspw_recent_post design="design-28" limit="4"]</code></p>Use same paramater as given</div></div>
				<div class="wpspw-medium-3 wpspw-columns" style="clear:both"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-29.jpg"><p><code>[wpspw_recent_post design="design-29" limit="4"]</code></p>Use same paramater as given</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-30.jpg"><p><code>[wpspw_post design="design-30" grid="3" ]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-31.jpg"><p><code>[wpspw_recent_post design="design-31" limit="4"]</code></p>Use same paramater as given</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-34.jpg"><p><code>[wpspw_recent_post design="design-34" grid="2"] OR [wpspw_post design="design-34" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-35.jpg"><p><code>[wpspw_recent_post design="design-35" grid="2"] OR [wpspw_post design="design-34" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-36.jpg"><p><code>[wpspw_post design="design-36"]</code></p>Only List View</div></div>
				<div class="wpspw-medium-3 wpspw-columns"><div class="postdesigns"><img  src="'.plugin_dir_url( __FILE__ ).'pro-designs/news-design-37.jpg"><p><code>[wpspw_recent_post design="design-37" grid="2"] OR [wpspw_post design="design-37" grid="2"]</code></p>Where grid is 1,2,3,4 etc</div></div>
				<div class="wpspw-medium-12 wpspw-columns"><h2>Check the demo</h2>
				<p><strong>Check Demo Link</strong> <a href="http://demo.wponlinesupport.com/prodemo/wp-stylist-post-and-widgets-pro/" target="_blank">WP Stylist Post and Widgets Pro</a></div>
				';

	echo $result;
}
function wpspw_pro_blog_design_admin_style(){
	?>
	<style type="text/css">
	.postdesigns{-moz-box-shadow: 0 0 5px #ddd;-webkit-box-shadow: 0 0 5px#ddd;box-shadow: 0 0 5px #ddd; background:#fff; padding:10px;  margin-bottom:15px;}
	.wpspw-column, .wpspw-columns {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;  box-sizing: border-box;}
.postdesigns img{width:100%; height:auto;}
@media only screen and (min-width: 40.0625em) {  
  .wpspw-column,
  .wpspw-columns {position: relative;padding-left:10px;padding-right:10px;float: left; }
  .wpspw-medium-1 {    width: 8.33333%; }
  .wpspw-medium-2 {    width: 16.66667%; }
  .wpspw-medium-3 {    width: 25%; }
  .wpspw-medium-4 {    width: 33.33333%; }
  .wpspw-medium-5 {    width: 41.66667%; }
  .wpspw-medium-6 {    width: 50%; }
  .wpspw-medium-7 {    width: 58.33333%; }
  .wpspw-medium-8 {    width: 66.66667%; }
  .wpspw-medium-9 {    width: 75%; }
  .wpspw-medium-10 {    width: 83.33333%; }
  .wpspw-medium-11 {    width: 91.66667%; }
  .wpspw-medium-12 {    width: 100%; }   

   }
	</style>
<?php }

add_action('admin_head', 'wpspw_pro_blog_design_admin_style');