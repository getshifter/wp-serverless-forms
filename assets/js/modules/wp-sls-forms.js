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
      $form.removeAttr('novalidate')
      $form.attr('method', 'POST')
      $form.attr('accept-charset', 'UTF-8')
      $form.addClass('wp-sls-forms')

      $('<input>').attr({
        type: 'hidden',
        'name': 'send-from-url',
        'value': window.location.href,
      }).appendTo($form)

      $('<input>').attr({
        type: 'hidden',
        'name': 'sent-from-title',
        'value': document.title,
      }).appendTo($form)

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

// Remove GF Validation
export function wpServerlessFormsSanatize(form, element) {

  jQuery(document).ready(
    function($) {

      var $form = jQuery(form)
      var $element = jQuery(element)

      $form.find($element).each(function() {
        $(this).attr('onclick', null);
        $(this).attr("onkeypress", null);
      });

    }
  );
}
