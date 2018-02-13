<?php

/**
* SLS Forms — Extensions
* Provider: Contact Form 7
*/

$endpoint = get_option('sls_forms_ext_endpoint');

if ( isset( $endpoint ) ) {
  add_filter('wpcf7_form_action_url', 'wpcf7_custom_form_action_url');
  function wpcf7_custom_form_action_url() {
    $endpoint = get_option('sls_forms_ext_endpoint');
    return $endpoint;
  }
}


function cf7_dequeue_script() {
  global $wp_scripts;
  wp_dequeue_script( 'contact-form-7' );
}

add_action( 'wp_print_footer_scripts', 'cf7_dequeue_script', 8 );
