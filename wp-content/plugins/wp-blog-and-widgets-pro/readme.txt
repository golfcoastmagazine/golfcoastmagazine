=== WP Blog and Widget Pro  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress blog , wordpress blog widget, Free wordpress blog, blog custom post type, blog tab, blog menu, blog page with custom post type, blog, latest blog, custom post type, cpt, widget
Requires at least: 3.1
Tested up to: 4.4.2
Author URI: http://wponlinesupport.com
Stable tag: trunk

A quick, easy way to add an Blog custom post type, Blog widget to Wordpress.

== Description ==

Every CMS site needs a Blog section. WP Blog and widgets, manage and display blog, date archives, widget on your website. You can display latest blog post on your homepage/frontpage as well as
in inner page. 

This plugin add a Blog custom post type,  blog widget to your Wordpress site. WP Blog adds a Blog Pro tab to your admin menu, which allows you to enter Blog post just as you would regular posts.


**This wordpress blog plugin contains 3 shorcode**

1) Recent Blog Posts Slider/Carousel
<code>[recent_blog_post_slider]</code>

Where Designs for this shortcode is : design-1, design-2, design-3, design-4, design-5, design-6, design-7, design-8, design-9, design-10, design-11, design-12, design-13, design-14, design-15, design-32, design-33, design-38, design-39, design-40, design-41, design-43, design-46

2) Recent Blog Post with Grid View
<code>[recent_blog_post]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-23, design-25, design-26, design-27, design-28, design-29, design-31, design-34, design-35, design-37, design-42, design-44, design-45, design-47, design-48, design-49, design-50

3) Blog Post with Grid View
<code>[blog limit="10"]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-24, design-25, design-26, design-27, design-30, design-34, design-35, design-36, design-37, design-42, design-44, design-45, design-48 


* **Complete shortcode example:**
 <code>[recent_blog_post_slider design="design-1" show_author="true" slides_column="1"
 slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000"
 speed="300" loop="true" limit="5" category="5" category_name="Sports" show_read_more="false"
 show_date="true" show_category_name="true" show_content="true" content_words_limit="20" content_tail="..." order="DESC" orderby="post_date" link_target="blank" image_height="300"]</code>
 
 <code>[recent_blog_post design="design-16" limit="5" grid="2" show_author="true"
 category="5" category_name="Sports" show_date="true" show_category_name="true" show_content="true"
 content_words_limit="20" show_read_more="false" content_tail="..." order="DESC" orderby="post_date" link_target="blank" image_height="300"]</code>
 
 <code>[blog design="design-16" limit="5" grid="2" show_author="true" category="5" category_name="Sports"
 pagination="true" show_date="true" show_category_name="true" show_content="true" show_full_content="true"
 content_words_limit="20" show_read_more="false" content_tail="..." order="DESC" orderby="post_date" link_target="blank" image_height="300"]</code>



= Following are blog Parameters: =

<code>[blog] </code>

