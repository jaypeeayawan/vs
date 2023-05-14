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
        fields: {},
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap: new FormValidation.plugins.Bootstrap(),
        },
      })
    );

    $("#election_form :input").map(function (index, elm) {
      var input = $(this);
      var inputValidator = '';
      if (input.attr('max-vote') > 1) {
        inputValidator = {
          validators: {
            choice: {
              min: parseInt(input.attr('max-vote')),
              max: parseInt(input.attr('max-vote')),
              message: 'Please select '+parseInt($('input[name="BusinessManagers[]"]').attr('max-vote'))+' candidates to continue',
            }
          }
        };
      } else {
        inputValidator = {
          validators: {
            notEmpty: {
              message: 'This field is required'
            }
          }
        };
      }
      _validations[0].addField(elm.name, inputValidator);
    });
  };

  var initSelectedCandidates = function () {
    var btn = $('button[data-wizard-type="action-next"]');

    btn.on("click", function () {
      var html = '';
      var candidatesArr = new Array();
      var positionsArr = new Array();
      $('.form-group').find('input:checked').each(function () { 
        var selected = $(this).attr('input-data');
        selected = selected.split('_');

        if (!positionsArr.includes(selected[0])) {
          positionsArr.push(selected[0]);
        }

        candidatesArr.push({
          position: selected[0],
          candidate: selected[1]
        });

      });
      $.each(positionsArr, function (i, v) { 
        html += `<h6 class="font-weight-bolder mb-3">` + v + `</h6>`;
        $.each(candidatesArr, function (key, candidate) { 
          html += `<div class="text-dark-50 line-height-lg">
            <div>
              <ul>`
                if (v == candidate.position) {
                  html += `<li>` + candidate.candidate + `</li>`;
                }
              html += `</ul>
            </div>
          </div>`;
        }); 
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
