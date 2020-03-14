/**
 * WP Serverless Forms
 * Global JS Functions
 */

// Target WP Provider class and add wp-sls-forms class
function wpServerlessFormsClass(form) {
  var $form = jQuery(form);
  $form.removeAttr("action method novalidate");
  $form.addClass("wp-sls-forms");

  jQuery(document).ready(function($) {
    var $form = jQuery(form);
    $form.removeAttr("novalidate");
    $form.attr("method", "POST");
    $form.attr("accept-charset", "UTF-8");
    $form.addClass("wp-sls-forms");

    $("<input>")
      .attr({
        type: "hidden",
        name: "send-from-url",
        value: window.location.href
      })
      .appendTo($form);

    $("<input>")
      .attr({
        type: "hidden",
        name: "sent-from-title",
        value: document.title
      })
      .appendTo($form);
  });
}

// Swap WP Provider Req fields to HTML5
function wpServerlessFormsRequied(form, field) {
  jQuery(document).ready(function($) {
    var $form = jQuery(form);
    var $field = jQuery(field);

    $form.find($field).each(function() {
      $(this).attr("required", true);
    });
  });
}

// Remove onClick functions
function wpServerlessRemoveOnClick(form, field) {
  jQuery(document).ready(function($) {
    var $form = jQuery(form);
    var $field = jQuery(field);

    $form.find($field).each(function() {
      $(this).attr("onclick", null);
      $(this).attr("onkeypress", null);
      console.log(this);
    });
  });
}

// Contact Form 7
wpServerlessFormsClass(".wpcf7-form");
wpServerlessFormsRequied(".wpcf7-form", ".wpcf7-validates-as-required");

// Gravity Forms
wpServerlessFormsClass(".gform_wrapper");
wpServerlessFormsRequied(".gform_wrapper", ".gfield_contains_required .ginput_container > *");

// Remove onClick
wpServerlessRemoveOnClick(".gform_wrapper", ".gform_button");
