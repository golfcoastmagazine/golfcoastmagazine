<?php

class WP_Hummingbird_Caching_Page extends WP_Hummingbird_Admin_Page {

	public function render_header() {
		?>
		<?php if ( ! wphb_is_htaccess_written( 'caching' ) ): ?>
			<div class="wphb-notice wphb-notice-success hidden" id="wphb-notice-code-snippet-updated">
				<p><?php _e( 'Code snippet updated', 'wphb' ); ?></p>
			</div>
		<?php endif; ?>

		<div class="wphb-notice wphb-notice-error <?php echo ! isset( $_GET['htaccess-error'] ) ? 'hidden' : ''; ?>" id="wphb-notice-code-snippet-htaccess-error">
			<p><?php _e( 'Hummingbird could not update or write your .htaccess file. Please, make .htaccess writable or paste the code yourself.', 'wphb' ); ?></p>
		</div>

		<div class="wphb-notice wphb-notice-success hidden" id="wphb-notice-code-snippet-htaccess-updated">
			<p><?php _e( 'Apache <strong>.htaccess</strong> file updated. Please, wait while Hummingbird recheck expirations...', 'wphb' ); ?></p>
		</div>

		<?php if ( isset( $_GET['caching-updated'] ) && ! isset( $_GET['htaccess-error'] ) ): ?>
			<?php if ( wphb_is_htaccess_written( 'caching' ) ): ?>
				<div class="wphb-notice wphb-notice-success" id="wphb-notice-settings-updated">
					<p><?php _e( 'Your .htaccess file has been updated', 'wphb' ); ?></p>
				</div>
			<?php else: ?>
				<div class="wphb-notice wphb-notice-success" id="wphb-notice-settings-updated">
					<p><?php _e( 'Code snippet updated', 'wphb' ); ?></p>
				</div>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( isset( $_GET['cache-enabled'] ) ): ?>
			<div class="wphb-notice wphb-notice-success" id="wphb-notice-settings-updated">
				<p><?php _e( 'Browser cache enabled. Your .htaccess file has been updated', 'wphb' ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( isset( $_GET['cache-disabled'] ) ): ?>
			<div class="wphb-notice wphb-notice-success" id="wphb-notice-settings-updated">
				<p><?php _e( 'Browser cache disabled. Your .htaccess file has been updated', 'wphb' ); ?></p>
			</div>
		<?php endif; ?>

		<?php
		parent::render_header(); // TODO: Change the autogenerated stub
	}

	public function register_meta_boxes() {
		$redirect = false;

		if ( isset( $_GET['enable'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Enable caching in htaccess (only for apache servers)
			$result = wphb_save_htaccess( 'caching' );
			if ( $result ) {
				wphb_get_caching_status( true );
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-disabled', 'htaccess-error' ) );
				$redirect_to = add_query_arg( 'cache-enabled', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
			else {
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'cache-disabled' ) );
				$redirect_to = add_query_arg( 'htaccess-error', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
		}

		if ( isset( $_GET['disable'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Disable caching in htaccess (only for apache servers)
			$result = wphb_unsave_htaccess( 'caching' );
			if ( $result ) {
				wphb_get_caching_status( true );
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'htaccess-error' ) );
				$redirect_to = add_query_arg( 'cache-disabled', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
			else {
				$redirect_to = remove_query_arg( array( 'run', 'enable', 'disable', 'caching-updated', 'cache-enabled', 'cache-disabled' ) );
				$redirect_to = add_query_arg( 'htaccess-error', true, $redirect_to );
				wp_redirect( $redirect_to );
				exit;
			}
		}

		if ( isset( $_GET['run'] ) && current_user_can( wphb_get_admin_capability() ) ) {
			// Force a refresh of the data
			wphb_get_caching_status( true );
			$redirect = true;
		}

		if ( $redirect ) {
			wp_redirect( remove_query_arg( array( 'run', 'enable', 'disable', 'htaccess-error', 'cache-disabled', 'cache-enabled' ) ) );
			exit;
		}

		//$this->add_meta_box( 'caching-welcome', __( 'Setup', 'wphb' ), array( $this, 'caching_welcome_metabox' ), null, null, 'box-caching-welcome', array( 'box_class' => 'dev-box content-box-one-col-center' ) );
		//$this->add_meta_box( 'caching-configure', __( 'Configure', 'wphb' ), array( $this, 'caching_configure_metabox' ), null, null, 'main' );
		//$this->add_meta_box( 'caching-status', __( 'Caching status', 'wphb' ), array( $this, 'caching_status_metabox' ), null, null, 'box-caching-left' );
		//$this->add_meta_box( 'caching-how-to', __( 'How to enable', 'wphb' ), array( $this, 'caching_how_to_metabox' ), null, null, 'box-caching-left' );
		//$this->add_meta_box( 'caching-code-snippet', __( 'Code snippet', 'wphb' ), array( $this, 'caching_code_snippet_metabox' ), array( $this, 'caching_code_snippet_metabox_header'), null, 'box-caching-right' );

		$this->add_meta_box( 'caching-summary', __( 'Summary', 'wphb' ), array( $this, 'caching_summary_metabox' ), array( $this, 'caching_summary_metabox_header' ), null, 'box-caching-left', array( 'box_content_class' => 'box-content no-side-padding' ) );
		$this->add_meta_box( 'caching-enable', __( 'Enable Caching', 'wphb' ), array( $this, 'caching_enable_metabox' ), array( $this, 'caching_enable_metabox_header'), array( $this, 'caching_enable_metabox_footer'), 'box-caching-right', array( 'box_footer_class' => 'box-footer buttons buttons-on-left') );
	}


	protected function render_inner_content() {
		$server_name = wphb_get_server_type();
		$server_type = array_search( $server_name, wphb_get_servers() );
		$this->view( $this->slug . '-page', array( 'server_type' => $server_type, 'server_name' => $server_name ) );
	}


	public function caching_summary_metabox() {
		$options = wphb_get_settings();
		$expires = array(
			'css' => $options['caching_expiry_css'],
			'javascript' => $options['caching_expiry_javascript'],
			'media' => $options['caching_expiry_media'],
			'images' => $options['caching_expiry_images'],
		);

		$recommended = wphb_get_recommended_caching_values();

		$results = wphb_get_caching_status();
		if ( false === $results ) {
			// Force only when we don't have any data yet
			$results = wphb_get_caching_status( true );
		}
		$human_results = array_map( 'wphb_human_read_time_diff', $results );

		$external_problem = false;
		$htaccess_written = wphb_is_htaccess_written( 'caching' );
		if ( $htaccess_written && in_array( false, $results ) ) {
			$external_problem = true;
		}

		$args = compact( 'expires', 'results', 'recommended', 'external_problem', 'human_results' );
		$this->view( 'caching-summary-meta-box', $args );
	}


	public function caching_summary_metabox_header() {
		$recheck_url = add_query_arg( 'run', 'true' );
		$this->view( 'caching-summary-meta-box-header', array( 'recheck_url' => $recheck_url, 'title' => __( 'Summary', 'wphb' ) ) );
	}

	public function caching_enable_metabox() {
		$snippets = array(
			'apache' => wphb_get_code_snippet( 'caching', 'apache' ),
			'nginx' => wphb_get_code_snippet( 'caching', 'nginx' ),
			'iis' => wphb_get_code_snippet( 'caching', 'iis' ),
			'iis-7' => wphb_get_code_snippet( 'caching', 'iis-7' ),
		);

		$htaccess_written = wphb_is_htaccess_written( 'caching' );
		$htaccess_writable = wphb_is_htaccess_writable();
		$already_enabled = $this->is_caching_fully_enabled() && ! wphb_is_htaccess_written( 'caching' );

		$this->view( 'caching-enable-meta-box', array( 'snippets' => $snippets, 'htaccess_written' => $htaccess_written, 'htaccess_writable' => $htaccess_writable, 'already_enabled' => $already_enabled ) );
	}

	public function caching_enable_metabox_header() {
		$this->view( 'caching-enable-meta-box-header', array( 'gzip_server_type' => wphb_get_server_type(), 'title' => __( 'Enable Caching', 'wphb' ) ) );
	}

	public function caching_enable_metabox_footer() {
		$disable_enable_button = ! wphb_is_htaccess_written( 'caching' ) && $this->is_caching_fully_enabled();
		$enable_link = add_query_arg( array( 'run' => 'true', 'enable' => 'true' ) );
		$disable_link = add_query_arg( array( 'run' => 'true', 'disable' => 'true' ) );
		$this->view( 'caching-enable-meta-box-footer', array( 'server_type' => wphb_get_server_type(), 'enable_link' => $enable_link, 'disable_link' => $disable_link, 'disable_enable_button' => $disable_enable_button ) );
	}

	public function is_caching_fully_enabled() {
		$recommended = wphb_get_recommended_caching_values();

		$results = wphb_get_caching_status();
		if ( false === $results ) {
			// Force only when we don't have any data yet
			$results = wphb_get_caching_status( true );
		}

		$result_sum = 0;

		foreach ( $results as $key => $result ) {
			if ( $result >= $recommended[ $key ]['value'] ) {
				$result_sum++;
			}
		}

		return $result_sum === count( $results );

	}


}