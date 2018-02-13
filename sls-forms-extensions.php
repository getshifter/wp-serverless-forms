<?php
/*
Plugin Name: SLS Forms — Extensions
Plugin URI: https://github.com/getshifter/sls-forms-extensions
Description: Extensions for forms for Serverless Static WordPress sites
Version: 1.0.0
Author: Shifter Team
Author URI: https://getshifter.io
License: GPL2
*/

/**
 * Admin Settings Menu
 */

add_action( 'admin_menu', 'sls_forms_extensions' );

function sls_forms_extensions() {
	add_options_page(
		'SLS Forms — Extensions',
		'SLS Forms',
		'manage_options',
		'sls-forms-extensions',
		'sls_forms_ext_options',
    'https://placehold.it/100x100'
	);
}

/**
 * SLS Forms — Extensions
 * Feature: HTTP Endpoint
 */

require_once('lib/http-endpoint.php');

/**
 * Providers
 */

// Contact Form 7
require_once('lib/providers/contact-form-7.php');
