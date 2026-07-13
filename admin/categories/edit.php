<?php
$title = "Edit Category";

include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

$id = $_GET['id'];
$result = getByID($conn, 'category', $id);

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $upload_path = "../assets/img/";

  // 1. Category Image Processing
  if (!empty($_FILES['file']['name'])) {
    $image = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $imageName = time() . "_cat_" . $image;
    move_uploaded_file($tmp_name, $upload_path . $imageName);
  } else {
    $imageName = $result['image']; // Keep old image
  }

  // Banner Image Processing
  if (!empty($_FILES['file1']['name'])) {
    $image1 = $_FILES['file1']['name'];
    $tmp_name1 = $_FILES['file1']['tmp_name'];
    $imageName1 = time() . "_banner_" . $image1;
    move_uploaded_file($tmp_name1, $upload_path . $imageName1);
  } else {
    $imageName1 = $result['banner_image']; 
  }

  // 3. Database Update
  $stmt = $conn->prepare("UPDATE category SET name=?, image=?, banner_image=? WHERE id=?");
  $stmt->bind_param("sssi", $name, $imageName, $imageName1, $id);

  if ($stmt->execute()) {
    header("Location: ../tables.php?msg=updated");
    exit;
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
?>

<body class="">
  <main class="main-content mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('https://img.freepik.com/free-vector/competent-resume-writing-professional-cv-constructor-online-job-application-profile-creation-african-american-woman-filling-up-digital-form-concept-illustration_335657-2053.jpg?semt=ais_hybrid&w=740&q=80'); background-size: cover;">
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Edit Category</h4>
                  <p class="mb-0">Update the details of this category</p>
                </div>
                <div class="card-body">

                  <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category ID</label>
                      <input type="text" value="<?php echo $result['id']; ?>" class="form-control" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category Name</label>
                      <input type="text" name="name" value="<?php echo $result['name']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label class="text-xs font-weight-bold">Current Image:</label>
                      <div class="p-2 border border-radius-md text-center">
                        <img src="../assets/img/<?php echo $result['image']; ?>" class="img-fluid border-radius-lg shadow-sm" style="max-height: 100px;">
                      </div>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Change Image (Optional)</label>
                      <input type="file" name="file" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                      <label class="text-xs font-weight-bold">Current Banner Image:</label>
                      <div class="p-2 border border-radius-md text-center">
                        <img src="../assets/img/<?php echo $result['banner_image']; ?>" class="img-fluid border-radius-lg shadow-sm" style="max-height: 100px;">
                      </div>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Change Banner Image (Optional)</label>
                      <input type="file" name="file1" class="form-control" accept="image/*">
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Update Category</button>
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