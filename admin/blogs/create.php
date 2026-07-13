<?php
$title = "Add Blog";

include_once "../../config/config.php";
include_once "../../config/functions.php";
include_once "../includes/header.php";

$error = "";

// Insert Logic
if (isset($_POST['add_blog'])) {
    $title       = $_POST['title'];
    $author       = $_POST['author'];
    $date  = $_POST['date'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Image Upload logic
    $image_name = time() . '_' . $_FILES['image']['name'];
    $temp_name  = $_FILES['image']['tmp_name'];
    $target_path = "../assets/img/" . $image_name;

    if (move_uploaded_file($temp_name, $target_path)) {
        $stmt = $conn->prepare("INSERT INTO blogs (title, author, image, description, date, category) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $title, $author, $image_name, $description, $date, $category);

        if ($stmt->execute()) {
            header("Location: ../tables.php");
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
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('https://img.freepik.com/free-vector/blogging-fun-content-creation-online-streaming-video-blog-young-girl-making-selfie-social-network-sharing-feedback-self-promotion-strategy-vector-isolated-concept-metaphor-illustration_335657-855.jpg?ga=GA1.1.524425573.1774503546&semt=ais_hybrid&w=740&q=80'); background-size: cover;">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Add New Blog</h4>
                                    <p class="mb-0">Enter the details of the blog</p>
                                </div>
                                <div class="card-body">

                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger text-white text-xs" role="alert">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif; ?>

                                    <form role="form" action="" method="POST" enctype="multipart/form-data">

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" name="author" class="form-control" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Category</label>
                                            <input type="text" name="category" class="form-control" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Blog Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" name="date" class="form-control" rows="3" required>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" required></textarea>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="add_blog" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Add Product</button>
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