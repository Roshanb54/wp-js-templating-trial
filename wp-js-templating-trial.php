<?php
/**
 * Plugin Name: WP JS Templating Trail
 * Plugin URI:
 * Description: A demo plugin prepared for showing WP JS Templating.
 * Version: 1.0.0
 * Author: Racase Lawaju, Digamber Pradhan
 * Text Domain: wp-js-templating-trail
 * Domain Path: languages
 * License: GPL V3
 *
 * Note: This is just to show demo, do not use for production.
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License or license.txt for more details.
 *
 * @package WordPress
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prefix: wjtt
 */

/**
 * Register a custom menu page.
 */
function wjtt_register_menu() {
	add_menu_page(
		__( 'Social Icons', 'wp-js-templating-trail' ), //
		'Social Icons', //
		'manage_options', // Capabalities check.
		'social-icons', // Page slug.
		'wjtt_load_page_content', // Callback function.
		'dashicons-share-alt', // Dashicon name.
		6
	);
}
add_action( 'admin_menu', 'wjtt_register_menu' );

/**
 * Load page content.
 */
function wjtt_load_page_content() {
	include 'views/page-content.php';
}

/**
 * Add scripts.
 */
function wjtt_add_scripts() {
	wp_enqueue_style( 'wjtt-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	wp_register_script( 'wjtt-scripts', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', array( 'jquery', 'wp-util' ) );
	$localize_values = array();
	$social_icons = get_option( 'wjtt_values' );
	if ( isset( $social_icons['social'] ) && ! empty( $social_icons['social'] ) ) {
		$localize_values = $social_icons['social'];
	}

	// Reorder value again.
	$localize_values = array_values( $localize_values );

	wp_localize_script( 'wjtt-scripts', 'wjtt', $localize_values );
	wp_enqueue_script( 'wjtt-scripts' );
}
add_action( 'admin_enqueue_scripts', 'wjtt_add_scripts' );

/**
 * Add js template.
 */
function wjtt_js_template() {
?>
<script type="text/html" id="tmpl-social-links-add">
	<#
	var lastIndex = jQuery('#social-icons-listing-table tbody tr:last').data('index'),
					currentIndex = (typeof lastIndex === 'undefined') ? 0 : lastIndex + 1;
	#>
		<tr data-index="{{currentIndex}}">
			<td><input type="text" name="wjtt[social][{{currentIndex}}][title]" value="" /></td>
			<td><input type="text" name="wjtt[social][{{currentIndex}}][link]" value="" /></td>
			<td><input type="checkbox" name="wjtt[social][{{currentIndex}}][target]" value="1" /></td>
			<td><a href="javascript:void(0);" data-deleteindex="{{currentIndex}}" class="delete-row"><span class="dashicons dashicons-trash"></span></td>
		</tr>
</script>
<?php
}
add_action( 'admin_footer', 'wjtt_js_template' );

function wjtt_js_field_template() {
?>
<script type="text/html" id="tmpl-social-links-fields">
	<# _.each( data, function(  social, index ) {
		var isChecked = ('1'===social.target) ? 'checked' : '';
			#>
	<tr data-index="{{index}}">
		<td><input type="text" name="wjtt[social][{{index}}][title]" value="{{social.title}}" /></td>
		<td><input type="text" name="wjtt[social][{{index}}][link]" value="{{social.link}}" /></td>
		<td><input type="checkbox" name="wjtt[social][{{index}}][target]" value="1" {{isChecked}} /></td>
		<td><a href="javascript:void(0);" data-deleteindex="{{index}}" class="delete-row"><span class="dashicons dashicons-trash"></span></td>
	</tr>
	<# } ) #>
</script>
<?php
}
add_action( 'admin_footer', 'wjtt_js_field_template' );

/**
 * Callback to save function.
 */
function wjtt_save_data() {
	if ( ! isset( $_POST['wjtt_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wjtt_nonce'], '_wjtt_nonce_action' ) ) {

				wp_die( __( 'Sorry, your nonce did not verify.' ) );
				exit;

	} else {
		// var_dump( $_POST['wjtt']['social'] );exit;
			update_option( 'wjtt_values', $_POST['wjtt'] );
	}
}
add_action( 'load-toplevel_page_social-icons', 'wjtt_save_data' );
