=== WP Stylist Post and Widgets Pro  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress blog , wordpress blog widget, Free wordpress blog, blog custom post type, blog tab, blog menu, blog page with custom post type, blog, latest blog, custom post type, cpt, widget
Requires at least: 3.1
Tested up to: 4.5
Author URI: http://wponlinesupport.com
Stable tag: trunk

A quick, easy way to add WP Stylist Post designs to your WordPress website.

== Description ==

WP Stylist Post and Widgets Pro display WordPress posts with multiple designs . You can display latest post on your homepage/frontpage as well as in inner pages with around 36 designs.

**This wordpress plugin contains 3 shorcode**

1) Recent Posts Slider/Carousel
<code>[wpspw_recent_post_slider]</code>

Where Designs for this shortcode is : design-1, design-2, design-3, design-4, design-5, design-6, design-7, design-8, design-9, design-10, design-11, design-12, design-13, design-14, design-15, design-32, design-33, design-38

2) Recent Post with Grid View
<code>[wpspw_recent_post]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-25, design-26, design-27, design-28, design-29, design-31, design-34, design-35, design-37 

3) Post with Grid View
<code>[wpspw_post limit="10"]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-24, design-25, design-26, design-27, design-30, design-34, design-35, design-36, design-37 


* **Complete shortcode example:**
<code>[wpspw_recent_post_slider design="design-1" show_author="true" slides_column="1"
 slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000"
 speed="300" loop="true" limit="5" category="5" category_name="Sports" show_read_more="false"
 show_date="true" show_category_name="true" show_content="true" content_words_limit="20"]</code>
 
 <code>[wpspw_recent_post design="design-16" limit="5" grid="2" show_author="true"
 category="5" category_name="Sports" show_date="true" show_category_name="true" show_content="true"
 content_words_limit="20" show_read_more="false"]</code>
 
 <code>[wpspw_post design="design-16" limit="5" grid="2" show_author="true" category="5" category_name="Sports"
 pagination="true" show_date="true" show_category_name="true" show_content="true" show_full_content="true"
 content_words_limit="20" show_read_more="false"]</code>



= Following are shortcode Parameters: =

<code>[wpspw_post] </code>

* **limit :** [wpspw_post limit="10"] (Display latest 10 post and then pagination).
* **category :** [wpspw_post category="category_id"] (Display post categories wise).
* **grid :** [wpspw_post grid="2"] (Display post in Grid formats. You can use grid:1,2,3,4).
* **design :** [wpspw_post design="design-16"] (Select the designs for post. Select the design shortcode from Posts -> Pro Designs)
* **show_author :** [wpspw_post show_author="true"] (Display Post author OR not. By default value is "true". Values are "true" and "false" )
* **pagination:** [wpspw_post pagination="false"] (Show/Hide pagination links. By default value is "false". Values are "true" and "false")
* **show_content :** [wpspw_post show_content="true" ] (Display post Short content OR not. By default value is "true". Options are "true" and "false").
* **show_full_content :** [wpspw_post show_full_content="true"] (Display Full post content on main page if you do not want word limit. By default value is "false")
* **show_date :** [wpspw_post show_date="false"] (Display Post date OR not. By default value is "true". Options are "true" and "false")
* **show_category_name :** [wpspw_post show_category_name="true" ] (Display post category name OR not. By default value is "true". Options are "true" and "false").
* **content_words_limit :** [wpspw_post content_words_limit="30" ] (Control post short content Words limit. By default limit is 20 words).
* **show_read_more :** [wpspw_post show_read_more="false"](Show/Hide read more links. By default value is "true". Values are "true" and "false")
* **category_name :** [wpspw_post category_name="Sports"](Display Post category name)

= Following are Recent Post Parameters: =

<code>[wpspw_recent_post]</code>

* **limit :** [wpspw_recent_post limit="10"] (Display latest 10 post and then pagination).
* **category :** [wpspw_recent_post category="category_id"] (Display post categories wise).
* **grid :** [wpspw_recent_post grid="2"] (Display post in Grid formats. You can use grid:1,2,3,4).
* **category_name :** [wpspw_recent_post category_name="Sports"](Display post categories name).
* **design :** [wpspw_recent_post design="design-16"] (Select the designs for post. Select the design shortcode from Posts -> Pro Designs)
* **show_author :** [wpspw_recent_post show_author="true"] (Display post author OR not. By default value is "true". Values are "true" and "false" )
* **show_content :** [wpspw_recent_post show_content="true" ] (Display post Short content OR not. By default value is "true". Options are "true" and "false").
* **show_date :** [wpspw_recent_post show_date="false"] (Display post date OR not. By default value is "true". Options are "true" and "false")
* **show_category_name :** [wpspw_recent_post show_category_name="true" ] (Display post category name OR not. By default value is "true". Options are "true" and "false").
* **content_words_limit :** [wpspw_recent_post content_words_limit="30" ] (Control post short content Words limit. By default limit is 20 words).
* **show_read_more :** [wpspw_recent_post show_read_more="false"](Show/Hide read more links. By default value is "true". Values are "true" and "false")

= Following are Recent Post Parameters: =

<code>[wpspw_recent_post_slider]</code>

* **slides_scroll :** [wpspw_recent_post_slider slides_column="3"] (ie Display number of Post at a time.)
* **slides_scroll :** [wpspw_recent_post_slider slides_scroll="1"] (ie scroll number of Post at a time.)
* **Pagination and arrows:** [wpspw_recent_post_slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval:** [wpspw_recent_post_slider autoplay="true" autoplay_interval="100"]
* **Slide Speed:** [wpspw_recent_post_slider speed="3000"]
* **loop:** [wpspw_recent_post_slider loop="true"](values are "true" and "false")
* **limit :** [wpspw_recent_post_slider limit="10"] (Display latest 10 post in slider).
* **category :** [wpspw_recent_post_slider category="category_id"] (Display post categories wise).
* **category_name :** [wpspw_recent_post_slider category_name="Sports"](Display post categories name).
* **design :** [wpspw_recent_post_slider design="design-1"] (Select the designs for post. Select the design shortcode from Posts -> Pro Designs)
* **show_date :** [wpspw_recent_post_slider show_date="false"] (Display post date OR not. By default value is "true". Options are "true" and "false")
* **show_content :** [wpspw_recent_post_slider show_content="true" ] (Display post Short content OR not. By default value is "true". Options are "true" and "false").
* **show_category_name :** [wpspw_recent_post_slider show_category_name="true" ] (Display post category name OR not. By default value is "true". Options are "true" and "false").
* **content_words_limit :** [wpspw_recent_post_slider content_words_limit="30" ] (Control post short content Words limit. By default limit is 20 words).
* **show_read_more :** [wpspw_recent_post_slider show_read_more="false"](Show/Hide read more links. By default value is "true". Values are "true" and "false")



== Changelog ==

= 1.0.2 (13, APR 2016) =
* [*] Fixed some css issues.
* [*] Resolved slick slider initialize issue.

= 1.0.1 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.0.2 (13, APR 2016) =
* [*] Fixed some css issues.
* [*] Resolved slick slider initialize issue.

= 1.0.1 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.0 =
* Initial release