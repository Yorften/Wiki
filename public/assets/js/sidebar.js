let navItems = document.querySelectorAll(".dashitem");

navItems.forEach((item) => {
  item.addEventListener("click", function () {
    navItems.forEach((navItem) => {
      navItem.classList.remove("checked");
    });

    item.classList.add("checked");
  });
});
