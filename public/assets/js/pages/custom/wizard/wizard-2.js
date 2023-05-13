"use strict";

// Class definition
var KTWizard2 = (function () {
  // Base elements
  var _wizardEl;
  var _formEl;
  var _wizard;
  var _validations = [];

  // Private functions
  var initWizard = function () {
    // Initialize form wizard
    _wizard = new KTWizard(_wizardEl, {
      startStep: 1, // initial active step number
      clickableSteps: false, // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
    });

    // Validation before going to next page
    _wizard.on("beforeNext", function (wizard) {
      // Don't go to the next step yet
      _wizard.stop();

      // Validate form
      var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
      validator.validate().then(function (status) {
        if (status == "Valid") {
          _wizard.goNext();
          KTUtil.scrollTop();
        } else {
          Swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light",
            },
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
      });
    });

    // Change event
    _wizard.on("change", function (wizard) {
      KTUtil.scrollTop();
    });
  };

  var initValidation = function () {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    // Step 1
    _validations.push(
      FormValidation.formValidation(_formEl, {
        fields: {
          President: {
            validators: {
              notEmpty: {
                message: "President is required!",
              },
            },
          },
          VicePresident: {
            validators: {
              notEmpty: {
                message: "Vice President is required",
              },
            },
          },
          Secretary: {
            validators: {
              notEmpty: {
                message: "Secretary is required",
              },
            },
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap: new FormValidation.plugins.Bootstrap(),
        },
      })
    );
  };

  var initSelectedCandidates = function () {
    var btn = $('button[data-wizard-type="action-next"]');

    btn.on("click", function () {
      var html = '';
      var candidatesArr = new Array();
      // var candidate = new Array();
      // var position = '';
      // var maxvote = '';
      $('.form-group').find('input:checked').each(function () { 
        var selected = $(this).attr('input-data');
        selected = selected.split('_');

        // maxvote = selected[0];
        
        candidatesArr.push(selected[1]);
        // if (jQuery.inArray(selected[1], candidatesArr) !== -1) candidatesArr.push(selected[1]);
        
        if(jQuery.inArray(selected[1], candidatesArr) != -1) {
          console.log("is in array");
      } else {
          console.log("is NOT in array");
      } 

        // console.log(candidatesArr);

        // if (candidatesArr.indexOf(selected[1]) === -1) {
        //   console.log('push');
        // }



        // if (maxvote == 1) {
        //   html += `<h6 class="font-weight-bolder mb-3">` + position + `</h6>
        //     <div class="text-dark-50 line-height-lg">
        //       <div>` + candidate + `</div>
        //     </div>
        //   <div class="separator separator-dashed my-5"></div>`;
        // } else {


        //   html += `
        //   <div class="text-dark-50 line-height-lg">
        //     <div>` + candidate + `</div>
        //   </div>`;
        // }
      });

      $("#selected-candidates").html(html);
    });
  };

  return {
    // public functions
    init: function () {
      _wizardEl = KTUtil.getById("kt_wizard_v2");
      _formEl = KTUtil.getById("election_form");

      initWizard();
      initValidation();
      initSelectedCandidates();
    },
  };
})();

jQuery(document).ready(function () {
  KTWizard2.init();
});
