=== WP News and Widget - Masonry Layout  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress news plugin, main news page scrolling , wordpress vertical news plugin widget, wordpress horizontal news plugin widget , Free scrolling news wordpress plugin, Free scrolling news widget wordpress plugin, WordPress set post or page as news, WordPress dynamic news, news, latest news, custom post type, cpt, widget, vertical news scrolling widget, news widget, Masonry designs, Masonry
Requires at least: 3.1
Tested up to: 4.5.1
Author URI: http://wponlinesupport.com
Stable tag: trunk

WP News and Widget - Masonry Layout is the addon of WP News and Scrolling Widgets plugin and it works with both the free and PRO plugin.
This plugin simply creates the Masonry Layout of News Post with various designs, with Ajax Load more functionality and with various shortcode paremeters. 
This plugin works cool with WP News and Widget Pro plugin.

== Description ==

WP News and Widget with Masonry Layout.

View [DEMO and Features](http://demo.wponlinesupport.com/prodemo/masonry-add-on-wp-news-and-widget-demo/) for additional information.

= Important Note For How to Install =
* Please make sure that Permalink link should not be "/news" Otherwise all your news will go to archive page. You can give it other name like "/ournews, /latestnews etc"  
* Now you can Display news post with the help of short code : 
<code> [sp_news_masonry] </code>
* Also you can Display the news post with category wise :
<code> Sports news [sp_news_masonry category="category_id"] </code>
* Display News with Grid:
<code>[sp_news_masonry grid="2"] </code>
* Also you can Display the news post with Multiple categories wise 
<code> Sports news : 
[sp_news_masonry category="category_id"]
Arts news 
[sp_news_masonry category="category_id"]
</code>
* **Complete shortcode example:**
<code>[sp_news_masonry limit="10" category="category_id" grid="2"
 show_content="true" show_full_content="true" show_category_name="true"
show_date="false" content_words_limit="30" ]</code>
* Template code : 
<code><?php echo do_shortcode('[sp_news_masonry]'); ?></code>


= Following are News Parameters: =

* **Limit :** [sp_news_masonry limit="10"] (Display latest 10 news and then pagination).
* **Category :**  [sp_news_masonry category="category_id"] (Display News categories wise).
* **Category Name :**  [sp_news_masonry category_name="Sports"] (Display category name before grid).
* **Design :**  [sp_news_masonry design="design-1"] (Select the designs for News Masonry Layout. Select the design shortcode from News Pro -> Masonry Designs)
* **Grid :** [sp_news_masonry grid="2"] (Display News in Grid formats.)
* **Pagination :** [sp_news_masonry pagination="false"] (Show/Hide pagination links. By default value is "false". Values are "true" and "false")
* **Show Date :** [sp_news_masonry show_date="true"] (Display News date OR not. By default value is "True". Options are "ture OR false")
* **Show Category Name :** [sp_news_masonry show_category_name="true" ] (Display News category name OR not. By default value is "True". Options are "ture OR false").
* **Show Content :** [sp_news_masonry show_content="true" ] (Display News Short content OR not. By default value is "True". Options are "ture OR false").
* **Content Words Limit :** [sp_news_masonry content_words_limit="30" ] (Control News short content Words limt. By default limit is 20 words).
* **Show Read More :** [sp_news_masonry show_read_more="false"] (Show/Hide read more links. By default value is "false". Values are "true" and "false")
* **Content Tail :** [sp_news_masonry content_tail="..."] (Display three dots or [...] after content.)
* **Order :** [sp_news_masonry order="DESC"] (Controls News post order. Values are "ASC" OR "DESC".)
* **Orderby :** [sp_news_masonry orderby="post_date"] (Display News post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [sp_news_masonry link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Posts :** [sp_news_masonry posts="1,5,6"] (Display only specific News posts.)
* **Exclude Post :** [sp_news_masonry exclude_post="1,5,6"] (Exclude some news post which you do not want to display.)
* **Load More Text :** [sp_news_masonry load_more_text="Load More Post"] (Display load more button text.)
* **Effect :** [sp_news_masonry effect="effect-1"] (Load News post with effect. Values are "effect-1", "effect-2", "effect-3", "effect-4", "effect-5", "effect-6" and "effect-7")
* **Jetpack Sharing :** [sp_news_masonry jet_sharing="true"] (Display jetpack sharing with masonry layout. Values are "true" and "false")


== Installation ==

1. Upload the 'wp-news-and-widget-masonry-addon' folder to the '/wp-content/plugins/' directory.
2. Activate the WP News and Widget - Masonry Layout plugin through the 'Plugins' menu in WordPress.
3. Add and manage news items on your site by clicking on the  'News' tab that appears in your admin menu.
4. Create a page with the any name and paste this short code  <code> [sp_news_masonry] </code>.
 
== Frequently Asked Questions ==

= Are there shortcodes for news items? =

Yse, <code>[sp_news_masonry]</code>.


== Changelog == 

= 1.0.1 (02, May 2016) =
* Optimized some CSS.

= 1.0 (02, May 2016) =
* Initial release

== Upgrade Notice ==

= 1.0.1 (02, May 2016) =
* Optimized some CSS.

= 1.0 (02, May 2016) =
Initial release