function onBootstrap() {
  // Check if endpoint is set
  if (wp.wp_sls_forms_endpoint.length === 0) {
    // Display debug message for logged in users
    if (wp.is_user_logged_in.length !== 0) {
      console.log("WP Serverless Forms is installed but no endpoint is set.");
    }
    return;
  }
}

function success(el) {
  el.target.submit.disabled = false;
  el.target.querySelector('input[type="submit"]').blur();
  el.target.reset();

  // Redirect if set
  if (wp.wp_sls_forms_redirect.length > 0) {
    window.location.replace(wp.wp_sls_forms_redirect);
  }
}

function error(el) {
  el.target.querySelector('input[type="submit"]').disabled = false;
  alert("Oops! There was an error.");
}

function submitForm(method, url, data, el) {
  var xhr = new XMLHttpRequest();
  xhr.open(method, url);
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== XMLHttpRequest.DONE) return;
    if (xhr.status === 200) {
      success(el);
    } else {
      error(el);
    }
  };

  xhr.send(data);
}

function modifyFormAttributes(form) {
  form.removeAttribute("action");
  form.removeAttribute("method");
  form.removeAttribute("enctype");
  form.removeAttribute("novalidate");
  form.setAttribute("data-wp-sls-forms", true);
}

onBootstrap();

document.addEventListener("DOMContentLoaded", function () {
  const allForms = document.querySelectorAll(
    "form[data-shifter='true'], .wpcf7 form, .wpcf7-form, .gform_wrapper form, .wpforms-container form"
  );

  allForms.forEach((form) => {
    modifyFormAttributes(form);

    // Inputs
    const inputs = form.querySelectorAll("input");

    // Add HTML required attribute
    inputs.forEach((input) => {
      if (input.getAttribute("aria-required") === "true") {
        input.required = true;
      }
    });

    form.addEventListener("submit", function (el) {
      el.preventDefault();
      var data = new FormData(form);
      submitForm("POST", wp.wp_sls_forms_endpoint, data, el);
    });
  });
});
