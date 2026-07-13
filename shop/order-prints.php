<?php
$page_title = "Photo Prints Online Australia, Professional Photographer Glenreagh NSW, Canvas Photo Printing, Shadows Photo Printing";
include_once "../includes/header.php";
include_once "../config/config.php";
include_once "../config/functions.php";
?>

<!-- HERO SECTION -->
<div class="banner-slider fade-slider">
    <div>
        <div class="image">
            <div class="slider-wrapper">
                <img src="<?php echo BASE_URL; ?>assets/images/Wp2print-starter-2.jpg" alt="">
            </div>
        </div>
    </div>
    <div>
        <div class="image">
            <div class="slider-wrapper">
                <img src="<?php echo BASE_URL; ?>assets/images/Wp2print-starter-3.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<!-- HERO SECTION -->

<section class="instructions">
    <div class="container">
        <div class="instructions-inner">
            <div class="so-widget">
                <h3>The instructions to Order your print on our Website.</h3>

                <div class="tinymce ">
                    <ol>
                        <li>Please upload your files by clicking on Select files, after selecting files click on
                            the Upload images button and then wait until they are all processed and moved on to
                            the next step.</li>
                        <li>Then click in the box where it has a tick on the image you would like to work with.
                        </li>
                        <li>Then click the product’s box and pick what category you need.</li>
                        <li> Then pick the size you would like to print and add the qty then click add to cart
                            and follow this process until you are ready to view the cart/ check out.</li>
                    </ol>
                </div>

            </div>
            <div class="fcsg-wrap">
                <form method="post">
                    <div class="uploading">
                        <div class="uploading-img">
                            <p>Please select images for uploading:</p>
                            <div id="selectedFiles"></div>

                            <a id="selectfiles" href="javascript:;" class="button" style="position: relative; z-index: 1;">Select images</a>

                            <input type="file" id="fileInput" multiple style="display: none;">

                            <a id="uploadfiles" href="<?php echo BASE_URL; ?>pages/details.php" class="button button-primary" style="display: none;">Upload images</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="kad_product_wrapper">
    <div class="container">
        <div class="kad_product">
            <div class="row">

                <?php
                $result = getAll($conn, 'category');
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="product-category">
                                <a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $row['id']; ?>">
                                    <div class="cat-intrinsic">
                                        <img src="<?php echo BASE_URL; ?>admin/assets/img/<?php echo htmlspecialchars($row['image']); ?>" alt="">
                                    </div>
                                    <div class="product-cat-title">
                                        <h3>
                                            <?php echo htmlspecialchars($row['name']); ?>
                                            <small class="count">
                                                (<?php echo $row['product_count']; ?>)
                                            </small>
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>

<?php include_once "../includes/footer.php"; ?>