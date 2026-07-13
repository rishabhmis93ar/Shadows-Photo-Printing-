<?php
$title = "Add New Coupon";
// Connection
include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

// Insert Logic
if (isset($_POST['add_coupon'])) {
    $code = $_POST['code'];
    $type = $_POST['type'];
    $value = $_POST['value'];
    $expiry_date = $_POST['expiry_date'];
    $status = $_POST['status'];

    // prepare statement
    $stmt = $conn->prepare("INSERT INTO coupons (code, type, value, expiry_date, status) VALUES(?, ?, ?, ?, ?)");
    // binding the parameters (s = string, d = decimal/double, i = integer)
    $stmt->bind_param("ssdss", $code, $type, $value, $expiry_date, $status);

    if ($stmt->execute()) {
        header("Location: ../tables.php"); // Aapka table wala page
        exit;
    } else {
        echo "Error : " . $stmt->error;
    }

    $stmt->close();
}
?>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('https://media.istockphoto.com/id/2149620720/vector/3d-couple-of-promotional-coupons-with-coupon-code-golden-coins-special-giveway-with-coupons.jpg?s=612x612&w=0&k=20&c=KqIW8Y_QlvWKXovpiwxNOygmai94bS-WZT4dlHB1Ro8='); background-size: cover;">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Add New Coupon</h4>
                                    <p class="mb-0">Enter details of the discount coupon</p>
                                </div>
                                <div class="card-body">

                                    <form role="form" action="" method="POST">

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Coupon Code (e.g. NEW20)</label>
                                            <input type="text" name="code" class="form-control" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Discount Type</label>
                                            <select name="type" class="form-control" required>
                                                <option value="fixed">Fixed Amount ($)</option>
                                                <option value="percent">Percentage (%)</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Value</label>
                                            <input type="number" step="0.01" name="value" class="form-control" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="date" name="expiry_date" class="form-control">
                                        </div>

                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="add_coupon" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Add Coupon</button>
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