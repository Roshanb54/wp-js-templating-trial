<?php

/**
 * WP JS Templating Trail Admin page class.
 */
class WP_Js_Templating_Trail_Admin_Page {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'admin_footer', array( $this, 'js_template' ) );
		add_action( 'admin_footer', array( $this, 'js_field_template' ) );
		add_action( 'load-toplevel_page_social-icons', array( $this, 'save_data' ) );
	}

	/**
	 * Register a custom menu page.
	 */
	function register_menu() {
	    add_menu_page(
	        __( 'Social Icons', 'wp-js-templating-trail' ),
	        'Social Icons',
	        'manage_options',
	        'social-icons',
	        array( $this, 'load_content' ),
	        'dashicons-share-alt',
	        6
	    );
	}

	function load_content() {
		include 'views/page-content.php';
	}

	function js_template() {
	?>
	<script type="text/html" id="tmpl-social-links-add">
		<# var lastIndex = jQuery('#social-icons-listing-table tbody tr:last').data('index'),
									currentIndex = (typeof lastIndex === 'undefined') ? 0 : lastIndex + 1;
									console.log( lastIndex ); #>
			<tr data-index="{{currentIndex}}">
				<td><input type="text" name="wjtt[social][{{currentIndex}}][title]" value="" /></td>
				<td><input type="text" name="wjtt[social][{{currentIndex}}][link]" value="" /></td>
				<td><input type="text" name="wjtt[social][{{currentIndex}}][target]" value="" /></td>
				<td><a href="javascript:void(0);" data-deleteindex="{{currentIndex}}" class="delete-row"><?php esc_html_e( 'Delete' ); ?></td>
			</tr>
</script>
	<?php
	}

	function js_field_template() {
	?>
	<script type="text/html" id="tmpl-social-links-fields">
		<# console.log( data ); #>
		<# _.each( data, function(  social, index ) {
			 #>
  <tr data-index="{{index}}">
			<td><input type="text" name="wjtt[social][{{index}}][title]" value="{{social.title}}" /></td>
			<td><input type="text" name="wjtt[social][{{index}}][link]" value="{{social.link}}" /></td>
			<td><input type="text" name="wjtt[social][{{index}}][target]" value="{{social.target}}" /></td>
			<td><a href="javascript:void(0);" data-deleteindex="{{index}}" class="delete-row"><?php esc_html_e( 'Delete' ); ?></td>
		</tr>
		<# } ) #>
</script>
	<?php
	}

	function save_data() {
		if ( ! isset( $_POST['wjtt_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['wjtt_nonce'], '_wjtt_nonce_action' ) ) {

		   wp_die( __( 'Sorry, your nonce did not verify.' ) );
		   exit;

		} else {

		  update_option( 'wjtt_values', $_POST['wjtt'] );
		}
	}

}

new WP_Js_Templating_Trail_Admin_Page();
