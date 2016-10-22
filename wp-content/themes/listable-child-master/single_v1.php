<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Listable
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="section-top">

                <?php the_post_thumbnail(); ?>

                    <div class="story-header">
                        <div class="story-cat">

                            <?php


                            $categories = get_the_category(get_the_ID());

                            foreach($categories as $cat){

                                echo '<a href=" '.get_category_link( $cat->cat_ID ).' " class="btn gcm-btn">'.$cat->name.'</a>';
                            }
                            ?>

                        </div>
                        <h1 class="story-title"><?php the_title(); ?></h1>
                        <div class="published-by">
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i>  <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time></span>
                        </div>
                    </div>


            </div>

            <div class="container">

                <div class="story-container">
                    <div class="col-sm-8">

                        <?php the_post_thumbnail(); ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>">

                            <div class="story-meta">
                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></span>
                                <span class="story-share">Share this story: <i class="fa fa-facebook-square" aria-hidden="true"></i><i class="fa fa-twitter-square" aria-hidden="true"></i> </span>
                            </div>

                            <div class="story-content">

                                <?php the_content(); ?>
                            </div>

                        </article>

                            <?php //the_post_navigation(); ?>

                        <?php endwhile; // End of the loop. ?>

                        <div class="row next-pre">

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="previous-post">

                                    <?php $prev_post = get_adjacent_post( false, '', true); ?>

                                    <?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
                                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="btn btn-border"><i class="fa fa-long-arrow-left"></i> Previous Story</a>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="next-post">

                                    <?php $next_post = get_adjacent_post( false, '', false ); ?>
                                    <?php if ( is_a( $next_post, 'WP_Post' ) ) {  ?>
                                        <a href="<?php echo get_permalink( $next_post->ID ); ?>"  class="btn btn-border">Next Story <i class="fa fa-long-arrow-right"></i></a>
                                    <?php } ?>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <h4 class="section-title"><span>About Author</span></h4>

                                <div class="about-author">

                                    <div class="row">

                                        <div class="col-md-3 col-xs-4">
                                            <?php echo get_avatar( get_the_author_meta('email'), '150'); ?>
                                        </div>
                                        <div class="col-md-8 col-xs-8">

                                            <h3 class="user-name"><?php  echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name'); ?></h3>

                                            <p class="company-info">
                                                <?php echo get_the_author_meta('description') ; ?>
                                            </p>

                                            <h3 class="view-all-post">
                                                <?php the_author_posts_link(); ?>
                                            </h3>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row similar-story">
                            <div class="col-md-12">

                                <h4 class="section-title"><span>Recommended Stories</span></h4>
                            </div>


                            <?php
                            $orig_post = $post;
                            global $post;
                            $tags = wp_get_post_tags($post->ID);

                            $term_ids = wp_get_post_terms($post->ID, 'category', array("fields" => "ids"));

                            if ($tags) {
                                $tag_ids = array();

                                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                                $args=array(
                                    //'tag__in' => $tag_ids,
                                    'post__not_in' => array($post->ID),
                                    'posts_per_page'=>4, // Number of related posts to display.
                                    //'caller_get_posts'=>1
                                );

                                $query_article = new wp_query( $args );
                                while( $query_article->have_posts() ) {
                                    $query_article->the_post();
                                    ?>


                                    <div class="col-md-6 col-sm-6">

                                        <article class="blog-widget">


                                            <div class="blog-widget-top">

                                                <div class="widget-thumbnail">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <?php the_post_thumbnail('story'); ?>
                                                    </a>
                                                </div>

                                                <div class="blog-widget-top-content">


                                                    <div class="blog-category">

                                                        <?php


                                                        $categories = get_the_category(get_the_ID());

                                                        foreach($categories as $cat){

                                                            echo '<a href=" '.get_category_link( $cat->cat_ID ).' " class="btn gcm-btn">'.$cat->name.'</a>';
                                                        }
                                                        ?>


                                                    </div>

                                                </div>


                                            </div>


                                            <div class="blog-excerpt">

                                                <div class="blog-home-title">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <h2><?php the_title(); ?></h2>
                                                    </a>
                                                </div>

                                                <div class="blog-meta">


                                                    <span><i class="fa fa-user" aria-hidden="true"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></span>

                                                    <span><i class="fa fa-clock-o" aria-hidden="true"></i> <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time></span>

                                                </div>

                                            </div>



                                        </article>


                                    </div>



                                <?php }
                            }
                            else{

                                $args=array(
                                    'category__in' => $term_ids,
                                    'post__not_in' => array($post->ID),
                                    'posts_per_page'=>4, // Number of related posts to display.
                                );

                                $query_article = new wp_query( $args );
                                while( $query_article->have_posts() ) {
                                    $query_article->the_post();
                                    ?>

                                    <div class="col-md-6 col-sm-6">

                                        <article class="blog-widget">


                                            <div class="blog-widget-top">

                                                <div class="widget-thumbnail">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <?php the_post_thumbnail('story'); ?>
                                                    </a>
                                                </div>

                                                <div class="blog-widget-top-content">


                                                    <div class="blog-category">

                                                        <?php


                                                        $categories = get_the_category(get_the_ID());

                                                        foreach($categories as $cat){

                                                            echo '<a href=" '.get_category_link( $cat->cat_ID ).' " class="btn gcm-btn">'.$cat->name.'</a>';
                                                        }
                                                        ?>


                                                    </div>

                                                </div>


                                            </div>


                                            <div class="blog-excerpt">

                                                <div class="blog-home-title">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <h2><?php the_title(); ?></h2>
                                                    </a>
                                                </div>

                                                <div class="blog-meta">


                                                    <span><i class="fa fa-user" aria-hidden="true"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></span>

                                                    <span><i class="fa fa-clock-o" aria-hidden="true"></i> <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time></span>

                                                </div>

                                            </div>



                                        </article>


                                    </div>

                                <?php }
                            }
                            $post = $orig_post;
                            wp_reset_query();
                            ?>


                        </div>

                    </div>

                    <div class="col-sm-4">

                        <?php get_template_part( 'template-parts/content', 'sidebar' ); ?>

                    </div>


                </div>

            </div>



            <?php// while ( have_posts() ) : the_post(); ?>

            <?php// get_template_part( 'template-parts/content', 'single' ); ?>

            <?php// the_post_navigation(); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            //if ( comments_open() || get_comments_number() ) :
            //    comments_template();
            //endif;
            ?>


            <?php// endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php do_action( 'listable_before_page_content' ); ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>