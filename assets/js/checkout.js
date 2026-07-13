// SHIPPING TOGGLE
$(function () {
  $("#chkPassport").click(function () {
    if ($(this).is(":checked")) {
      $("#dvPassport").show();
    } else {
      $("#dvPassport").hide();
    }
  });

  // Initial state
  $("#dvPassport").hide();
});

// CUSTOM SELECT BOX - SIMPLE & WORKING
document.addEventListener("DOMContentLoaded", function () {
  const customSelects = document.querySelectorAll(".custom-select");

  customSelects.forEach(function (select) {
    const selectBox = select.querySelector(".select-box");
    const optionsContainer = select.querySelector(".options");
    const selectedItem = select.querySelector(".selected-item");
    const hiddenInput = select.querySelector("input[type='hidden']");
    const searchBox = select.querySelector("input[type='text']"); // ✅ Koi bhi text input pakdo
    const optionsList = select.querySelectorAll(".option");

    // Safety check
    if (!selectBox || !optionsContainer || !selectedItem) return;

    // TOGGLE DROPDOWN
    selectBox.addEventListener("click", function (e) {
      e.stopPropagation();

      // Close all other dropdowns
      document
        .querySelectorAll(".custom-select .options.active")
        .forEach(function (ul) {
          if (ul !== optionsContainer) ul.classList.remove("active");
        });

      // Toggle current
      optionsContainer.classList.toggle("active");

      // Focus search if exists
      if (searchBox && optionsContainer.classList.contains("active")) {
        setTimeout(function () {
          searchBox.focus();
        }, 100);
      }
    });

    // SELECT OPTION
    optionsList.forEach(function (option) {
      option.addEventListener("click", function (e) {
        e.stopPropagation();

        const value =
          this.getAttribute("data-value") || this.textContent.trim();
        const text = this.textContent.trim();

        // Update display
        selectedItem.textContent = text;

        // Update hidden input
        if (hiddenInput) {
          hiddenInput.value = value;
        }

        // Close dropdown
        optionsContainer.classList.remove("active");

        // Reset search
        if (searchBox) {
          searchBox.value = "";
          optionsList.forEach(function (opt) {
            opt.style.display = "";
          });
        }
      });
    });

    // SEARCH FUNCTIONALITY

    if (searchBox) {
      searchBox.addEventListener("keyup", function (e) {
        e.stopPropagation();
        const searchText = this.value.toLowerCase();

        optionsList.forEach(function (option) {
          const text = option.textContent.toLowerCase();
          option.style.display = text.includes(searchText) ? "" : "none";
        });
      });

      searchBox.addEventListener("click", function (e) {
        e.stopPropagation();
      });
    }
  });

  // CLOSE DROPDOWN ON OUTSIDE CLICK
  document.addEventListener("click", function () {
    document
      .querySelectorAll(".custom-select .options.active")
      .forEach(function (ul) {
        ul.classList.remove("active");
      });
  });
});
