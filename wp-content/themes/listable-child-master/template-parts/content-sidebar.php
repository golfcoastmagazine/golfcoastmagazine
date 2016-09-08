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

            <!-- Modal -->
            <div class="modal fade" id="modalVideo-<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="modalVideoLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title modal-video-title" id="modalVideoLabel"><?php the_title(); ?></h4>
                        </div>
                        <div class="modal-body">

                            <?php

                            echo get_post_meta(get_the_ID(),'gm_embedded_code', true);

                            ?>

                        </div>

                    </div>
                </div>
            </div>


            <h4 class="video-title"><?php the_title(); ?></h4>

            <!-- Button trigger modal -->
            <button type="button" class="video-cover" data-toggle="modal" data-target="#modalVideo-<?php the_ID();?>">

                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                <?php the_post_thumbnail('story'); ?>

            </button>

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
        'post_type' => 'video',
        'tag__not_in' => array( 117 ),
    );

    // the query
    $the_query = new WP_Query( $args ); ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <!-- pagination here -->

        <!-- the loop -->
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <!-- Modal -->
            <div class="modal fade" id="modalVideo-<?php the_ID();?>" tabindex="-1" role="dialog" aria-labelledby="modalVideoLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title modal-video-title" id="modalVideoLabel"><?php the_title(); ?></h4>
                        </div>
                        <div class="modal-body">

                            <?php

                            echo get_post_meta(get_the_ID(),'gm_embedded_code', true);

                            ?>

                        </div>

                    </div>
                </div>
            </div>

            <h4 class="video-title"><?php the_title(); ?></h4>

            <!-- Button trigger modal -->
            <button type="button" class="video-cover" data-toggle="modal" data-target="#modalVideo-<?php the_ID();?>">

                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                <?php the_post_thumbnail('story'); ?>

            </button>



        <?php endwhile; ?>
        <!-- end of the loop -->

        <!-- pagination here -->

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>


</div>