<?php

/**
* WP Serverless Forms
* Provider: Gravity Forms
*
*/

/**
 * Disable AJAX
 */

add_filter('gform_form_args', 'wp_sls_forms_disable_gf_ajax', 10, 1);

function wp_sls_forms_disable_gf_ajax($args) {
  $args['ajax'] = false;
  return $args;
}