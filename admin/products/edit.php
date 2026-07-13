<?php
$title = "Edit Product";
// 1. Connection aur Functions
include_once "../../config/config.php";
include_once "../../config/functions.php";

// 2. GET ID and Fetch Data
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = getByID($conn, 'products', $id);

  if (!$result) {
    header("Location: ../tables.php");
    exit;
  }
} else {
  header("Location: ../tables.php");
  exit;
}

// 3. Update Logic
if (isset($_POST['update_product'])) {
  $category_id = $_POST['category_id'];
  $title       = $_POST['title'];
  $regular_price       = $_POST['regular_price'];
  $sale_price       = $_POST['sale_price'];
  $dimensions  = $_POST['dimensions'];
  $description = $_POST['description'];

  // Image check
  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $imageName = time() . "_" . $image;
    move_uploaded_file($tmp_name, "../assets/img/" . $imageName);
  } else {
    $imageName = $result['image'];
  }

  $stmt = $conn->prepare("UPDATE products SET category_id=?, title=?, regular_price=?, sale_price=?, image=?, description=?, dimensions=? WHERE id=?");
  $stmt->bind_param("isddsssi", $category_id, $title, $regular_price, $sale_price, $imageName, $description, $dimensions, $id);

  if ($stmt->execute()) {
    header("Location: ../tables.php?msg=updated");
    exit;
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}

include_once "../includes/header.php";
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
                  <h4 class="font-weight-bolder">Edit Product</h4>
                  <p class="mb-0">Update the details of this canvas product</p>
                </div>
                <div class="card-body">

                  <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category</label>
                      <select name="category_id" class="form-control" required>
                        <?php
                        $cat_result = getAll($conn, 'category');
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                          $selected = ($cat['id'] == $result['category_id']) ? 'selected' : '';
                          echo "<option value='" . $cat['id'] . "' $selected>" . $cat['name'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Product Title</label>
                      <input type="text" name="title" value="<?php echo $result['title']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Regular Price ($)</label>
                      <input type="number" step="0.01" name="regular_price" value="<?php echo $result['regular_price']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Sale Price ($)</label>
                      <input type="number" step="0.01" name="sale_price" value="<?php echo $result['sale_price']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Dimensions</label>
                      <input type="text" name="dimensions" value="<?php echo $result['dimensions']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Description</label>
                      <textarea name="description" class="form-control" rows="3" required><?php echo $result['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label class="text-xs font-weight-bold">Current Image:</label>
                      <div class="p-2 border border-radius-md text-center">
                        <img src="../assets/img/<?php echo $result['image']; ?>" class="img-fluid border-radius-lg shadow-sm" style="max-height: 80px;">
                      </div>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Change Image (Optional)</label>
                      <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update_product" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Update Product</button>
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
  <script src="../admin/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <?php include_once "../includes/hide-placeholder.php"; ?>
</body>

</html>