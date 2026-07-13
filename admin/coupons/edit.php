<?php
$title = "Edit Coupon";

include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

// Get ID from URL
$id = $_GET['id'];
$result = getByID($conn, 'coupons', $id);

// Update Logic
if (isset($_POST['update_coupon'])) {
  $code = $_POST['code'];
  $type = $_POST['type'];
  $value = $_POST['value'];
  $expiry_date = $_POST['expiry_date'];
  $status = $_POST['status'];

  // Database Update
  $stmt = $conn->prepare("UPDATE coupons SET code=?, type=?, value=?, expiry_date=?, status=? WHERE id=?");
  $stmt->bind_param("ssdssi", $code, $type, $value, $expiry_date, $status, $id);

  if ($stmt->execute()) {
    header("Location: ../tables.php?msg=updated"); // Redirecting to your coupons table
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
                  <h4 class="font-weight-bolder">Edit Coupon</h4>
                  <p class="mb-0">Update the details of this discount coupon</p>
                </div>
                <div class="card-body">

                  <form role="form" method="POST">

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Coupon ID</label>
                      <input type="text" value="<?php echo $result['id']; ?>" class="form-control" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Coupon Code</label>
                      <input type="text" name="code" value="<?php echo $result['code']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Discount Type</label>
                      <select name="type" class="form-control" required>
                        <option value="fixed" <?php echo ($result['type'] == 'fixed') ? 'selected' : ''; ?>>Fixed Amount ($)</option>
                        <option value="percent" <?php echo ($result['type'] == 'percent') ? 'selected' : ''; ?>>Percentage (%)</option>
                      </select>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Value</label>
                      <input type="number" step="0.01" name="value" value="<?php echo $result['value']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Expiry Date</label>
                      <input type="date" name="expiry_date" value="<?php echo $result['expiry_date']; ?>" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Status</label>
                      <select name="status" class="form-control" required>
                        <option value="1" <?php echo ($result['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo ($result['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                      </select>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update_coupon" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Update Coupon</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <a href="../tables.php" class="text-primary text-gradient font-weight-bold">Go to Coupons Table</a>
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