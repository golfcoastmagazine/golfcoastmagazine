=== WP News and Five Widgets Pro  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress news plugin, main news page scrolling , wordpress vertical news plugin widget, wordpress horizontal news plugin widget , Free scrolling news wordpress plugin, Free scrolling news widget wordpress plugin, WordPress set post or page as news, WordPress dynamic news, news, latest news, custom post type, cpt, widget, vertical news scrolling widget, news widget
Requires at least: 3.1
Tested up to: 4.5
Author URI: http://wponlinesupport.com
Stable tag: trunk

A quick, easy way to add an News custom post type, News widget to WordPress website.

== Description ==

Every CMS site needs a news section. WP News and widget pro  allows you add, manage and display news, date archives, widget on your website.

Added 2 shortcodes
<code>[sp_news] and [sp_news_slider]</code>

= Following are News Parameters: =
<code>[sp_news]</code>
* **limit :** [sp_news limit="10"] (Display latest 10 news and then pagination).
* **category :**  [sp_news category="category_id"] (Display News categories wise).
* **category_name :** [sp_news category_name="Sports"] (Display News categories name).
* **design :** [sp_news design="design-16"] (Select the designs for news post. Select the design shortcode from News Pro -> Pro News Designs) 
* **grid :** [sp_news grid="2"] (Display News in Grid formats).
* **pagination: ** [sp_news pagination="false"] (Show/Hide pagination links. By default value is "false". Values are "true" and "false")
* **show_date :** [sp_news show_date="false"] (Display News date OR not. By default value is "True". Options are "ture OR false")
* **show_full_content :** [sp_news show_full_content="true"] (Display Full news content on main page if you do not want word limit. By default value is "false")
* **show_content :** [sp_news show_content="true" ] (Display News Short content OR not. By default value is "True". Options are "ture OR false").
* **show_category_name :** [sp_news show_category_name="true" ] (Display News category name OR not. By default value is "True". Options are "ture OR false").
* **content_words_limit :** [sp_news content_words_limit="30" ] (Control News short content Words limt. By default limit is 20 words).
* **show_read_more :** [sp_news show_read_more="false"] (Show/Hide read more links. By default value is "false". Values are "true" and "false")
* **content_tail :** [sp_news_slider content_tail="..."] (Display three dots or [...] after content.)
* **Order :** [sp_news_slider order="DESC"] (Controls News post order. Values are "ASC" OR "DESC".)
* **Orderby :** [sp_news_slider orderby="post_date"] (Display News post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [sp_news_slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [sp_news_slider image_height="500"] (Control News post image height.)
* **Posts :** [sp_news_slider posts="1,5,6"] (Display only specific News posts.)
* **Exclude Post :** [sp_news_slider exclude_post="1,5,6"] (Exclude some news post which you do not want to display.)


<code>[sp_news_slider]</code>
* **slides_scroll :** [sp_news_slider slides_column="3"] (ie Display number of News Post at a time.)  
* **slides_scroll :** [sp_news_slider slides_scroll="1"] (ie scroll number of News Post at a time.)
* **Pagination and arrows:** [sp_news_slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval:** [sp_news_slider autoplay="true" autoplayInterval="100"]
* **Slide Speed:** [sp_news_slider speed="3000"]
* **loop:** [sp_news_slider loop="true"] (values are "true" OR "false")
* **limit :** [sp_news_slider limit="10"] (Display latest 10 news and then pagination).
* **category :**  [sp_news_slider category="category_id"] (Display News categories wise).
* **category_name :** [sp_news_slider category_name="Sports"] (Display News categories name).
* **design :** [sp_news_slider design="design-1"] (Select the designs for news post. Select the design shortcode from News Pro -> Pro News Designs) 
* **show_date :** [sp_news_slider show_date="false"] (Display News date OR not. By default value is "True". Options are "ture OR false")
* **show_content :** [sp_news_slider show_content="true" ] (Display News Short content OR not. By default value is "True". Options are "ture OR false").
* **show_category_name :** [sp_news_slider show_category_name="true" ] (Display News category name OR not. By default value is "True". Options are "ture OR false").
* **content_words_limit :** [sp_news_slider content_words_limit="30" ] (Control News short content Words limt. By default limit is 20 words).
* **show_read_more :** [sp_news_slider show_read_more="false"] (Show/Hide read more links. By default value is "false". Values are "true" and "false")
* **content_tail :** [sp_news_slider content_tail="..."] (Display three dots or [...] after content.)
* **Order :** [sp_news_slider order="DESC"] (Controls News post order. Values are "ASC" OR "DESC".)
* **Orderby :** [sp_news_slider orderby="post_date"] (Display News post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [sp_news_slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [sp_news_slider image_height="500"] (Control News post image height.)
* **Posts :** [sp_news_slider posts="1,5,6"] (Display only specific News posts.)
* **Exclude Post :** [sp_news_slider exclude_post="1,5,6"] (Exclude some news post which you do not want to display.)


 
== Installation ==

1. Upload the 'wp-news-and-widget-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the WP News and widget pro plugin through the 'Plugins' menu in WordPress.
3. Add and manage news items on your site by clicking on the  'News' tab that appears in your admin menu.
4. Create a page with the any name and paste this short code  <code> [sp_news] and [sp_news_slider] </code>.


== Changelog ==

= 1.1.6 (22, APR 2016) =
* [+] Added 10 more stunning designs.
* [+] Introduced a long awaited feature 'Grid Slider' with cool designs.
* [+] Added links on images and title in all designs.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for news post ordering.
* [+] Added 'orderby' short code parameter for news post order by.
* [+] Added 'exclude_post' short code parameter to exclude some news post.
* [+] Added 'posts' short code parameter to display only some specific news post.
* [+] Added 'image_height' short code parameter to control News post image height.
* [+] Added Drag & Drop feature to display news post in your desired order.
* [+] Added default post featured image settings.
* [+] Added 'publicize' Jetpack support for news post type.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'News Categories' widget.
* [*] Optimized slick slider and news ticker js enqueue process.
* [*] Resolved slick slider intialize issue.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Code optimization and improved plugin performance.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.

= 1.1.5 =
* Added anchor links on images.
* Added 'content_tail' parameter in shortcode.
* Added custom CSS setting.
* Added user useful links in plugin.
* Added filter to change the plugin post type name and slug.
* Improved plugin functionality.

= 1.1.4 =
* Fixed some bugs.
* Added Turkish(tr_TR) languages (Beta).

= 1.1.3 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1.2 =
* Added translation in German, French (France), Polish languages (Beta)
* Fixed some bug
* Added 2 new design for pro version

= 1.1.1 =
* fixed some bugs

= 1.1 =
* Added 3 more design and fixed some bugs

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.1.6 (22, APR 2016) =
* [+] Added 10 more stunning designs.
* [+] Introduced a long awaited feature 'Grid Slider' with cool designs.
* [+] Added links on images and title in all designs.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for news post ordering.
* [+] Added 'orderby' short code parameter for news post order by.
* [+] Added 'exclude_post' short code parameter to exclude some news post.
* [+] Added 'posts' short code parameter to display only some specific news post.
* [+] Added 'image_height' short code parameter to control News post image height.
* [+] Added Drag & Drop feature to display news post in your desired order.
* [+] Added default post featured image settings.
* [+] Added 'publicize' Jetpack support for news post type.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'News Categories' widget.
* [*] Optimized slick slider and news ticker js enqueue process.
* [*] Resolved slick slider intialize issue.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Code optimization and improved plugin performance.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.

= 1.1.5 =
* Added anchor links on images.
* Added 'content_tail' parameter in shortcode.
* Added custom CSS setting.
* Added user useful links in plugin.
* Added Netherlands(nl_NL) languages (Beta).
* Added filter to change the plugin post type labels and slug.
* Improved plugin functionality.

= 1.1.4 =
* Fixed some bugs.
* Added Turkish(tr_TR) languages (Beta).

= 1.1.3 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1.2 =
* Added translation in German, French (France), Polish languages (Beta)
* Fixed some bug
* Added 2 new design for pro version

= 1.1.1 =
* fixed some bugs

= 1.1 =
* Added 3 more design and fixed some bugs

= 1.0 =
Initial release