<?php
include_once "../includes/header.php";
include_once "../config/config.php";
include_once "../config/functions.php";

// Get the product ID
$id = $_GET['id'];
// Fetch product from database
$product = getByID($conn, 'products', $id);
// Get category ID of this product
$cat_id = $product['category_id'];
// Get category Details
$category = getByID($conn, 'category', $cat_id);
?>

<div class="kt-bc-nomargin">
    <div class="adbreadcrumbs never">
        <div class="container">
            <div class="breadcrumbs-wrapper">
                <span><a href="<?php echo BASE_URL; ?>index.php">Home</a></span>
                <span class="bc-delimiter">»</span>
                <span><a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></span>
                <span class="bc-delimiter">»</span>
                <span class="kad-breadcurrent"><?php echo $product['title']; ?></span>
            </div>
        </div>
    </div>
</div>

<section class="description">
    <div class="container">
        <div class="description-wrapper">
            <?php
            if ($product) {
            ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="on-sale">
                            <img src="<?php echo ADMIN_URL; ?>assets/img/<?php echo $product['image']; ?>" alt="Posters-241">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="canvas-summary">
                            <p><?php echo $category['name']; ?></p>
                            <h2><?php echo $product['title']; ?></h2>
                            <p class="incl">
                                <?php if (!empty($product['sale_price'])) { ?>
                                    <span>$<?php echo $product['sale_price']; ?></span>
                                    <del>$<?php echo $product['regular_price']; ?></del>
                                <?php } else { ?>
                                    <span>$<?php echo $product['regular_price']; ?></span>
                                <?php } ?>
                                <span>incl. GST</span>
                            </p>
                            <div class="print_paper">
                                <div class="ppaper">
                                    <p>Type of Paper Use:</p>

                                    <select name="paper_type">
                                        <?php
                                            // Database se paper_types string uthana
                                            $paper_str = !empty($product['paper_types']) ? $product['paper_types'] : "Luster";

                                            // String ko comma se tod kar array banana
                                            $options = explode(',', $paper_str);

                                            foreach ($options as $opt) {
                                                $trimmed_opt = trim($opt); // Space hatane ke liye
                                                echo "<option value='$trimmed_opt'>$trimmed_opt</option>";
                                            }
                                            ?>
                                            </select>
                                </div>

                                <div class="quanti">
                                    <input type="number" name="quantity" class="qty-input" value="1">
                                    <button type="button" class="add-to-cart-btn" value="<?php echo $product['id']; ?>">Add to cart</button>
                                </div>
                                <div class="product_meta">
                                    <span class="posted_in">
                                        Category: <a href="<?php echo BASE_URL; ?>shop/product-category.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="wonderful">
    <div class="container">
        <div class="wonderful-box">
            <ul class="tab-title">
                <li><a>Description</a></li>
            </ul>
            <div class="woocommerce-tabs">
                <h2>Description</h2>
                <p><?php echo $product['description']; ?></p>
                <p><?php echo $product['title']; ?> <?php echo $category['name']; ?>.</p>
                <p>Dimensions: <?php echo $product['dimensions']; ?></p>
            </div>
        </div>
    </div>
</section>

<section class="related-products">
    <div class="container">
        <div class="dimensions">
            <h2>Related Products </h2>

            <div class="related-slider">
                <div class="slider responsive">
                    <?php
                    // Get all the products related to this one(we will fetch all the products whose category is same as above single product)
                    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ? AND id != ? LIMIT 8");
                    $stmt->bind_param("ii", $cat_id, $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div>
                                <a href="<?php echo BASE_URL; ?>shop/single-product.php?id=<?php echo $row['id']; ?>">
                                    <div class="sets">
                                        <div class="products-img">
                                            <img src="<?php echo ADMIN_URL; ?>assets/img/<?php echo $row['image']; ?>" alt="">
                                            <?php if (!empty($row['sale_price'])) { ?>
                                                <div class="onsale">
                                                    <span>Sale!</span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="text-slider">
                                            <h3><?php echo $row['title']; ?></h3>
                                            <p>
                                                <?php if (!empty($row['sale_price'])) { ?>
                                                    <span>$<?php echo $row['sale_price']; ?></span>
                                                    <del>$<?php echo $row['regular_price']; ?></del>
                                                <?php } else { ?>
                                                    <span>$<?php echo $row['regular_price']; ?></span>
                                                <?php } ?>
                                                incl. GST
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "../includes/footer.php"; ?>
