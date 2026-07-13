<?php
$title = "Add User";
// Connection
include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

// Update Logic
if (isset($_POST['update'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];

  // prepare statement
  $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES(?, ?, ?, ?)");
  // binding the parameters
  $stmt->bind_param("ssss", $username, $email, $password, $role);

  if ($stmt->execute()) {
    header("Location: ../tables.php");
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
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/user image.jpg'); background-size: cover;">
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Add New User</h4>
                  <p class="mb-0">Enter details of user</p>
                </div>
                <div class="card-body">

                  <form role="form" action="" method="POST">

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Username</label>
                      <input type="text" name="username" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="text" name="password" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">User Role</label>
                      <select name="role" class="form-control" required>
                        <option value="user">Normal User</option>
                        <option value="admin">Admin</option>
                      </select>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="update" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Add User</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <a href="../tables.php" class="text-primary text-gradient font-weight-bold">Go to Users Table</a>
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