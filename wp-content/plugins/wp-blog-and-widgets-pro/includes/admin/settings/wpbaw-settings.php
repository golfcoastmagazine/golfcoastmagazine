<?php
/**
 * Settings Page
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpbaw-settings">

<h2><?php _e( 'WP Blog and Widgets Pro Settings', 'wp-blog-and-widgets' ); ?></h2><br />

<?php

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p>'.__("Your changes saved successfully.", "wp-blog-and-widgets").'</p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="wpbaw-settings-form" class="wpbaw-settings-form">
	
	<?php
	    settings_fields( 'wpbaw_pro_plugin_options' );
	    global $wpbaw_pro_options;
	?>

	<!-- General Settings Starts -->
	<div id="wpbaw-general-sett" class="post-box-container wpbaw-general-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'wp-blog-and-widgets' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpbaw-general-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpbaw-pro-default-img"><?php _e('Default Featured Image', 'wp-blog-and-widgets'); ?>:</label>
									</th>
									<td>
										<input type="text" name="wpbaw_pro_options[default_img]" value="<?php echo wpbaw_pro_esc_attr( wpbaw_pro_get_option('default_img') ); ?>" id="wpbaw-pro-default-img" class="regular-text wpbaw-pro-default-img wpbaw-pro-img-upload-input" />
										<input type="button" name="wpbaw_pro_default_img" class="button-secondary wpbaw-pro-image-upload" value="<?php _e( 'Upload Image', 'wp-blog-and-widgets'); ?>" data-uploader-title="<?php _e('Choose Logo', 'wp-blog-and-widgets'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'wp-blog-and-widgets'); ?>" /> <input type="button" name="wpbaw_pro_default_img_clear" id="wpbaw-pro-default-img-clear" class="button button-secondary wpbaw-pro-image-clear" value="<?php _e( 'Clear', 'wp-blog-and-widgets'); ?>" /> <br />
										<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of grey blank box.', 'wp-blog-and-widgets' ); ?></span>
										<?php
											$default_img = '';
											if( wpbaw_pro_get_option('default_img') ) { 
												$default_img = '<img src="'.wpbaw_pro_get_option('default_img').'" alt="" />';
											}
										?>
										<div class="wpbaw-pro-img-view"><?php echo $default_img; ?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpbaw-settings-submit" name="wpbaw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-blog-and-widgets'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpbaw-general-sett -->
	<!-- General Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="wpbaw-custom-css-sett" class="post-box-container wpbaw-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'wp-blog-and-widgets' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpbaw-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpbaw-custom-css"><?php _e('Custom Css', 'wp-blog-and-widgets'); ?>:</label>
									</th>
									<td>
										<textarea name="wpbaw_pro_options[custom_css]" class="large-text wpbaw-custom-css" id="wpbaw-custom-css" rows="15"><?php echo wpbaw_pro_esc_attr(wpbaw_pro_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'wp-blog-and-widgets'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpbaw-settings-submit" name="wpbaw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-blog-and-widgets'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpbaw-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wpbaw-settings-form -->

</div><!-- end .wpbaw-settings -->