* **limit :** [blog limit="10"] (Display latest 10 blog post and then pagination).
* **category :** [blog category="category_id"] (Display blog post categories wise).
* **grid :** [blog grid="2"] (Display blog post in Grid formats. You can use grid:1,2,3,4).
* **design :** [blog design="design-16"] (Select the designs for blog post. Select the design shortcode from Blog Pro -> Pro Blog Designs)
* **show_author :** [blog show_author="true"] (Display Blog author OR not. By default value is “true”. Values are “true” OR “false” )
* **pagination:** [blog pagination="false"] (Show/Hide pagination links. By default value is “false”. Values are “true” and “false”)
* **show_content :** [blog show_content="true" ] (Display Blog post Short content OR not. By default value is “True”. Options are “true OR false”).
* **show_full_content :** [blog show_full_content="true"] (Display Full blog content on main page if you do not want word limit. By default value is “false”)
* **show_date :** [blog show_date="false"] (Display Blog date OR not. By default value is “true”. Options are “true OR false”)
* **show_category_name :** [blog show_category_name="true" ] (Display Blog post category name OR not. By default value is “true”. Options are “true OR false”).
* **content_words_limit :** [blog content_words_limit="30" ] (Control Blog post short content Words limit. By default limit is 20 words).
* **show_read_more :** [blog show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **category_name :** [blog  category_name="Sports"](Display Blog category name)
* **Content Tail :** [blog content_tail="..."] (Display dots after the post content.)
* **Order :** [blog order="DESC"] (Controls Blog post order. Values are "ASC" OR "DESC".)
* **Orderby :** [blog orderby="post_date"] (Display Blog post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [blog link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [blog image_height="500"] (Control Blog post image height.)

= Following are Recent Blog Post Parameters: =

<code>[recent_blog_post]</code>

* **limit :** [recent_blog_post limit="10"] (Display latest 10 blog post and then pagination).
* **category :** [recent_blog_post category="category_id"] (Display blog post categories wise).
* **grid :** [recent_blog_post grid="2"] (Display blog post in Grid formats. You can use grid:1,2,3,4).
* **category_name :** [recent_blog_post category_name="Sports"](Display Blog categories name).
* **design :** [recent_blog_post design="design-16"] (Select the designs for blog post. Select the design shortcode from Blog Pro -> Pro Blog Designs)
* **show_author :** [recent_blog_post show_author="true"] (Display Blog author OR not. By default value is “true”. Values are “true” OR “false” )
* **show_content :** [recent_blog_post show_content="true" ] (Display Blog post Short content OR not. By default value is “True”. Options are “true OR false”).
* **show_date :** [recent_blog_post show_date="false"] (Display Blog date OR not. By default value is “true”. Options are “true OR false”)
* **show_category_name :** [recent_blog_post show_category_name="true" ] (Display Blog post category name OR not. By default value is “true”. Options are “true OR false”).
* **content_words_limit :** [recent_blog_post content_words_limit="30" ] (Control Blog post short content Words limit. By default limit is 20 words).
* **show_read_more :** [recent_blog_post show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **Content Tail :** [recent_blog_post content_tail="..."] (Display dots after the post content.)
* **Order :** [recent_blog_post order="DESC"] (Controls Blog post order. Values are "ASC" OR "DESC".)
* **Orderby :** [recent_blog_post orderby="post_date"] (Display Blog post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [recent_blog_post link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [recent_blog_post image_height="500"] (Control Blog post image height.)

= Following are Recent Blog Post Parameters: =

<code>[recent_blog_post_slider]</code>

* **slides_scroll :** [recent_blog_post_slider slides_column="3"] (ie Display number of Blog Post at a time.)
* **slides_scroll :** [recent_blog_post_slider slides_scroll="1"] (ie scroll number of Blog Post at a time.)
* **Pagination and arrows:** [recent_blog_post_slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval:** [recent_blog_post_slider autoplay="true" autoplay_interval="100"]
* **Slide Speed:** [recent_blog_post_slider speed="3000"]
* **loop:** [recent_blog_post_slider loop="true"](values are “true” OR “false”)
* **limit :** [recent_blog_post_slider limit="10"] (Display latest 10 Blog post in slider).
* **category :** [recent_blog_post_slider category="category_id"] (Display blog post categories wise).
* **category_name :** [recent_blog_post_slider category_name="Sports"](Display Blog categories name).
* **design :** [recent_blog_post_slider design="design-1"] (Select the designs for Blog post. Select the design shortcode from Blog Pro -> Pro Blog Designs)
* **show_date :** [recent_blog_post_slider show_date="false"] (Display blog date OR not. By default value is “true”. Options are “true OR false”)
* **show_content :** [recent_blog_post_slider show_content="true" ] (Display Blog post Short content OR not. By default value is “True”. Options are “true OR false”).
* **show_category_name :** [recent_blog_post_slider show_category_name="true" ] (Display Blog post category name OR not. By default value is “true”. Options are “true OR false”).
* **content_words_limit :** [recent_blog_post_slider content_words_limit="30" ] (Control blog post short content Words limit. By default limit is 20 words).
* **show_read_more :** [recent_blog_post_slider show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **Content Tail :** [recent_blog_post_slider content_tail="..."] (Display dots after the post content.)
* **Order :** [recent_blog_post_slider order="DESC"] (Controls Blog post order. Values are "ASC" OR "DESC".)
* **Orderby :** [recent_blog_post_slider orderby="post_date"] (Display Blog post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [recent_blog_post_slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [recent_blog_post_slider image_height="500"] (Control Blog post image height.)


== Changelog ==

= 1.1.8 (12, APR 2016) =
* [+] Added 2 more new designs.

= 1.1.7 (12, APR 2016) =
* [+] Added 10 more stunning designs.
* [+] Introduced a long awaited feature 'Grid Slider' with cool designs.
* [+] Added links on images and title in all designs.
* [+] Added 'content_tail' short code parameter for text.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for blog post ordering.
* [+] Added 'orderby' short code parameter for blog post order by.
* [+] Added Drag & Drop feature to display blog post in your desired order.
* [+] Added plugin settings page for custom CSS and default post featured image.
* [+] Added 'publicize' Jetpack support for blog post type.
* [+] Added some filters to change blog post type slug and taxonomy slug.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added German (Switzerland), Spanish (Spain), French (Canada), Italian and Dutch Beta translation.
* [*] Improved 'Blog Categories' widget and added more options in widget.
* [*] Optimized slick slider and blog ticker js enqueue process.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Code optimization and improved plugin performance.
* [*] Improved PRO plugin design page.

= 1.1.6 =
* Fixed some slider bugs.

= 1.1.5 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1.4 =
* Fixed some bug
* change blog_post to blog

= 1.1.3 =
* Added Blog category widget
* Fixed some bugs
* Added language for German, French (France)  (Beta)

= 1.1.2 =
* Added 2 New designs (design-37 and design-38)
* Fixed some bugs

= 1.1.1 =
* Fixed some design bug
* Added language for German, French (France)  (Beta)

= 1.1 =
* Fixed some design bug

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.1.8 (12, APR 2016) =
* [+] Added 2 more new designs.

= 1.1.7 (12, APR 2016) =
* [+] Added 10 more stunning designs.
* [+] Introduced a long awaited feature 'Grid Slider' with cool designs.
* [+] Added links on images and title in all designs.
* [+] Added 'content_tail' short code parameter for text.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for blog post ordering.
* [+] Added 'orderby' short code parameter for blog post order by.
* [+] Added Drag & Drop feature to display blog post in your desired order.
* [+] Added plugin settings page for custom CSS and default post featured image.
* [+] Added 'publicize' Jetpack support for blog post type.
* [+] Added some filters to change blog post type slug and taxonomy slug.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added German (Switzerland), Spanish (Spain), French (Canada), Italian and Dutch Beta translation.
* [*] Improved 'Blog Categories' widget and added more options in widget.
* [*] Optimized slick slider and blog ticker js enqueue process.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Code optimization and improved plugin performance.
* [*] Improved PRO plugin design page.

= 1.1.6 =
* Fixed some slider bugs.

= 1.1.5 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1.4 =
* Fixed some bug
* change blog_post to blog

= 1.1.3 =
* Added Blog category widget
* Fixed some bugs
* Added language for German, French (France)  (Beta)

= 1.1.2 =
* Added 2 New designs (design-37 and design-38)
* Fixed some bugs

= 1.1.1 =
* Fixed some design bug
* Added language for German, French (France)  (Beta)

= 1.1 =
* Fixed some design bug

= 1.0 =
* Initial release