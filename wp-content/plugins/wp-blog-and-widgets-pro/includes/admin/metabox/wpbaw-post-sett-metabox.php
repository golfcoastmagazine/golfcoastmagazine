<?php
/**
 * Handles testimonial metabox HTML
 *
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPBAW_META_PREFIX; // Metabox prefix

// Getting saved values
$read_more_link = get_post_meta( $post->ID, $prefix.'more_link', true );
?>

<table class="form-table wpbaw-post-sett-table">
	<tbody>

		<tr valign="top">
			<th scope="row">
				<label for="wpbaw-more-link"><?php _e('Read More Link', 'wp-blog-and-widgets'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo wpbaw_pro_esc_attr($read_more_link); ?>" class="large-text wpbaw-more-link" id="wpbaw-more-link" name="<?php echo $prefix; ?>more_link" /><br/>
				<span class="description"><?php _e('If you have different URL then enter read more link for post or Leave empty for current post URL.', 'wp-blog-and-widgets'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .wtwp-tstmnl-table -->