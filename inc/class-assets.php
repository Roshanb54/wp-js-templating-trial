<?php

/**
 * WP JS Templating assets class.
 */
class WP_Js_Templating_Trail_Assets {

	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
	}

	/**
	 * Add scripts.
	 */
	function add_scripts() {
	  wp_register_script( 'wjtt-scripts', WJTT_PLUGIN_URL . 'assets/js/scripts.js', array( 'jquery', 'wp-util' ) );
			$localize_values = array();
			$social_icons = get_option('wjtt_values');
			if( isset( $social_icons['social'] ) && ! empty( $social_icons['social'] ) ) {
				$localize_values = $social_icons['social'];
			}
			wp_localize_script( 'wjtt-scripts', 'wjtt', $localize_values );
			wp_enqueue_script( 'wjtt-scripts' );
	}
}

new WP_Js_Templating_Trail_Assets();
