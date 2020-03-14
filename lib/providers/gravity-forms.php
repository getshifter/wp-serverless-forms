<?php

/**
* WP Serverless Forms
* Provider: Gravity Forms
*
*/

/**
* Swap GF Action URL with Custom Endpoint
*/

$endpoint = get_option('wp_sls_forms_endpoint');

if ( isset( $endpoint ) ) {
  add_filter( 'gform_form_tag', 'form_tag', 10, 2 );
  function form_tag( $form_tag, $form ) {
    $endpoint = get_option('wp_sls_forms_endpoint');
    $form_tag = preg_replace( "|action='(.*?)'|", "action='" . $endpoint . "'", $form_tag );
    return $form_tag;
  }
}



/**
 * Disable AJAX
 */

add_filter('gform_form_args', 'wp_sls_forms_disable_gf_ajax', 10, 1);

function wp_sls_forms_disable_gf_ajax($args) {
  $args['ajax'] = false;
  return $args;
}