<?php
/*
Plugin Name: WP Serverless Forms
Plugin URI: https://github.com/getshifter/wp-serverless-forms
Description: Customizable form endpoints for WordPress sites.
Version: 1.3.1
Author: Shifter
Author URI: https://getshifter.io
License: GPLv3
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
	$shifter_js = plugins_url( 'assets/js/main.js', __FILE__ );

	// Main.js
	wp_register_script("wp-sls-forms-js", $shifter_js);
	$args = array(
		'is_user_logged_in' => is_user_logged_in(),
		'admin_email' => get_option('admin_email'),
		'blogname' => get_option('blogname'),
		'wp_sls_forms_endpoint' => get_option('wp_sls_forms_endpoint'),
		'wp_sls_forms_redirect' => get_option('wp_sls_forms_redirect')
	);
	wp_localize_script( 'wp-sls-forms-js', 'wp', $args );
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

// Gravity Forms
require_once('lib/providers/gravity-forms.php');
