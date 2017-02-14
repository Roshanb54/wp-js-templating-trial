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
 * Class for WP JS Templating Trail.
 */
final class WP_Js_Templating_Trail {

	/**
	 * The single instance of the class.
	 *
	 * @var There's only one instance
	 */
	private static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WP_Js_Templating_Trail ) ) {
			self::$instance = new WP_Js_Templating_Trail;
		}
		return self::$instance;
	}

	function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {
		$this->define();
		$this->includes();
	}

	function includes() {
		include 'inc/class-assets.php';
		include 'inc/admin/class-admin-page.php';
	}

	function define() {
		define( 'WJTT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	}
}

/**
 * The main function that returns the one and only WP_Js_Templating_Trail instance.
 * Use this function to access classes and methods.
 *
 * @return object The one true WP_Js_Templating_Trail instance.
 */
function wp_js_templating_trail() {
	return WP_Js_Templating_Trail::instance();
}

// Start WP JS Templating Trail.
wp_js_templating_trail();
