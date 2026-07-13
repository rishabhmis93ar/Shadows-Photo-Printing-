<?php
include_once __DIR__ . "/../config/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        if (isset($page_title)) {
            echo $page_title;
        } else {
            echo "Shadows Photo Printing";
        }
        ?>
    </title>

    <!-- 1. Favicon -->
    <link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon.jpg" type="image/x-icon">

    <!-- 2. CSS Libraries  -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/slick-theme.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/aos.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fonts/stylesheet.css">

    <!-- 3. Icon Fonts (CDN links) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- 4. Custom Styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">

</head>

<body>
    <div class="main-page">
        <!-- HEADER -->
        <header class="header">
            <!-- Main Header -->
            <div class="navigation page-header">
                <div class="container">
                    <div class="navigation-inner">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="logo">
                                <a href="<?php echo BASE_URL; ?>index.php">
                                    <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="logo">
                                </a>
                            </div>
                            <div class="sidena mycel" id="mySidenav">
                                <div class="magnifying">
                                    <ul class="desk-trt">
                                        <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
                                            <!-- NOT LOGGED IN -->
                                            <li class="update-menu" data-bs-toggle="modal" data-bs-target="#myModal">
                                                <a class=""><span>Login/Signup</span> </a>
                                            </li>
                                        <?php else: ?>
                                            <!-- LOGGED IN -->
                                            <li class="dropdown"><a href="<?php echo BASE_URL; ?>customer/my-account.php" class="signup" style="display: block !important;">MY ACCOUNT </a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <div class="kt-woo-account-nav">
                                                            <div class="kad-account-avatar">
                                                                <div class="kad-customer-image">
                                                                    <img src="<?php echo BASE_URL; ?>assets/images/user.png" alt="user">
                                                                </div>
                                                                <div class="kad-customer-name">
                                                                    <h5><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="MyAccount-navigation">
                                                                <ul class="ashboard">
                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/my-account.php"
                                                                            class="active">Dashboard <i
                                                                                class="fa-solid fa-gauge"></i></a> </li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/all-orders.php">Orders<i
                                                                                class="fa-solid fa-bag-shopping"></i></a>
                                                                    </li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/my-downloads.php">Downloads <i
                                                                                class="fa-solid fa-download"></i></a> </li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/my-addresses.php">Addresses <i
                                                                                class="fa-solid fa-house"></i></a></li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/payment-methods.php">Payment
                                                                            methods <i
                                                                                class="fa-solid fa-credit-card"></i></a>
                                                                    </li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/edit-account.php">Account
                                                                            details <i class="fa-solid fa-user"></i></a>
                                                                    </li>

                                                                    <li class=""> <a href="<?php echo BASE_URL; ?>customer/my-coupons.php">My Coupons
                                                                            <i class="fa-solid fa-credit-card"></i></a>
                                                                    </li>

                                                                    <li class=""><a href="<?php echo BASE_URL; ?>auth/logout.php">Log out <i
                                                                                class="fa-solid fa-arrow-right"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                        <!-- END DYNAMIC PART -->
                                        <li><a href="<?php echo BASE_URL; ?>shop/cart.php">
                                                <span class="kt-extras-label">
                                                    <span class="cart-extras-title">Cart</span>
                                                </span>
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>

                                                <span class="kt-cart-total">
                                                    <?php
                                                    $cart_count = 0;

                                                    if (isset($_SESSION['cart'])) {
                                                        foreach ($_SESSION['cart'] as $item) {
                                                            $cart_count += $item['qty'];
                                                        }
                                                    }
                                                    echo $cart_count;
                                                    ?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="social-media"><a><i class="fa-brands fa-facebook-f"></i> </a></li>
                                        <li class="social-media"><a> <i class="fa-brands fa-instagram"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="toggle-bar">
                                <span class="toggle_menu" onclick="openNav()"><i class="fa fa-bars"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HEADER BOTTOM -->
            <div class="outside-second">
                <div class="second-navclass">
                    <div class="container">
                        <div class="second-clearfix">
                            <div class="sidenavs" id="mySidenavs">
                                <span class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></span>
                                <div class="screen-reader">
                                    <div class="">
                                        <form action="">
                                            <div class="search-box">
                                                <input type="search" class="search-field no-cancel-button"
                                                    placeholder="Search …" value="" name="s">
                                                <span class="magnifying"><i
                                                        class="fa-solid fa-magnifying-glass"></i></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <ul>
                                    <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>shop/order-prints.php">Shop</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>pages/blog.php">Blog</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>pages/fun-facts.php">Fun Facts</a></li>
                                    <li class="dropdown"><a href="<?php echo BASE_URL; ?>shop/our-products.php">Our Products <i class="fa-solid fa-caret-down"></i></a>
                                        <ul class="sub-menu">
                                            <?php
                                            $sql = "SELECT * FROM category LIMIT 6";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0) {
                                                While($row = mysqli_fetch_assoc($result)) {
                                            
                                            ?>
                                            <li><a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
                                            <?php }} ?>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo BASE_URL; ?>pages/get-a-quote.php">Get a Quote</a></li>
                                    <li><a href="<?php echo BASE_URL; ?>pages/contact-us.php">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HEADER BOTTOM -->
        </header>
        <!-- HEADER -->