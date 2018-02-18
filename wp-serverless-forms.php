<?php
/*
Plugin Name: WP Serverless Forms
Plugin URI: https://github.com/getshifter/wp-serverless-forms
Description: Serverless Forms for Static WordPress sites
Version: 1.0.0
Author: Shifter
Author URI: https://getshifter.io
License: GPL2
*/


/**
 * Admin Settings Menu
 */

add_action( 'admin_menu', 'wp_sls_forms' );

function wp_sls_forms() {
	add_options_page(
		'WP Serverless Forms',
		'WP Serverless Forms',
		'manage_options',
		'wp-sls-forms',
		'wp_sls_forms_options'
	);
}


/*
 * JS Scripts
 *
 */

function wp_sls_forms_js() {
	$asset_dir = '/src/';
	$asset_src_path = dirname(__FILE__) . $asset_dir;
	if (realpath($asset_src_path)) {
		$shifter_js = plugins_url( 'src/js/app.js', __FILE__ );
	} else {
		$shifter_js = plugins_url( 'dist/js/app.min.js', __FILE__ );
	}

  wp_register_script("wp-sls-forms-js", $shifter_js, array( 'jquery' ));
  wp_enqueue_script("wp-sls-forms-js");
}

add_action('wp_enqueue_scripts', 'wp_sls_forms_js' );


/**
 * WP Serverless Forms
 * Feature: HTTP Endpoint
 */

require_once('lib/http-endpoint.php');


/**
 * Providers
 */

// Contact Form 7
require_once('lib/providers/contact-form-7.php');
