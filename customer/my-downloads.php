<?php
$page_title = "My Account";
include_once "../includes/header.php";
?>
<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
               <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Downloads</h2>
                            <div class="woocommerce-info">
                                <p> No downloads available yet. <a href="<?php echo BASE_URL; ?>order-prints.php">Browse products</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once "../includes/footer.php";
?>