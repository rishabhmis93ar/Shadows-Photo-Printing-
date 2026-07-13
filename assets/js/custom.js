// header js
function openNav() {
  document.getElementById("mySidenavs").style.width = "290px";
}

function closeNav() {
  document.getElementById("mySidenavs").style.width = "0";
}

// Scroll Button
var btn = $("#button");

if (btn.length) {
  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });
}

//  select files (File Upload)
var selectfilesBtn = document.getElementById("selectfiles");
var fileInput = document.getElementById("fileInput");
var uploadfilesBtn = document.getElementById("uploadfiles");
var selectedFilesDiv = document.getElementById("selectedFiles");

if (selectfilesBtn) {
  selectfilesBtn.addEventListener("click", function () {
    if (fileInput) {
      fileInput.click();
    }
  });
}

if (fileInput) {
  fileInput.addEventListener("change", function () {
    var files = this.files;
    if (files.length > 0) {
      if (uploadfilesBtn) {
        uploadfilesBtn.style.display = "inline-block";
      }
      displaySelectedFiles(files);
    } else {
      if (uploadfilesBtn) {
        uploadfilesBtn.style.display = "none";
      }
      if (selectedFilesDiv) {
        selectedFilesDiv.innerHTML = "";
      }
    }
  });
}

function displaySelectedFiles(files) {
  if (!selectedFilesDiv) return; // ✅ Safety check

  for (var i = 0; i < files.length; i++) {
    selectedFilesDiv.innerHTML += "<p>" + files[i].name + "</p>";
  }
}
