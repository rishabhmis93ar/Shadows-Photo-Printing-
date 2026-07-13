<?php
$title = "Add Product";
// Connection aur logic wahi rahega jo aapne diya hai
include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

$error = "";

// Insert Logic
if (isset($_POST['add_product'])) {
  $category_id = $_POST['category_id'];
  $title       = $_POST['title'];
  $paper_type = $_POST['paper_types'];
  $regular_price       = $_POST['regular_price'];
  $sale_price       = $_POST['sale_price'];
  $dimensions  = $_POST['dimensions'];
  $description = $_POST['description'];

  // Image Upload logic
  $image_name = time() . '_' . $_FILES['image']['name'];
  $temp_name  = $_FILES['image']['tmp_name'];
  $target_path = "../assets/img/" . $image_name;

  if (move_uploaded_file($temp_name, $target_path)) {
    $stmt = $conn->prepare("INSERT INTO products (category_id, title, paper_types, regular_price, sale_price, image, description, dimensions) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issddsss", $category_id, $title, $paper_type, $regular_price, $sale_price, $image_name, $description, $dimensions);

    if ($stmt->execute()) {

      $updateCount = $conn->prepare("UPDATE category SET product_count = product_count + 1 WHERE id = ?");
      $updateCount->bind_param("i", $category_id);
      $updateCount->execute();
      $updateCount->close();

      header("Location: ../tables.php?msg=added");
      exit;
    } else {
      $error = "Database Error: " . $stmt->error;
    }
    $stmt->close();
  } else {
    $error = "Image upload failed. Check if 'admin/assets/img/' exists.";
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
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/product-image.jpg'); background-size: cover;">
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Add New Product</h4>
                  <p class="mb-0">Enter the details of the new canvas product</p>
                </div>
                <div class="card-body">

                  <?php if (!empty($error)): ?>
                    <div class="alert alert-danger text-white text-xs" role="alert">
                      <?php echo $error; ?>
                    </div>
                  <?php endif; ?>

                  <form role="form" action="" method="POST" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category</label>
                      <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                        $cat_result = getAll($conn, 'category');
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                          echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Product Title</label>
                      <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Paper Types (e.g. Luster, Glossy)</label>
                      <input type="text" name="paper_types" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Regular Price ($)</label>
                      <input type="number" step="0.01" name="regular_price" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Sale Price ($)</label>
                      <input type="number" step="0.01" name="sale_price" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Dimensions (e.g. 76cm x 50cm)</label>
                      <input type="text" name="dimensions" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Product Image</label>
                      <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Description</label>
                      <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="add_product" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Add Product</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <a href="../tables.php" class="text-primary text-gradient font-weight-bold">Go to Products Table</a>
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
  <?php include_once "../includes/hide-placeholder.php"; ?>
</body>

</html>