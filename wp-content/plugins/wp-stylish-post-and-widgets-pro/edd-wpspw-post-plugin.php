<?php
function wpspw_pro_license_menu() {
	add_plugins_page( 'Stylist Post Pro Plugin License', 'Stylist Post Pro Plugin License', 'manage_options', 'wpspwpostpro-license', 'wpspw_pro_license_page' );
}
add_action('admin_menu', 'wpspw_pro_license_menu');

function wpspw_pro_license_page() {
	$license 	= get_option( 'edd_wpspwpost_license_key' );
	$status 	= get_option( 'edd_wpspwpost_license_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Stylist Post Pro Plugin License Options'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('edd_wpspwpost_license'); ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key'); ?>
						</th>
						<td>
							<input id="edd_wpspwpost_license_key" name="edd_wpspwpost_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="edd_wpspwpost_license_key"><?php _e('Enter your license key'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e('active'); ?></span>
									<?php wp_nonce_field( 'edd_wpspwpost_nonce', 'edd_wpspwpost_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_deactivate_wpspwpost" value="<?php _e('Deactivate License'); ?>"/>
								<?php } else {
									wp_nonce_field( 'edd_wpspwpost_nonce', 'edd_wpspwpost_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_activate_wpspwpost" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

		</form>
	<?php
}

function edd_spost_register_option() {
	// creates our settings in the options table
	register_setting('edd_wpspwpost_license', 'edd_wpspwpost_license_key', 'edd_spost_sanitize_license' );
}
add_action('admin_init', 'edd_spost_register_option');

function edd_spost_sanitize_license( $new ) {
	$old = get_option( 'edd_wpspwpost_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'edd_wpspwpost_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}



/************************************
* this illustrates how to activate
* a license key
*************************************/

function edd_spost_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_activate_wpspwpost'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_wpspwpost_nonce', 'edd_wpspwpost_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_wpspwpost_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_SPOST_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_SPOST_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"

		update_option( 'edd_wpspwpost_license_status', $license_data->license );

	}
}
add_action('admin_init', 'edd_spost_activate_license');


/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function edd_spost_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_deactivate_wpspwpost'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_wpspwpost_nonce', 'edd_wpspwpost_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_wpspwpost_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_SPOST_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_SPOST_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'edd_wpspwpost_license_status' );

	}
}
add_action('admin_init', 'edd_spost_deactivate_license');


/************************************
* this illustrates how to check if
* a license key is still valid
* the updater does this for you,
* so this is only needed if you
* want to do something custom
*************************************/

function edd_spost_check_license() {

	global $wp_version;

	$license = trim( get_option( 'edd_wpspwpost_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( EDD_SPOST_ITEM_NAME ),
		'url'       => home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( EDD_SPOST_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}
