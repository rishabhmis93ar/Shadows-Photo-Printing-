<?php
$page_title = "Photo Prints Online Australia, Professional Photographer Glenreagh NSW, Canvas Photo Printing, Shadows Photo Printing";
include_once "includes/header.php";
?>

<!-- HERO SECTION -->
<div class="banner-slider fade-slider">
    <div>
        <div class="image">
            <div class="slider-wrapper">
                <img src="<?php echo BASE_URL; ?>assets/images/Wp2print-starter-1.jpg" alt="">
            </div>
        </div>
    </div>
    <div>
        <div class="image">
            <div class="slider-wrapper">
                <img src="<?php echo BASE_URL; ?>assets/images/Wp2print-starter-9.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<!-- HERO SECTION -->

<!-- Welcome to Shadows Photo Printing -->
<section class="entry-content">
    <div class="container">
        <div class="entry-content-wraaper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="entry-img">
                        <figure data-aos="fade-right">
                            <img src="<?php echo BASE_URL; ?>assets/images/red.jpg" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="entry-text">
                        <div class="widget-title" data-aos="fade-left">
                            <h3>Welcome to Shadows Photo Printing </h3>
                            <div class="textwidget">
                                <p>At Shadows Photo Printing we offer a professional photo printing by
                                    professional
                                    Photographers who take the time to check the quality of your image before we
                                    print, as we understand how important your beautiful memories are.</p>
                                <p>
                                <p>Once we have checked the quality of your wonderful image and there is no
                                    issues
                                    we will go ahead and carefully print your beautiful memories and dispatch
                                    them
                                    as quickly as possible.</p>
                                </p>
                            </div>

                        </div>
                        <div class="so-widget-sow-button" data-aos="fade-left">
                            <a href="<?php echo BASE_URL; ?>shop/order-prints.php"> Shop Now </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Welcome to Shadows Photo Printing -->

<!--  -->
<section class="custom-size">
    <div class="container">
        <div class="custom-wrapper">
            <div class="custom-size-content">
                <h2 data-aos="fade-right">If you have a custom size to be printed, please fill out the form and
                    We will get back to
                    you with the price.</h2>
                <div class="ow-button-base" data-aos="fade-left">
                    <a href="<?php echo BASE_URL; ?>pages/get-a-quote.php"> Get a Quote </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  -->

<!-- Shop By Categories -->
<section class="categories">
    <div class="container">
        <div class="categories-heading">
            <h3>Shop By Categories</h3>
        </div>
        <div class="categories-wrapper">
            <?php
            include_once "config/config.php";
            include_once "config/functions.php";

            $result = getAll($conn, 'category');
            if ($result && mysqli_num_rows($result) > 0) {
            ?>
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-lg-3 col-md-6 ">
                            <div class="product-categories">
                                <a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $row['id']; ?>">
                                    <img src="<?php echo BASE_URL; ?>admin/assets/img/<?php echo $row['image']; ?>" alt="">
                                    <span><?php echo $row['name']; ?></span>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php
            } else {
                echo "<h4>No Category Exists</h4>";
            } ?>
        </div>
    </div>
</section>
<!-- Shop By Categories -->

<!-- Photo Restoration Service -->
<section class="restoration">
    <div class="container">
        <div class="restoration-box">
            <div class="restoration-wrapper kash">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="restoration-content">
                            <h2>Photo Restoration Service</h2>
                            <div class="restoration-btn">
                                <a href="<?php echo BASE_URL; ?>pages/contact-us.php">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="restoration-img">
                            <figure>
                                <img src="<?php echo BASE_URL; ?>assets/images/cart-page.jpg" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="restoration-wrapper seconds">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="restoration-img">
                            <figure>
                                <img src="<?php echo BASE_URL; ?>assets/images/canvasprint9.jpg" alt="">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="restoration-content">
                            <h2>We accept bulk orders for
                            </h2>
                            <p><a href="#">Scrapbook Prints</a>, <a href="#">Prints & Enlargements</a>, <a
                                    href="#">Canvas Prints</a>, <a href="#">Posters & Panoramics</a></p>
                            <div class="restoration-btn">
                                <a href="<?php echo BASE_URL; ?>shop/order-prints.php">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Photo Restoration Service -->

<?php include_once "includes/footer.php"; ?>