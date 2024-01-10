function printError(Id, Msg) {
  document.getElementById(Id).innerHTML = Msg;
}

function validateForm() {
  let tagname = document.getElementById("tagname").value;

  let userErr = validateName(tagname);

  if (userErr) {
    console.log("true");
    return true;
  } else return false;
}

function validateFormEdit() {
  let tagname2 = document.getElementById("tagname2").value;

  let userErr = validateNameEdit(tagname2);

  if (userErr) {
    console.log("true");
    return true;
  } else return false;
}

function validateName(username) {
  if (username == "" || username == null) {
    document.getElementById("tagInput").classList.add("border-red-500");
    printError("tagnameErr", "Please enter a tag name");
    return false;
  } else {
    var regex = /^[a-zA-Z]+$/;
    if (!regex.test(username)) {
      document.getElementById("tagInput").classList.add("border-red-500");
      printError(
        "tagnameErr",
        "Please enter a valid name (no spaces/special characters)"
      );
      return false;
    } else {
      document
        .getElementById("tagInput")
        .classList.remove("border-red-500");
      printError("tagnameErr", "");
      return true;
    }
  }
}

function validateNameEdit(username) {
  if (username == "" || username == null) {
    document.getElementById("tagInput2").classList.add("border-red-500");
    printError("tagnameErr2", "Please enter a tag name");
    return false;
  } else {
    var regex = /^[a-zA-Z]+$/;
    if (!regex.test(username)) {
      document.getElementById("tagInput2").classList.add("border-red-500");
      printError(
        "tagnameErr2",
        "Please enter a valid name (no spaces/special characters)"
      );
      return false;
    } else {
      document
        .getElementById("tagInput2")
        .classList.remove("border-red-500");
      printError("tagnameErr2", "");
      return true;
    }
  }
}

function keydownValidation() {
  let tagname = document.getElementById("tagname");
  let tagname2 = document.getElementById("tagname2");

  tagname.addEventListener("input", function () {
    validateName(tagname.value);
  });
  tagname2.addEventListener("input", function () {
    validateNameEdit(tagname2.value);
  });
}

function initValidation() {
  let tagname = document.getElementById("tagname");
  let tagname2 = document.getElementById("tagname2");

  tagname.addEventListener("blur", function () {
    validateName(tagname.value);
  });
  tagname2.addEventListener("blur", function () {
    validateNameEdit(tagname2.value);
  });
}

initValidation();
keydownValidation();
