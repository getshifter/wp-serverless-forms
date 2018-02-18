/**
 * WP Serverless Forms
 * Global JS Functions
 */


// Target WP Provider class and add wp-sls-forms class
export function wpServerlessFormsClass(form) {
 var $form = jQuery(form)
 $form.removeAttr('action method novalidate')
 $form.addClass('wp-sls-forms')


 jQuery(document).ready(
   function($) {

     var $form = jQuery(form)
     $form.removeAttr('action method novalidate')
     $form.addClass('wp-sls-forms')

   }
 );
}

// Swap WP Provider Req fields to HTML5
export function wpServerlessFormsRequied(form, field) {

 jQuery(document).ready(
   function($) {

     var $form = jQuery(form)
     var $field = jQuery(field)

     $form.find($field).each(function() {
       $(this).attr('required', true)
     })

   }
 );
}
