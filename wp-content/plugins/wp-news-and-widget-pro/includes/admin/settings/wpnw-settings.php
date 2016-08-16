<?php
/**
 * Settings Page
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpnw-settings">
	
	<h2><?php _e( 'WP News and Five Widgets Settings', 'sp-news-and-widget' ); ?></h2><br />

	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p>'.__("Your changes saved successfully.", "sp-news-and-widget").'</p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="wpnw-settings-form" class="wpnw-settings-form">
		
		<?php
		    settings_fields( 'wpnw_pro_plugin_options' );
		    global $wpnw_pro_options;
		?>

		<!-- General Settings Starts -->
		<div id="wpnw-general-sett" class="post-box-container wpnw-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'General Settings', 'sp-news-and-widget' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wpnw-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpnw-pro-default-img"><?php _e('Default Featured Image', 'sp-news-and-widget'); ?>:</label>
										</th>
										<td>
											<input type="text" name="wpnw_pro_options[default_img]" value="<?php echo wpnw_pro_esc_attr( wpnw_pro_get_option('default_img') ); ?>" id="wpnw-pro-default-img" class="regular-text wpnw-pro-default-img wpnw-pro-img-upload-input" />
											<input type="button" name="wpnw_pro_default_img" class="button-secondary wpnw-pro-image-upload" value="<?php _e( 'Upload Image', 'sp-news-and-widget'); ?>" data-uploader-title="<?php _e('Choose Logo', 'sp-news-and-widget'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'sp-news-and-widget'); ?>" /> <input type="button" name="wpnw_pro_default_img_clear" id="wpnw-pro-default-img-clear" class="button button-secondary wpnw-pro-image-clear" value="<?php _e( 'Clear', 'sp-news-and-widget'); ?>" /> <br />
											<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of blank grey box.', 'sp-news-and-widget' ); ?></span>
											<?php
												$default_img = '';
												if( wpnw_pro_get_option('default_img') ) { 
													$default_img = '<img src="'.wpnw_pro_get_option('default_img').'" alt="" />';
												}
											?>
											<div class="wpnw-pro-img-view"><?php echo $default_img; ?></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpnw-settings-submit" name="wpnw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','sp-news-and-widget'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpnw-general-sett -->
		<!-- General Settings Ends -->

		<!-- Custom CSS Settings Starts -->
		<div id="wpnw-custom-css-sett" class="post-box-container wpnw-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="wpnw-custom-css" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'sp-news-and-widget' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wpnw-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpnw-custom-css"><?php _e('Custom Css', 'sp-news-and-widget'); ?>:</label>
										</th>
										<td>
											<textarea name="wpnw_pro_options[custom_css]" class="large-text wpnw-custom-css" id="wpnw-custom-css" rows="15"><?php echo wpnw_pro_esc_attr(wpnw_pro_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'sp-news-and-widget'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpnw-settings-submit" name="wpnw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','sp-news-and-widget');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #wpnw-custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpnw-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .wpnw-settings-form -->
	
</div><!-- end .wpnw-settings -->