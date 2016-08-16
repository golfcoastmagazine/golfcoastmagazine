<?php
function edd_news_license_menu() {
	add_plugins_page( 'News Plugin License', 'News Plugin License', 'manage_options', 'newspro-license', 'edd_news_license_page' );
}
add_action('admin_menu', 'edd_news_license_menu');

function edd_news_license_page() {
	$license 	= get_option( 'edd_news_license_key' );
	$status 	= get_option( 'edd_news_license_status' );
	?>
	<div class="wrap">
		<h2><?php _e('News Plugin License Options'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('edd_news_license'); ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key'); ?>
						</th>
						<td>
							<input id="edd_news_license_key" name="edd_news_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="edd_news_license_key"><?php _e('Enter your license key'); ?></label>
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
									<?php wp_nonce_field( 'edd_news_nonce', 'edd_news_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_deactivate_news" value="<?php _e('Deactivate License'); ?>"/>
								<?php } else {
									wp_nonce_field( 'edd_news_nonce', 'edd_news_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_license_activate_news" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

			<div class="wpo-activate-step">
				<h2>Steps to Activate the License</h2>
				<h4>Note: If you do not activate the license then you will not get update of this plugin any more.</h4>
				<h4>You will receive license key within your product purchase email. If you do not have license key then you can get it form your <a href="http://wponlinesupport.com/my-account/" target="_blank">Account Page</a>.</h4>
				<p><b>Step 1:</b> Enter your license key into 'License Key' field and press 'Save Changes' button.</p>
				<p><b>Step 2:</b> After save changes you can see an another button named 'Activate License'.</p>
				<p><b>Step 3:</b> Press 'Activate License'. If your key is valid then you can see green 'Active' text.</p>
				<p><b>Step 4:</b> That's it. Now you can get auto update of this plugin.</p>
			</div>

		</form>
	<?php
}

function edd_news_register_option() {
	// creates our settings in the options table
	register_setting('edd_news_license', 'edd_news_license_key', 'edd_news_sanitize_license' );
}
add_action('admin_init', 'edd_news_register_option');

function edd_news_sanitize_license( $new ) {
	$old = get_option( 'edd_news_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'edd_news_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}



/************************************
* this illustrates how to activate
* a license key
*************************************/

function edd_news_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_activate_news'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_news_nonce', 'edd_news_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_news_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_NEWS_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_NEWS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"

		update_option( 'edd_news_license_status', $license_data->license );

	}
}
add_action('admin_init', 'edd_news_activate_license');


/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function edd_news_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_deactivate_news'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_news_nonce', 'edd_news_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'edd_news_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_NEWS_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_NEWS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'edd_news_license_status' );

	}
}
add_action('admin_init', 'edd_news_deactivate_license');


/************************************
* this illustrates how to check if
* a license key is still valid
* the updater does this for you,
* so this is only needed if you
* want to do something custom
*************************************/

function edd_news_check_license() {

	global $wp_version;

	$license = trim( get_option( 'edd_news_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( EDD_NEWS_ITEM_NAME ),
		'url'       => home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( EDD_NEWS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

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