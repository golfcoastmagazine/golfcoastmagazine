<?php


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


<!-- custom development start  -->

<div class="blog-home">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-9">

                    <div class="row blog-widget-container">

                        <div class="col-md-12">
                            <h4 class="section-title"><span>Our Stories</span></h4>
                        </div>

<!--                        <li--><?php //if (! has_post_thumbnail() ) { echo ' class="no-img"'; } ?><!-->-->
<!--                            --><?php //if ( has_post_thumbnail() ) { the_post_thumbnail(array(150,150));
//                            }?>
<!--                            <h3><a href="--><?php //the_permalink(); ?><!--" title="--><?php //the_title(); ?><!--">--><?php //the_title(); ?><!--</a></h3>-->
<!--                            <p class="entry-meta">-->
<!--                                --><?php //the_time("F d, Y"); ?>
<!--                            </p>-->
<!--                            --><?php //the_excerpt(); ?>
<!--                        </li>-->


                        <div class="col-md-6 col-sm-6">

                            <article class="blog-widget">


                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <a href="">
                                                <h2>Lorem ipsum dolor sit amet</h2>
                                            </a>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>


                                <div class="blog-excerpt">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>

                                </div>



                            </article>


                        </div>


                        <div class="col-md-6 col-sm-6">
                            <article class="blog-widget">

                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <h2>Lorem ipsum dolor sit amet</h2>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>

                                <div class="blog-excerpt">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>
                                </div>

                            </article>
                        </div>

                        <div class="col-md-6 col-sm-6">

                            <article class="blog-widget">


                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <a href="">
                                                <h2>Lorem ipsum dolor sit amet</h2>
                                            </a>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>


                                <div class="blog-excerpt">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>

                                </div>



                            </article>


                        </div>


                        <div class="col-md-6 col-sm-6">
                            <article class="blog-widget">

                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <h2>Lorem ipsum dolor sit amet</h2>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>

                                <div class="blog-excerpt">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>
                                </div>

                            </article>
                        </div>

                        <div class="col-md-6 col-sm-6">

                            <article class="blog-widget">


                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <a href="">
                                                <h2>Lorem ipsum dolor sit amet</h2>
                                            </a>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>


                                <div class="blog-excerpt">

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>

                                </div>



                            </article>


                        </div>


                        <div class="col-md-6 col-sm-6">
                            <article class="blog-widget">

                                <div class="blog-widget-top">

                                    <div class="widget-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>

                                    <div class="blog-widget-top-content">
                                        <div class="blog-home-title">
                                            <h2>Lorem ipsum dolor sit amet</h2>
                                        </div>

                                        <div class="blog-category">
                                            <a href="" class="btn gcm-btn">Golf</a>
                                            <a href="" class="btn gcm-btn">Golf Coast News</a>
                                        </div>

                                    </div>


                                </div>

                                <div class="blog-excerpt">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>

                                    <div class="blog-meta">
                                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                    </div>
                                </div>

                            </article>
                        </div>


                        <div class="col-md-12 home-load-more">
                            <button class="btn center-block">load more stories </button>
                        </div>


                    </div>

                    <!-- end all blog post -->

                    <div class="row">
                        <div class="col-md-12">
                            <img src="<?= get_stylesheet_directory_uri(); ?>/images/rec728@2x.jpg"/>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <h4 class="section-title"><span>Featured Stories</span></h4>

                            <div class="featured-stories">

                                <div class="featured-widget">
                                    <div class="row">

                                        <div class="col-md-5 col-sm-5">
                                            <div class="featured-widget-thumbnail">
                                                <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7">
                                            <div class="featured-story-title">
                                                <h3>Lorem ipsum dolor sit amet</h3>
                                            </div>
                                            <div class="featured-story-category">
                                                <a href="">Golf</a>
                                                <a href="">Golf Coast News</a>
                                            </div>

                                            <div class="featured-story-excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis  <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                            </div>

                                            <div class="blog-meta">
                                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                                <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="featured-widget">
                                    <div class="row">

                                        <div class="col-md-5 col-sm-5">
                                            <div class="featured-widget-thumbnail">
                                                <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7">
                                            <div class="featured-story-title">
                                                <h3>Lorem ipsum dolor sit amet</h3>
                                            </div>

                                            <div class="featured-story-category">
                                                <a href="">Golf</a>
                                                <a href="">Golf Coast News</a>
                                            </div>

                                            <div class="featured-story-excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis  <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                            </div>

                                            <div class="blog-meta">
                                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                                <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="featured-widget">
                                    <div class="row">

                                        <div class="col-md-5 col-sm-5">
                                            <div class="featured-widget-thumbnail">
                                                <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7">
                                            <div class="featured-story-title">
                                                <h3>Lorem ipsum dolor sit amet</h3>
                                            </div>
                                            <div class="featured-story-category">
                                                <a href="">Golf</a>
                                                <a href="">Golf Coast News</a>
                                            </div>

                                            <div class="featured-story-excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis  <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                            </div>

                                            <div class="blog-meta">
                                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                                <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="featured-widget">
                                    <div class="row">

                                        <div class="col-md-5 col-sm-5">
                                            <div class="featured-widget-thumbnail">
                                                <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7">
                                            <div class="featured-story-title">
                                                <h3>Lorem ipsum dolor sit amet</h3>
                                            </div>

                                            <div class="featured-story-category">
                                                <a href="">Golf</a>
                                                <a href="">Golf Coast News</a>
                                            </div>

                                            <div class="featured-story-excerpt">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis  <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                            </div>

                                            <div class="blog-meta">
                                                <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                                                <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>

                        <div class="col-md-12 home-load-more">
                            <button class="btn center-block">load more featured stories </button>
                        </div>

                    </div>



