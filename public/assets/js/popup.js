function openPopup() {
  document.getElementById("popup").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("popup").classList.add("hidden");
  document.getElementById("popupEdit").classList.add("hidden");
}

// window.onclick = function (event) {
//   var popup = document.getElementById("popup");
//   var popup2 = document.getElementById("popupEdit");
//   if (event.target == popup) {
//     popup.classList.add("hidden");
//   } else if (event.target == popup2) {
//     popup2.classList.add("hidden");
//   }
// };

function showCategoryDetails(id) {
  document.getElementById("popupEdit").classList.remove("hidden");
  let nameValue = document.getElementById('categoryName' + id).textContent;

  let categoryNameInput = document.getElementById('categoryname2');
  let categoryIdInput = document.getElementById('categoryId');

  categoryNameInput.value = nameValue;
  categoryIdInput.value = id;
}

function showTagDetails(id) {
  document.getElementById("popupEdit").classList.remove("hidden");
  let nameValue = document.getElementById('tagName' + id).textContent;

  let tagNameInput = document.getElementById('tagname2');
  let tagIdInput = document.getElementById('tagId');

  tagNameInput.value = nameValue;
  tagIdInput.value = id;
}