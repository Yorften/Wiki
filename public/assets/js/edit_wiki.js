let content = document.getElementById("content");
let desc = document.getElementById("desc2").textContent;
let title = document.getElementById("title2").textContent;
let wikiContent = document.getElementById("wikiContent2").innerText;
let wikiId = document.getElementById("wikiId").value;

let oldContent = content.innerHTML;

content.addEventListener("click", (e) => {
  if (e.target.id === "editwiki") {
    content.innerHTML = `<div class="w-full flex items-end justify-between border-b-2 p-2">
  <input type="text" id="title" class="w-full text-lg font-medium" value="${title}">
  <button id="apply" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
      </svg>
      Apply
  </button>
  <button id="cancel" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
      Back
  </button>
</div>
<div class="flex flex-col-reverse items-center lg:flex-row lg:items-start justify-center gap-4 w-full h-full pt-2">
<div class="p-2 text-center bg-red-500 rounded-lg text-white absolute top-28 md:top-16 hidden">
    <p id="error"></p>
</div>
  <div class="dark:bg-white-800 dark:text-gray-100 w-full h-full">
      <div class="container max-w-6xl p-4 mx-auto space-y-6 sm:space-y-12 w-full h-full shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
          <textarea name="content" id="wikicontent" cols="30" rows="50" placeholder="Article content" class="w-full p-1 mx-auto text-black font-medium">${wikiContent}</textarea>
      </div>
  </div>
  <div class="w-full md:w-[35%] md:mx-auto h-full border-t-2">
      <div class="flex flex-col gap-2 w-full h-full shadow-lg p-4">
          <p class="text-lg font-medium">Wiki image</p>
          <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="image" type="file" name="wikiImage" autocomplete="off">
          </div>
          <p class="text-lg font-medium">Description</p>
          <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
              <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="desc" type="text" name="desc" autocomplete="off" value="${desc}">
          </div>
      </div>
  </div>
</div>`;
  } else if (e.target.id === "cancel") {
    content.innerHTML = oldContent;
  } else if (e.target.id === "apply") {
    let title = document.getElementById("title").value;
    let desc = document.getElementById("desc").value;
    let content = document.getElementById("wikicontent").value;
    let image = document.getElementById("image");
    content = content.replace(/\n/g, "&#10;");

    let data = {
      wikiId: wikiId,
      title: title,
      desc: desc,
      content: content,
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
          if (!isNaN(data) && Number.isInteger(Number(data))) {
            window.location.href =
              "http://localhost/wiki/public/pages/wiki/" + parseInt(data, 10);
          } else {
            document.getElementById("error").parentElement.classList.remove('hidden');
            document.getElementById("error").innerHTML = data;
          }
        }
      }
    };
  }
});
