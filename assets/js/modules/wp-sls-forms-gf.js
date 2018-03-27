/**
 * WP Serverless Forms
 * JS Functions for Gravity Forms
 */

import {
  wpServerlessFormsClass,
  wpServerlessFormsRequied,
  wpServerlessFormsSanatize
} from './wp-sls-forms';

wpServerlessFormsClass('.gform_wrapper');
wpServerlessFormsRequied('.gform_wrapper', '[aria-required=true]');

wpServerlessFormsSanatize('.gform_wrapper', '.gform_button', 'onclick', 'test', 'test1', 'test2');