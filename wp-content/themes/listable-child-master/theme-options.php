<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */


add_filter( 'rwmb_meta_boxes', 'gm_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function gm_register_meta_boxes( $meta_boxes )
{

    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'gm_';


    // options for posts
    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id'         => 'standard',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title'      => __( 'Video Options', 'your-prefix' ),

        // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
        'post_types' => array( 'video'),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context'    => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority'   => 'high',

        // Auto save: true, false (default). Optional.
        'autosave'   => true,

        // List of meta fields
        'fields'     => array(

            // TEXT
            array(
                // Field name - Will be used as label
                'name'  => __( 'Video Options', 'gm' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}embedded_code",
                // Field description (optional)
                'desc'  => __( 'Add embedded code of video', 'ml' ),
                'type'  => 'textarea',
                // Default value (optional)
                //'std'   => __( 'Default text value', 'sn' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false
            ),

        ),

    );

    return $meta_boxes;
}


