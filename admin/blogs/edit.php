<?php
$title = "Edit Blog";


include_once "../../config/config.php";
include_once "../../config/functions.php";


if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = getByID($conn, 'blogs', $id);

  if (!$result) {
    header("Location: ../tables.php");
    exit;
  }
} else {
  header("Location: ../tables.php");
  exit;
}

// Update Logic
if (isset($_POST['update_blog'])) {
  $title       = $_POST['title'];
  $author      = $_POST['author'];
  $date        = $_POST['date'];
  $description = $_POST['description'];
  $category = $_POST['category'];

  // Image check
  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $imageName = time() . "_" . $image;
    move_uploaded_file($tmp_name, "../assets/img/" . $imageName);
  } else {
    $imageName = $result['image'];
  }

  $stmt = $conn->prepare("UPDATE blogs SET title=?, author=?, date=?, image=?, description=?, category=? WHERE id=?");
  $stmt->bind_param("ssssssi", $title, $author, $date, $imageName, $description, $category, $id);

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
                  <h4 class="font-weight-bolder">Edit Blog</h4>
                  <p class="mb-0">Update the details of this blog post</p>
                </div>
                <div class="card-body">

                  <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Blog Title</label>
                      <input type="text" name="title" value="<?php echo $result['title']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Author Name</label>
                      <input type="text" name="author" value="<?php echo $result['author']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Category</label>
                      <input type="text" name="category" value="<?php echo $result['category']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Publish Date</label>
                      <input type="date" name="date" value="<?php echo $result['date']; ?>" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Description</label>
                      <textarea name="description" class="form-control" rows="5" required><?php echo $result['description']; ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label class="text-xs font-weight-bold">Current Blog Image:</label>
                      <div class="p-2 border border-radius-md text-center">
                        <img src="../assets/img/<?php echo $result['image']; ?>" class="img-fluid border-radius-lg shadow-sm" style="max-height: 100px;">
                      </div>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Change Image</label>
                      <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="text-center">
                      <button type="submit" name="update_blog" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Update Blog</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <a href="../tables.php" class="text-primary text-gradient font-weight-bold">Go to Blogs Table</a>
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

