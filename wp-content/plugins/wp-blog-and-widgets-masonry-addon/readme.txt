=== WP Blog and Widget - Masonry Layout  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress blog plugin, main blog page scrolling , wordpress vertical blog plugin widget, wordpress horizontal blog plugin widget , Free scrolling blog wordpress plugin, Free scrolling blog widget wordpress plugin, WordPress set post or page as blog, WordPress dynamic blog, blog, latest blog, custom post type, cpt, widget, vertical blog scrolling widget, blog widget, Masonry designs, Masonry
Requires at least: 3.1
Tested up to: 4.5.1
Author URI: http://wponlinesupport.com
Stable tag: trunk

WP Blog and Widget - Masonry Layout is the addon of WP Blog and Scrolling Widgets plugin and it works with both the free and PRO plugin.
This plugin simply creates the Masonry Layout of Blog Post with various designs, with Ajax Load more functionality and with various shortcode paremeters. 
This plugin works cool with WP Blog and Widget Pro plugin.

== Description ==

WP Blog and Widget with Masonry Layout.

View [DEMO and Features](http://demo.wponlinesupport.com/prodemo/masonry-add-on-wp-blog-and-widget-demo/) for additional information.

= Important Note For How to Install =
* Now you can Display blog post with the help of short code : 
<code> [sp_blog_masonry] </code>
* Also you can Display the blog post with category wise :
<code> Sports blog [sp_blog_masonry category="category_id"] </code>
* Display Blog with Grid:
<code>[sp_blog_masonry grid="2"] </code>
* Also you can Display the blog post with Multiple categories wise 
<code> Sports blog : 
[sp_blog_masonry category="category_id"]
Arts blog 
[sp_blog_masonry category="category_id"]
</code>
* **Complete shortcode example:**
<code>[sp_blog_masonry limit="10" category="category_id" grid="2"
 show_content="true" show_full_content="true" show_category_name="true"
show_date="false" content_words_limit="30" ]</code>
* Template code : 
<code><?php echo do_shortcode('[sp_blog_masonry]'); ?></code>


= Following are Blog Masonry Parameters: =

* **Limit :** [sp_blog_masonry limit="10"] (Display latest 10 blog and then pagination).
* **Category :**  [sp_blog_masonry category="category_id"] (Display Blog categories wise).
* **Category Name :**  [sp_blog_masonry category_name="Sports"] (Display category name before grid).
* **Design :**  [sp_blog_masonry design="design-1"] (Select the designs for Blog Masonry Layout. Select the design shortcode from Blog Pro -> Masonry Designs)
* **Grid :** [sp_blog_masonry grid="2"] (Display Blog in Grid formats.)
* **Pagination :** [sp_blog_masonry pagination="false"] (Show/Hide pagination links. By default value is "false". Values are "true" and "false")
* **Show Date :** [sp_blog_masonry show_date="true"] (Display Blog date OR not. By default value is "True". Options are "ture OR false")
* **Show Category Name :** [sp_blog_masonry show_category_name="true" ] (Display Blog category name OR not. By default value is "True". Options are "ture OR false").
* **Show Content :** [sp_blog_masonry show_content="true" ] (Display Blog Short content OR not. By default value is "True". Options are "ture OR false").
* **Content Words Limit :** [sp_blog_masonry content_words_limit="30" ] (Control Blog short content Words limt. By default limit is 20 words).
* **Show Read More :** [sp_blog_masonry show_read_more="false"] (Show/Hide read more links. By default value is "false". Values are "true" and "false")
* **Content Tail :** [sp_blog_masonry content_tail="..."] (Display three dots or [...] after content.)
* **Order :** [sp_blog_masonry order="DESC"] (Controls Blog post order. Values are "ASC" OR "DESC".)
* **Orderby :** [sp_blog_masonry orderby="post_date"] (Display Blog post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [sp_blog_masonry link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Posts :** [sp_blog_masonry posts="1,5,6"] (Display only specific Blog posts.)
* **Exclude Post :** [sp_blog_masonry exclude_post="1,5,6"] (Exclude some blog post which you do not want to display.)
* **Load More Text :** [sp_blog_masonry load_more_text="Load More Post"] (Display load more button text.)
* **Effect :** [sp_blog_masonry effect="effect-1"] (Load Blog post with effect. Values are "effect-1", "effect-2", "effect-3", "effect-4", "effect-5", "effect-6" and "effect-7")
* **Jetpack Sharing :** [sp_blog_masonry jet_sharing="true"] (Display jetpack sharing with masonry layout. Values are "true" and "false")


== Installation ==

1. Upload the 'wp-blog-and-widget-masonry-addon' folder to the '/wp-content/plugins/' directory.
2. Activate the WP Blog and Widget - Masonry Layout plugin through the 'Plugins' menu in WordPress.
3. Add and manage blog items on your site by clicking on the  'Blog' tab that appears in your admin menu.
4. Create a page with the any name and paste this short code  <code> [sp_blog_masonry] </code>.

== Frequently Asked Questions ==

= Are there shortcodes for blog items to display in masonry layout? =

Yse, <code>[sp_blog_masonry]</code>.


== Changelog == 

= 1.0 (04, May 2016) =
* Initial release

== Upgrade Notice ==

= 1.0 (04, May 2016) =
Initial release