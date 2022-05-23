

//Date Time Picker 
    $(document).ready(function() {
        let date_input = $('input[name="dob"]');
        let container = $('.container-dob').length > 0 ? $('.container-dob').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    });
    
//Password Confirmation 

 //Get Error Div
 let div = document.getElementById('perror');

$("#rpass").on("keyup", function () { //If did not Match
  if ($("#npass").val() != $(this).val()) {
    $(this).removeClass("is-valid").addClass("is-invalid");
    $("#perror").removeClass("valid-tooltip").addClass("invalid-tooltip");
    div.innerHTML = 'Password did not matched! ';
       //Disable Submit Button
       $('#repass').prop('disabled', true);
  }//If Empty
  else if($("#npass").val()==""){
    $("#rpass").removeClass("is-valid").addClass("is-invalid");
    $("#perror").removeClass("valid-tooltip").addClass("invalid-tooltip");
    div.innerHTML = 'Password Cannot be Empty! ';
    //Disable Submit Button
    $('#repass').prop('disabled', true);
  }//Matched
  else {
    $(this).removeClass("is-invalid").addClass("is-valid");
    $("#perror").removeClass("invalid-tooltip").addClass("valid-tooltip");
    //Enable Submit Button
     $('#repass').prop('disabled', false);
     div.innerHTML = 'Password Matched! ';
  }
});

//View Password --Modal
$('.toggle-password').on('click', function() {
  $(this).toggleClass('fa-eye fa-eye-slash');
  let input = $($(this).attr('toggle'));
  if (input.attr('type') == 'password') {
    input.attr('type', 'text');
  }
  else {
    input.attr('type', 'password');
  }
});
//View password --anypage
$('.help-password').on('click', function() {
  $(this).toggleClass('fa-eye fa-eye-slash');
  let input = $($(this).attr('toggle'));
  if (input.attr('type') == 'password') {
    input.attr('type', 'text');
  }
  else {
    input.attr('type', 'password');
  }
});


//Alert Modal autoclose
$(function(){
  $('#alertModal').on('show.bs.modal', function(){
      var myModal = $(this);
      clearTimeout(myModal.data('hideInterval'));
      myModal.data('hideInterval', setTimeout(function(){
          myModal.modal('hide');
      }, 3000));
  });
});

//Countdown 
function makeTimer() {

  	
  let endTime = new Date("15 February 2021 9:00:00 GMT+06:00");
  endTime = (Date.parse(endTime) / 1000);

  let now = new Date();
  now = (Date.parse(now) / 1000);

  let timeLeft = endTime - now;

  let days = Math.floor(timeLeft / 86400);
  let hours = Math.floor((timeLeft - (days * 86400)) / 3600);
  let minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
  let seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

  if (hours < "10") {
    hours = "0" + hours;
  }
  if (minutes < "10") {
    minutes = "0" + minutes;
  }
  if (seconds < "10") {
    seconds = "0" + seconds;
  }

  $("#days").html(days + '<span class="tspan">Days</span>');
  $("#hours").html(hours + '<span class="tspan">Hours</span>');
  $("#minutes").html(minutes + '<span class="tspan">Minutes</span>');
  $("#seconds").html(seconds + '<span class="tspan">Seconds</span>');

}

setInterval(function() {
  makeTimer();
}, 1000);