<!-- featured stories start -->


<!-- featured stories end -->

                </div>


                <!--     sidebar      -->
                <div class="col-md-4 col-sm-3">

                    <div class="social-count">
                        <h4 class="widget-title"><span>Stay Connected</span></h4>
                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/stay.jpg"/>

                    </div>

                    <div class="home-ad-1">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/ad-300x250.jpg" alt=""/>
                    </div>

                    <div class="home-recent-stories">
                        <h4 class="widget-title"><span>Featured Stories</span></h4>

                        <div class="recent-story-widget">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="recent-story-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="recent-story-title">
                                        <a href=""><h3>Lorem ipsum dolor sit amet</h3></a>
                                    </div>

                                    <div class="recent-story-excerpt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="recent-story-widget">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="recent-story-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="recent-story-title">
                                        <h3>Lorem ipsum dolor sit amet</h3>
                                    </div>

                                    <div class="recent-story-excerpt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="recent-story-widget">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="recent-story-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="recent-story-title">
                                        <h3>Lorem ipsum dolor sit amet</h3>
                                    </div>

                                    <div class="recent-story-excerpt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="recent-story-widget">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="recent-story-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/tampaskyline.jpg"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="recent-story-title">
                                        <h3>Lorem ipsum dolor sit amet</h3>
                                    </div>

                                    <div class="recent-story-excerpt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="recent-story-widget">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="recent-story-thumbnail">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/naplesbeach.jpg"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="recent-story-title">
                                        <h3>Lorem ipsum dolor sit amet</h3>
                                    </div>

                                    <div class="recent-story-excerpt">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing <a href="" class="read-more">read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="home-ad-1">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/ad-puma.jpg" alt=""/>
                    </div>

                    <div class="home-recent-comments">
                        <h4 class="widget-title"><span>Recent Comments</span></h4>

                        <div class="recent-comment-widget">
                            <div class="row">

                                <div class="col-md-12">
                                    <p> <a href="">Matt Cloey</a> on <a href=""> reasons why in-form Leicester City will finish the job and stay up</a></p>
                                </div>

                            </div>
                        </div>

                        <div class="recent-comment-widget">
                            <div class="row">

                                <div class="col-md-12">
                                    <p> <a href="">Matt Cloey</a> on <a href=""> reasons why in-form Leicester City will finish the job and stay up</a></p>
                                </div>

                            </div>
                        </div>

                        <div class="recent-comment-widget">
                            <div class="row">

                                <div class="col-md-12">
                                    <p> <a href="">Matt Cloey</a> on <a href=""> reasons why in-form Leicester City will finish the job and stay up</a></p>
                                </div>

                            </div>
                        </div>

                        <div class="recent-comment-widget">
                            <div class="row">

                                <div class="col-md-12">
                                    <p> <a href="">Matt Cloey</a> on <a href=""> reasons why in-form Leicester City will finish the job and stay up</a></p>
                                </div>

                            </div>
                        </div>

                        <div class="recent-comment-widget">
                            <div class="row">

                                <div class="col-md-12">
                                    <p> <a href="">Matt Cloey</a> on <a href=""> reasons why in-form Leicester City will finish the job and stay up</a></p>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="home-ad-1">
                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/ad-2.jpg" alt=""/>
                    </div>


                </div>

            </div>
        </div>
</div>
<!-- end blog section home-->


<div class="home-video-section">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/06/night2.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/08/bob.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/07/alico11.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/06/timthumb.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/05/mapleleaf4.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="home-video-widget">
                    <img src="http://golfcoastmagazine.dev/wp-content/uploads/2016/05/upc2.jpg" alt=""/>

                    <div class="video-widget-meta">
                        <span><i class="fa fa-user" aria-hidden="true"></i> <a href="">Ryan Ruppert</a></span>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> 26th April</span>
                        <span class="comment-count"><i class="fa fa-comment-o" aria-hidden="true"></i> 10</span>
                        <a href=""><h3 class="video-title">Lorem ipsum dolor sit amet</h3></a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<!-- //custom development start  -->

					<?php if ( is_active_sidebar( 'front_page_sections' ) ) { ?>
						<div class="widgets_area">
							<?php dynamic_sidebar( 'front_page_sections' ); ?>
						</div>
					<?php } ?>

				</article><!-- #post-## -->

			<?php endwhile; // End of the loop. ?>

		</main>
		<!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();