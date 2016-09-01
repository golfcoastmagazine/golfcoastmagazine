<?php
/**
 * Template Name: Front Page
 *
 * @package Listable
 * @since Listable 1.0
 */

get_header();

global $post; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


			<?php
			while ( have_posts() ) : the_post();
				// we'll return a random attachment from image and videos background lists, if one is present
				$the_random_hero = listable_get_random_hero_object();

				$has_image       = false; ?>

				<?php if ( ( empty( $the_random_hero ) || property_exists( $the_random_hero, 'post_mime_type' ) || strpos( $the_random_hero->post_mime_type, 'video' ) !== false ) && is_object( $the_random_hero ) && property_exists( $the_random_hero, 'post_mime_type' ) && strpos( $the_random_hero->post_mime_type, 'image' ) !== false ) {
					$has_image = wp_get_attachment_url( $the_random_hero->ID );
				} ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header has-image">
						<div class="entry-featured"<?php if ( ! empty( $has_image ) ) {
							echo ' style="background-image: url(' . listable_get_inline_background_image( $has_image ) . ');"';
						} ?>>
							<?php if ( ! empty( $the_random_hero ) && property_exists( $the_random_hero, 'post_mime_type' ) && strpos( $the_random_hero->post_mime_type, 'video' ) !== false ) {
								$mimetype = str_replace( 'video/', '', $the_random_hero->post_mime_type );
								if ( has_post_thumbnail( $the_random_hero->ID ) ) {
									$image = wp_get_attachment_url( get_post_thumbnail_id( $the_random_hero->ID ) );
									$poster = ' poster="' . $image . '" ';
								} else {
									$poster = ' ';
								}
								echo do_shortcode( '[video ' . $mimetype . '="' . wp_get_attachment_url( $the_random_hero->ID ) . '"' . $poster . 'loop="true" autoplay="true"][/video]' );
							} ?>
						</div>
						<div class="header-content">
							<h1 class="page-title"><?php the_title(); ?></h1>

							<div class="entry-subtitle">
								<?php if ( $post->post_excerpt ) {
									the_excerpt();
								} ?>
							</div>

							<?php get_template_part( 'job_manager/job-filters-hero' ); ?>

						</div>

						<div class="top-categories">

                            <?php listable_display_frontpage_listing_categories(); ?>
						</div>

					</header>

                    <?php if ( is_active_sidebar( 'front_page_sections' ) ) { ?>
                        <div class="widgets_area">
                            <?php //dynamic_sidebar( 'front_page_sections' ); ?>
                        </div>
                    <?php } ?>

                </article><!-- #post-## -->

            <?php endwhile; // End of the loop. ?>

<!-- custom development start  -->

<div class="blog-home">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-8">

                    <div class="row blog-widget-container">

                        <div class="col-md-12">
                            <h4 class="section-title"><span>Our Stories</span></h4>
                        </div>


                        <?php

                        $args = array(
                            'posts_per_page'    => 8,
                            'post_status'    => 'publish',
                        );

                        // the query
                        $the_query = new WP_Query( $args ); ?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <!-- pagination here -->

                            <!-- the loop -->
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                <div class="col-md-6 col-sm-6">

                                    <article class="blog-widget">


                                        <div class="blog-widget-top">

                                            <div class="widget-thumbnail">

                                                <?php the_post_thumbnail('story'); ?>
                                            </div>

                                            <div class="blog-widget-top-content">
                                                <div class="blog-home-title">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <h2><?php the_title(); ?></h2>
                                                    </a>
                                                </div>

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

                                            <p><?php the_excerpt_max_charlength(120);?> <a href="<?php echo get_post_permalink(); ?>" class="read-more">read more <i class="fa fa-long-arrow-right"></i></a></p>

                                            <div class="blog-meta">


                                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></span>

                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time></span>

                                            </div>

                                        </div>



                                    </article>


                                </div>

                            <?php endwhile; ?>
                            <!-- end of the loop -->

                            <!-- pagination here -->

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>

                        <?php

                        echo do_shortcode( '[ajax_load_more post_type="post" offset="8" posts_per_page="6" pause="true" scroll="false" transition="fade" images_loaded="true" button_label="load more stories" button_loading_label="loading stories..."]' );
                        ?>



                    </div>

                    <!-- end all blog post -->


                </div>


                <!--     sidebar      -->
                <div class="col-md-4 col-sm-4">

                    <div class="featured-video">
                        <h4 class="widget-title"><span>Featured Video</span></h4>

                        <?php

                        $args = array(
                            'posts_per_page'    => 1,
                            'post_status'    => 'publish',
                            'post_type' => 'video',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'video_category',
                                    'field'    => 'slug',
                                    'terms'    => 'featured',
                                ),
                            ),
                        );

                        // the query
                        $the_query = new WP_Query( $args ); ?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <!-- pagination here -->

                            <!-- the loop -->
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                <?php

                                    echo get_post_meta(get_the_ID(),'gm_embedded_code', true);

                                ?>

                            <?php endwhile; ?>
                            <!-- end of the loop -->

                            <!-- pagination here -->

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>

                    </div>


                    <div class="social-count">
                        <h4 class="widget-title"><span>Stay Connected</span></h4>

                        <?php
                            echo do_shortcode( '[aps-counter]' );
                        ?>

                    </div>

                    <div class="more-videos">
                        <h4 class="widget-title"><span>More Videos</span></h4>

                        <?php

                        $args = array(
                            'posts_per_page'    => 4,
                            'post_status'    => 'publish',
                            'post_type' => 'video'
                        );

                        // the query
                        $the_query = new WP_Query( $args ); ?>

                        <?php if ( $the_query->have_posts() ) : ?>

                            <!-- pagination here -->

                            <!-- the loop -->
                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                                <?php

                                echo get_post_meta(get_the_ID(),'gm_embedded_code', true);

                                ?>

                            <?php endwhile; ?>
                            <!-- end of the loop -->

                            <!-- pagination here -->

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                        <?php endif; ?>


                    </div>


                </div>

            </div>
        </div>
</div>
<!-- end blog section home-->

<!-- //custom development start  -->



		</main>
		<!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();