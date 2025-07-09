"use strict";

var KTSigninGeneral = (function () {
  var form, submitButton, validator;

  return {
    init: function () {
      form = document.querySelector("#kt_sign_in_form");
      submitButton = document.querySelector("#kt_sign_in_submit");

      validator = FormValidation.formValidation(form, {
        fields: {
          email: {
            validators: {
              regexp: {
                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                message: "The email address is invalid."
              },
              notEmpty: {
                message: "Email address is required."
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: "The password is required."
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap: new FormValidation.plugins.Bootstrap5({
            rowSelector: ".fv-row",
            eleInvalidClass: "",
            eleValidClass: ""
          })
        }
      });

      submitButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default form submission

        validator.validate().then(function (validationResult) {
          if (validationResult === "Valid") {
            // Successful validation, handle form submission
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;

            // Simulate form submission (replace with your actual submission logic)
            setTimeout(function () {
              submitButton.removeAttribute("data-kt-indicator");
              submitButton.disabled = false;

              Swal.fire({
                text: "You have successfully logged in!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                  confirmButton: "btn btn-primary"
                }
              }).then(function (result) {
                if (result.isConfirmed) {
                  form.querySelector('[name="email"]').value = "";
                  form.querySelector('[name="password"]').value = "";

                  var redirectUrl = form.getAttribute("data-kt-redirect-url");
                  if (redirectUrl) {
                    location.href = redirectUrl;
                  }
                }
              });
            }, 2000); // Adjust timeout as needed
          } else {
            // Validation errors, display error message
            Swal.fire({
              text: "Sorry, there are some errors detected, please try again.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: {
                confirmButton: "btn btn-primary"
              }
            });
          }
        });
      });
    }
  };
})();

KTUtil.onDOMContentLoaded(function () {
  KTSigninGeneral.init();
});