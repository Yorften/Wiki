function printError(Id, Msg) {
  document.getElementById(Id).innerHTML = Msg;
}

let content = document.getElementById("content");
let desc = document.getElementById("desc2").textContent;
let title = document.getElementById("title2").textContent;
let wikiContent = document.getElementById("wikiContent2").innerText;
let wikiId = document.getElementById("wikiId").value;
let category = document.getElementById("category");
let currentTags = document.querySelectorAll(".tags");

category = category.getAttribute("value");
let allTags = [];

currentTags.forEach((currentTags) => {
  allTags.push(currentTags.getAttribute("data-value"));
});

console.log(allTags);
console.log(category);

let oldContent = content.innerHTML;

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

content.addEventListener("click", (e) => {
  if (e.target.id === "editwiki") {
    let data = {
      title: title,
      desc: desc,
      content: wikiContent,
    };
    var formData = new FormData();

    formData.append("json_data", JSON.stringify(data));

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/wiki/public/edit/editWiki");
    xhr.send(formData);

    xhr.onreadystatechange = () => {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          let data = xhr.response;
          // console.log(data);
          content.innerHTML = data;
          document.getElementById("category").value = category;
          allTags.forEach((allTags) => {
            document.getElementById("tag" + allTags).selected = true;
          });
          initMultiSelectTag();
        }
      }
    };
  } else if (e.target.id === "cancel") {
    content.innerHTML = oldContent;
  } else if (e.target.id === "apply") {
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
      wikiId: wikiId,
      title: title,
      desc: desc,
      content: content,
      category: category,
      tags: tags,
    };
    console.log(data);
    var formData = new FormData();

    if (image.files && image.files[0]) {
      var file = image.files[0];

      formData.append("image", file);
      formData.append("json_data", JSON.stringify(data));
    } else {
      formData.append("json_data", JSON.stringify(data));
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/wiki/public/pages/updateWiki");
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
  }
});
