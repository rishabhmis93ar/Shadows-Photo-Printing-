<?php include_once "../includes/header.php"; ?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
                <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Payment methods</h2>
                            <div class="woocommerce-info">
                                <p> No saved methods found. <a href="order-prints.php">Browse products</a> </p>

                            </div>  
                            <div class="quanti">
                                <a href="add-payment-methods.php">Add payment method</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "../includes/footer.php"; ?>