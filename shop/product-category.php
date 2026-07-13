<?php
include_once "../includes/header.php";
include_once "../config/config.php";
include_once "../config/functions.php";

// Get the category ID
$cat_id = $_GET['id'];
$query = "SELECT * FROM products WHERE category_id = $cat_id";
$result = mysqli_query($conn, $query);

// Get details of category whose id is '$cat_id'
$result1 = getByID($conn, 'category', $cat_id);

$banner = $result1['banner_image'];
?>

<section class="scrapbook-banner"
    style="background: url('<?php echo ADMIN_URL; ?>assets/img/<?php echo $result1['banner_image']; ?>') no-repeat center/cover; height:400px; display:flex; align-items:center; justify-content:center;">

    <div class="container">
        <div class="contact-bnr-text">
            <h2><?php echo $result1['name']; ?></h2>
        </div>
    </div>
</section>

<section class="products_list">
    <div class="container">

        <div class="Product_box">
            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                <ul class="product-list">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <li class="product-sect">

                            <div class="Product-box">
                                <div class="Product_image">
                                    <a href="<?php echo BASE_URL; ?>shop/single-product.php?id=<?php echo $row['id']; ?>">
                                        <img src="<?php echo ADMIN_URL; ?>assets/img/<?php echo $row['image']; ?>" alt="scrap6">
                                    </a>
                                </div>
                                <div class="Product_info">
                                    <a href="<?php echo BASE_URL; ?>shop/single-product.php?id=<?php echo $row['id']; ?>">
                                        <h3><?php echo $row['title']; ?></h3>

                                        <div class="cart_price">
                                            <span class="price">Price: $<?php echo $row['sale_price']; ?>
                                            </span>
                                        </div>
                                    </a>

                                    <div class="print_paper_type">Type of Paper Use:
                                        <select>
                                            <option>Luster</option>
                                        </select>
                                    </div>
                                    <a href="<?php echo BASE_URL; ?>shop/single-product.php?id=<?php echo $row['id']; ?>">
                                        <p><?php echo $row['description'] . " " . $row['dimensions'] ?></p>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>

    </div>
</section>

<?php include_once "../includes/footer.php"; ?>