<?php
include_once "../../config/config.php";
include_once "../includes/header.php";


if (isset($_POST['add'])) {

  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');

  $upload_dir = __DIR__ . "/../assets/img/";

  // Validate files
  if (empty($_FILES['file']['name']) || empty($_FILES['file1']['name'])) {
    die("Both images are required");
  }

  $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];

  if (
    !in_array($_FILES['file']['type'], $allowed_types) ||
    !in_array($_FILES['file1']['type'], $allowed_types)
  ) {
    die("Invalid image type");
  }

  // Category Image
  $image_name = time() . '_cat_' . $_FILES['file']['name'];
  if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $image_name)) {
    die("Category image upload failed");
  }

  // Banner Image
  $image_name1 = time() . '_banner_' . $_FILES['file1']['name'];
  if (!move_uploaded_file($_FILES['file1']['tmp_name'], $upload_dir . $image_name1)) {
    die("Banner image upload failed");
  }

  $stmt = $conn->prepare("INSERT INTO category (image, banner_image, name) VALUES(?, ?, ?)");
  $stmt->bind_param("sss", $image_name, $image_name1, $name);

  if ($stmt->execute()) {
    header("Location: ../tables.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>

<body class="">
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/category-image.jpg'); background-size: cover;">
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Add New Category</h4>
                  <p class="mb-0">Enter the name and image of the category</p>
                </div>
                <div class="card-body">

                  <form role="form" action="" method="POST" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Category Name</label>
                      <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category Image</label>
                      <input type="file" name="file" class="form-control" accept="image/*" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Banner Image</label>
                      <input type="file" name="file1" class="form-control" accept="image/*" required>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="add" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Add Category</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <a href="../tables.php" class="text-primary text-gradient font-weight-bold">Go to Categories Table</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <?php include_once "../includes/hide-placeholder.php"; ?>
</body>

</html>