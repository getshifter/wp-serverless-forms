<?php

// Register Settings
add_action( 'admin_init', 'register_sls_forms_ext_settings' );
function register_sls_forms_ext_settings() {
    register_setting( 'sls-forms-settings-group', 'sls_forms_ext_endpoint' );
}

// Create Options Page
function sls_forms_ext_options() {
  include('modules/endpoint-form.php');
}
