<?php

/**
* WP Serverless Forms
* Provider: Contact Form 7
*
*/

/**
 * Disable CF7 AJAX
 */

add_filter( 'wpcf7_load_js', '__return_false' );
