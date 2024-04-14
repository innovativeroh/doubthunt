document.addEventListener("DOMContentLoaded", function () {
  var numberInput = document.getElementById("onlyNum") && document.getElementById("onlyOTP");
  numberInput.addEventListener("input", function (event) {
    var currentValue = event.target.value;
    var newValue = "";
    for (var i = 0; i < currentValue.length; i++) {
      if (!isNaN(parseInt(currentValue[i]))) {
        newValue += currentValue[i];
      }
    }
  event.target.value = newValue;
  });
});