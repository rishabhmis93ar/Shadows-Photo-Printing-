<?php
$page_title = "Our Products";
include_once "../includes/header.php";
?>

<section class="product-banner">
    <div class="container">
        <div class="contact-bnr-text">
            <h2>OUR PRODUCTS </h2>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <div class="categories-wrapper custom-categories">
            <?php
            include_once "../config/config.php";
            include_once "../config/functions.php";

            $result = getAll($conn, 'category');
            if ($result && mysqli_num_rows($result) > 0) {

            ?>
            <div class="row">
                 <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-lg-3 col-md-6 ">
                    <div class="product-categories">
                        <a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo ADMIN_URL; ?>assets/img/<?php echo $row['image']; ?>" alt="">
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

<?php include_once "../includes/footer.php"; ?>