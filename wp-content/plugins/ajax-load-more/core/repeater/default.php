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