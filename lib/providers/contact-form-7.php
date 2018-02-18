<?php

/**
* WP Serverless Forms
* Provider: Contact Form 7
*
*/

/**
* Swap CF7 Action URL with Custom Endpoint
*/

$endpoint = get_option('wp_sls_forms_endpoint');

if ( isset( $endpoint ) ) {
  add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
  function wpcf7_custom_form_action_url() {
    $endpoint = get_option('wp_sls_forms_endpoint');
    return $endpoint;
  }
}

/**
 * Disable CF7 AJAX
 */

add_filter( 'wpcf7_load_js', '__return_false' );
