//Allowing Number Into Inputs
document.addEventListener("DOMContentLoaded", function () {
  var numberInput = document.getElementById("onlyNum") && document.getElementById("onlyOTP");

  numberInput.addEventListener("input", function (event) {
    var currentValue = event.target.value;
    var newValue = "";

    // Remove any non-numeric characters from the input value
    for (var i = 0; i < currentValue.length; i++) {
      if (!isNaN(parseInt(currentValue[i]))) {
        newValue += currentValue[i];
      }
    }

    // Update the input value with the sanitized version
    event.target.value = newValue;
  });
});
//Allowing Only Numbers