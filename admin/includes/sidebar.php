<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
        <img src="assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Admin Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="<?php echo ADMIN_URL; ?>dashboard.php">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>tables.php">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>notifications.php">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>settings.php">
            <i class="material-symbols-rounded opacity-5">settings</i>
            <span class="nav-link-text ms-1">Settings</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>users/create.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Add User</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>categories/create.php">
            <i class="material-symbols-rounded opacity-5">category</i>
            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>products/create.php">
            <i class="material-symbols-rounded opacity-5">inventory_2</i>
            <span class="nav-link-text ms-1">Add Product</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo ADMIN_URL; ?>blogs/create.php">
            <i class="material-symbols-rounded opacity-5">article</i>
            <span class="nav-link-text ms-1">Add Blogs</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account pages</h6>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="profile.php">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-dark" href="<?php echo BASE_URL; ?>auth/logout.php">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>