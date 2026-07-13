document.addEventListener("DOMContentLoaded", function () {
  const selectBoxes = document.querySelectorAll(".select-box");

  selectBoxes.forEach((selectBox) => {
    const optionsContainer = selectBox.nextElementSibling;
    const searchBox = optionsContainer.querySelector(".search-box");
    const optionsList = optionsContainer.querySelectorAll(".option");

    // Toggle options display
    selectBox.addEventListener("click", function () {
      optionsContainer.classList.toggle("active");
    });

    // Select option
    optionsList.forEach((option) => {
      option.addEventListener("click", function () {
        selectBox.querySelector(".selected-item").textContent =
          option.textContent;
        optionsContainer.classList.remove("active");
      });
    });

    // Filter options based on search input
    searchBox.addEventListener("keyup", function (e) {
      const searchText = e.target.value.toLowerCase();
      optionsList.forEach((option) => {
        const text = option.textContent.toLowerCase();
        if (text.includes(searchText)) {
          option.style.display = "block";
        } else {
          option.style.display = "none";
        }
      });
    });
  });
});

$(document).ready(function () {
  $(".calculat-shipping").click(function () {
    $(".calculate-shipping").slideToggle();
  });
});