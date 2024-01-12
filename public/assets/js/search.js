let container = document.getElementById("container");

let wikis = document.getElementById("content");
let categories = document.getElementById("categories");
let tags = document.getElementById("tags");
let searchBar = document.getElementById("search");

let oldContainer = container.innerHTML;
let oldwikis = wikis.innerHTML;
let oldcategories = categories.innerHTML;
let oldtags = tags.innerHTML;

searchBar.addEventListener("input", () => {
  let searchValue = searchBar.value;
  if (searchValue == "") {
    categories.classList.add("hidden");
    tags.classList.add("hidden");
    wikis.innerHTML = oldwikis;
    categories.innerHTML = oldcategories;
    tags.innerHTML = oldtags;
  } else {
    search("wikis", searchValue);
    search("categories", searchValue);
    search("tags", searchValue);
  }
});

function search(method, value) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/wiki/public/search/get" + method);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        let data = xhr.response;
        switch (method) {
          case "wikis":
            setWikis(data);
            break;
          case "categories":
            setCategories(data);
            break;
          case "tags":
            setTags(data);
            break;
          default:
            break;
        }
      }
    }
  };

  let data = {
    search: value,
  };

  data = JSON.stringify(data);
  xhr.send(data);
}

function setWikis(data) {
  wikis.innerHTML = data;
}

function setCategories(data) {
  categories.classList.remove("hidden");
  categories.innerHTML = data;
}

function setTags(data) {
  tags.classList.remove("hidden");
  tags.innerHTML = data;
}
