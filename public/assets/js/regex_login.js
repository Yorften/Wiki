function printError(Id, Msg) {
  document.getElementById(Id).innerHTML = Msg;
}

function validateLogin() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  var emailErr = validateEmail(email);
  var passwordErr = validatePassword(password);

  if (emailErr && passwordErr) {
    console.log("true");
    return true;
  } else return false;
}

function validateEmail(email) {
  if (email == "" || email == null) {
    document.getElementById("emailInput").classList.add("border-red-500");
    printError("emailErr", "Please enter your email.");
    return false;
  } else {
    var regex = /^[a-zA-Z0-9]+@[a-z]+\.[a-zA-Z]{2,3}$/;
    if (!regex.test(email)) {
      document.getElementById("emailInput").classList.add("border-red-500");
      printError("emailErr", "Please enter a valid email (example@gmail.com)");
      return false;
    } else {
      document.getElementById("emailInput").classList.remove("border-red-500");
      printError("emailErr", "");
      return true;
    }
  }
}

function validatePassword(password) {
  if (password == "" || password == null) {
    document.getElementById("passwordInput").classList.add("border-red-500");
    printError("passwordErr", "Please enter your password");
    return false;
  } else {
    var regex = /^.{8,}$/;
    if (!regex.test(password)) {
      document.getElementById("passwordInput").classList.add("border-red-500");
      printError("passwordErr", "Password must contain atleast 8 characters");
      return false;
    } else {
      document
        .getElementById("passwordInput")
        .classList.remove("border-red-500");
      printError("passwordErr", "");
      return true;
    }
  }
}

function keydownValidation() {
  var email = document.getElementById("email");
  var password = document.getElementById("password");

  email.addEventListener("input", function () {
    validateEmail(email.value);
  });
  password.addEventListener("input", function () {
    validatePassword(password.value);
  });
}

function initValidation() {
  var email = document.getElementById("email");
  var password = document.getElementById("password");

  email.addEventListener("blur", function () {
    validateEmail(email.value);
  });
  password.addEventListener("blur", function () {
    validatePassword(password.value);
  });
}
keydownValidation();
initValidation();
