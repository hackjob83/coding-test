/**
********************************************************************************
Author: John Hackett
Description: Custom scripts for Synergy Marketing Partners code test
********************************************************************************
**/

$(function () {

  // activate bootstrap tooltips
  $('[data-toggle="tooltip"]').tooltip();

  // script to enable the agreement box once
  // the user has scrolled through the entire rules box
  $('div.rules-box').scroll(function () {
    if ($(this).scrollTop() >= ($(this)[0].scrollHeight - $(this).height() - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom')) - 10) ) {
        $('#agree').removeAttr('disabled');
    }
  });

  // toggle additional form elements for minors
  $('#agree_minor').on("change", function() {
    if ($('#agree_minor').is(':checked')) {
      $('#minor_form').show();
      $('#minor1').prop('required', 'true');
    } else {
      $('#minor1').removeAttr('required');
      $('#minor_form').hide();
    }
  });

  // tweak fpr horizontal radio buttons validation
  $('input[name=q4]').on('change', function() {
    checkOpinion();
  });

  // turns on parsley and does additional checks for weird elements
  $('#reg_form').parsley().on('field:validated', function() {
    checkSignature();
    checkOpinion();
  });
});


// init info for signature pad library
var wrapper = document.getElementById("signature-pad");
var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)',
  onEnd: function() {
    // store signature base64 data and make sure valid
    $('#signature').prop('value', signaturePad.toDataURL());
    checkSignature();
    // add the signed on date below sign box
    $('#signed_date').text("Signed on: " + getTodaysDate());
  }
});

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas;
resizeCanvas();

// function to validate the signature box contents
function checkSignature() {
  if (signaturePad.isEmpty()) {
    $('.signature-pad--body').addClass("parsley-error");
  } else {
    $('.signature-pad--body').removeClass("parsley-error");
  }
}

// function to validate the contents of the horizontal radio buttons
function checkOpinion() {
  if (!$('input[name="q4"]:checked').val()) {
    $('.radio-label-vertical-wrapper').addClass("parsley-error");
  } else {
    $('.radio-label-vertical-wrapper').removeClass("parsley-error");
  }
}

// helper function to retrieve formatted date
function getTodaysDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1;
  var yyyy = today.getFullYear();

  if(dd<10) {  dd='0'+dd; }
  if(mm<10) {  mm='0'+mm; }

  return mm + '/' + dd + '/' + yyyy;
}
