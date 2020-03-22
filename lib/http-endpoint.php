<?php

// Register Settings
add_action( 'admin_init', 'register_sls_forms_ext_settings' );
function register_sls_forms_ext_settings() {
  register_setting( 'wp-sls-forms-settings-group', 'wp_sls_forms_endpoint' );
  register_setting( 'wp-sls-forms-settings-group', 'wp_sls_forms_redirect' );
}

// Create Options Page
function wp_sls_forms_options() {
  include('modules/endpoint-form.php');
}