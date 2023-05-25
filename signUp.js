document.addEventListener('DOMContentLoaded', function() {
    var nameInput = document.getElementById('name');
    var emailInput = document.getElementById('email');
    var numberInput = document.getElementById('number');
    var addressInput = document.getElementById('address');
    var cityInput = document.getElementById('location');
  
    nameInput.addEventListener('input', function() {
      validateName();
    });
  
    emailInput.addEventListener('input', function() {
      validateEmail();
    });
  
    numberInput.addEventListener('input', function() {
      validateNumber();
    });
  
    addressInput.addEventListener('input', function() {
      validateAddress();
    });
  
    cityInput.addEventListener('input', function() {
      validateCity();
    });
  
    function validateName() {
      var name = nameInput.value.trim();
      var errorMessage = '';
  
      if (name.length < 3) {
        errorMessage = 'Name must be at least 3 characters long.';
      }
  
      nameInput.setCustomValidity(errorMessage);
    }
  
    function validateEmail() {
      var email = emailInput.value.trim();
      var errorMessage = '';
  
      if (!isValidEmail(email)) {
        errorMessage = 'Please enter a valid email address.';
      }
  
      emailInput.setCustomValidity(errorMessage);
    }
  
    function isValidEmail(email) {
      // Use a regular expression to validate email format
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailPattern.test(email);
    }
  
    function validateNumber() {
      var number = numberInput.value.trim();
      var errorMessage = '';
    
      if (number.length !== 10 || !isValidIndianMobileNumber(number)) {
        errorMessage = 'Please enter a valid 10-digit mobile number.';
      }
    
      numberInput.setCustomValidity(errorMessage);
    }
  
    function isValidIndianMobileNumber(number) {
      // Use a regular expression to validate Indian mobile number format
      var numberPattern = /^[6-9]\d{9}$/;
      return numberPattern.test(number);
    }
  
    function validateAddress() {
      var address = addressInput.value.trim();
      var errorMessage = '';
  
      if (address.length < 10) {
        errorMessage = 'Address must be at least 10 characters long.';
      }
  
      addressInput.setCustomValidity(errorMessage);
    }
  
    function validateCity() {
      var city = cityInput.value.trim();
      var errorMessage = '';
  
      if (city.length < 3) {
        errorMessage = 'Please enter a valid city name.';
      }
  
      cityInput.setCustomValidity(errorMessage);
    }
});
