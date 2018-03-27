/**
 * WP Serverless Forms
 * JS Functions for CF7
 */

import {
  wpServerlessFormsClass,
  wpServerlessFormsRequied
} from './wp-sls-forms';

wpServerlessFormsClass('.wpcf7-form');
wpServerlessFormsRequied('.wpcf7-form', '[aria-required=true]');
