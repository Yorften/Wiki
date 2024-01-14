function printError(Id, Msg) {
  document.getElementById(Id).innerHTML = Msg;
}

function validateForm() {
  let title = document.getElementById("title").value;
  let desc = document.getElementById("desc").value;
  let wikiContent = document.getElementById("wikicontent").value;

  let titleErr = validateTitle(title);
  let descErr = validateDesc(desc);
  let wikiErr = validateContent(wikiContent);

  if (titleErr && descErr && wikiErr) {
    return true;
  } else return false;
}

function validateTitle(username) {
  if (username == "" || username == null) {
    printError("titleErr", "Please enter a input");
    return false;
  } else {
    var regex = /^\w+(?:\s\w+)*$/;
    if (!regex.test(username)) {
      printError(
        "titleErr",
        "Please enter a valid input (no spaces at the end/special characters)"
      );
      return false;
    } else {
      printError("titleErr", "");
      return true;
    }
  }
}

function validateDesc(username) {
  if (username == "" || username == null) {
    printError("descErr", "Please enter a input");
    return false;
  } else {
    var regex = /^[^<>]*[^<> \t\r\n\v\f][^<>]*$/;
    if (!regex.test(username)) {
      printError(
        "descErr",
        "Please enter a valid input (no spaces at the end/special characters)"
      );
      return false;
    } else {
      printError("descErr", "");
      return true;
    }
  }
}

function validateContent(username) {
  if (username == "" || username == null) {
    printError("contentErr", "Please enter a input");
    return false;
  } else {
    var regex = /^[^<>]*[^<> \t\r\n\v\f][^<>]*$/;
    if (!regex.test(username)) {
      printError(
        "contentErr",
        "Please enter a valid input (no spaces at the end/special characters)"
      );
      return false;
    } else {
      printError("contentErr", "");
      return true;
    }
  }
}

document.getElementById("create").addEventListener("click", (e) => {
  e.preventDefault();
  if (!validateForm()) {
    return false;
  }
  let title = document.getElementById("title").value;
  let desc = document.getElementById("desc").value;
  let content = document.getElementById("wikicontent").value;
  let category = document.getElementById("category").value;
  let inputTags = document.querySelectorAll(".item-label");
  let image = document.getElementById("image");
  content = content.replace(/\n/g, "&#10;");

  let tags = [];
  inputTags.forEach((inputTags) => {
    tags.push(inputTags.getAttribute("data-value"));
  });
  

  let data = {
    title: title,
    desc: desc,
    content: content,
    category: category,
    tags: tags,
  };
  var formData = new FormData();

  if (image.files && image.files[0]) {
    var file = image.files[0];

    formData.append("image", file);
    formData.append("json_data", JSON.stringify(data));
  } else {
    formData.append("json_data", JSON.stringify(data));
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/wiki/public/pages/addWiki");
  xhr.send(formData);

  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log(data);
        if (!isNaN(data) && Number.isInteger(Number(data))) {
          window.location.href =
            "http://localhost/wiki/public/pages/wiki/" + parseInt(data, 10);
        } else {
          document
            .getElementById("error")
            .parentElement.classList.remove("hidden");
          document.getElementById("error").innerHTML = data;
        }
      }
    }
  };
  console.log(data);
});
