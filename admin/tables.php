<?php

$title = "Tables";

include "includes/auth.php";
include_once "includes/header.php"; ?>

<body class="g-sidenav-show  bg-gray-100">

  <?php include_once "includes/sidebar.php"; ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include_once "includes/navbar.php";

    include_once "../config/config.php";
    include_once "../config/functions.php";

    $result = getAll($conn, 'users');
    ?>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Users table</h6>
                <a href="users/create.php" class="btn btn-sm btn-outline-white me-3 mb-0">Add New User</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Username</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">User Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold"><?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <p class="text-xs text-secondary mb-0"><?php echo $row['username']; ?></p>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <p class="text-xs text-secondary mb-0"><?php echo $row['email']; ?></p>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-success">
                              <a href="users/edit.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="users/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center'>No Users Found</td></tr>";
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Categories Table</h6>
                <a href="categories/create.php" class="btn btn-sm btn-outline-white me-3 mb-0">Add New Category</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Category Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Category Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Banner image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Product Count</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = getAll($conn, 'category');
                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold"><?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <img src="assets/img/<?php echo $row['image']; ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="category">
                          </td>

                          <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['name']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <img src="assets/img/<?php echo $row['banner_image']; ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="category">
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['product_count']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-success">
                              <a href="categories/edit.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Category">
                                Edit
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="categories/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete Category">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center'>No Categories Found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Products Table</h6>
                <a href="products/create.php" class="btn btn-sm btn-outline-white me-3 mb-0">Add New Product</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Category</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Regular Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Sale Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Dimensions</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Paper Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = getAll($conn, 'products');
                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold"><?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <div>
                              <img src="assets/img/<?php echo $row['image']; ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="product">
                            </div>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['category_id']; ?></span>
                          </td>

                          <td>
                            <span class="text-secondary text-xs font-weight-bold">$<?php echo number_format($row['regular_price'], 2); ?></span>
                          </td>

                          <td>
                            <span class="text-secondary text-xs font-weight-bold">$<?php echo number_format($row['sale_price'], 2); ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['dimensions']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['paper_types']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['title']; ?></span>
                          </td>

                          <td style="min-width: 200px; white-space: normal;">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php
                              $desc = strip_tags($row['description']);
                              $words = explode(" ", $desc);
                              if (count($words) > 4) {
                                echo implode(" ", array_slice($words, 0, 4)) . " ...";
                              } else {
                                echo $desc;
                              }
                              ?>
                            </span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-success">
                              <a href="products/edit.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Category">
                                Edit
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="products/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete Category">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center py-4'>No Products Found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Blogs Table</h6>
                <a href="blogs/create.php" class="btn btn-sm btn-outline-white me-3 mb-0">Add New Blog</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Title</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = getAll($conn, 'blogs');
                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold"><?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center" style="min-width: 200px; white-space: normal;">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['title']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <div>
                              <img src="assets/img/<?php echo $row['image']; ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="product">
                            </div>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['author']; ?></span>
                          </td>

                          <td style="min-width: 200px; white-space: normal;">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php
                              $desc = strip_tags($row['description']);
                              $words = explode(" ", $desc);
                              if (count($words) > 4) {
                                echo implode(" ", array_slice($words, 0, 4)) . " ...";
                              } else {
                                echo $desc;
                              }
                              ?>
                            </span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['date']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-success">
                              <a href="blogs/edit.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Category">
                                Edit
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="blogs/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete Category">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center py-4'>No Posts Found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Coupons Table</h6>
                <a href="coupons/create.php" class="btn btn-sm btn-outline-white me-3 mb-0">Add New Coupon</a>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder align-middle opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Code</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Value</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Expiry Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 align-middle ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 align-middle ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = getAll($conn, 'coupons');
                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold"><?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center" style="min-width: 200px; white-space: normal;">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['code']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo ucfirst($row['type']); ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo ($row['type'] == 'percent') ? $row['value'] . '%' : '$' . $row['value']; ?>
                            </span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo !empty($row['expiry_date']) ? date("d M, Y", strtotime($row['expiry_date'])) : 'No Limit'; ?>
                            </span>
                          </td>

                          <td class="align-middle text-center text-sm">
                            <?php if ($row['status'] == 1): ?>
                              <span class="text-secondary text-xs font-weight-bold">Active</span>
                            <?php else: ?>
                              <span class="text-secondary text-xs font-weight-bold">Inactive</span>
                            <?php endif; ?>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-success">
                              <a href="coupons/edit.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Category">
                                Edit
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="coupons/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete Category">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='5' class='text-center py-4'>No Coupons Found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Orders Table</h6>
                <button class="btn btn-sm btn-outline-white me-3 mb-0">Total Orders</button>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Customer Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Order Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">Total</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2 align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = getAll($conn, 'orders'); // Fetching from orders table
                    if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                          <td class="align-middle text-center">
                            <span class="text-xs font-weight-bold">#<?php echo $row['id']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['fname'] . ' ' . $row['lname']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $row['email']; ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo date("d M, Y", strtotime($row['created_at'])); ?></span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">$<?php echo number_format($row['total'], 2); ?></span>
                          </td>

                          <td class="align-middle text-center">                          
                            <span class="text-secondary text-xs font-weight-bold">
                              <?php echo ucfirst($row['status']); ?>
                            </span>
                          </td>

                          <td class="align-middle text-center">
                            <span class="badge badge-sm bg-gradient-info">
                              <a href="orders/view.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs">
                                View
                              </a>
                            </span>
                            <span class="badge badge-sm bg-gradient-danger">
                              <a href="orders/delete.php?id=<?php echo $row['id']; ?>" class="text-white font-weight-bold text-xs" onclick="return confirm('Delete this order?')">
                                Delete
                              </a>
                            </span>
                          </td>
                        </tr>
                    <?php
                      }
                    } else {
                      echo "<tr><td colspan='7' class='text-center py-4'>No Orders Found</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include_once "includes/footer.php"; ?>