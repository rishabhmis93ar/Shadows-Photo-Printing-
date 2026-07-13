<?php
session_start();

include_once "../config/config.php";
include_once "../config/functions.php";
include_once "../includes/header.php";

$user_id = $_SESSION['user_id'];

$billing = getAddress($conn, $user_id, 'billing');
$shipping = getAddress($conn, $user_id, 'shipping');
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
               <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Addresses</h2>
                            <p>The following addresses will be used
                                on the checkout page by default.
                            </p>
                            <div class="set-addresses">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="woocommerce-address">
                                            <div class="address-billi">
                                                <h3>Billing address</h3>
                                                <a href="edit-address.php?type=Billing" class="edit">Edit</a>
                                            </div>
                                            <address class="billing-address">
                                                <?php if ($billing): ?>
                                                    <span><?php echo $billing['first_name'] . " " . $billing['last_name']; ?></span><br>
                                                    <span><?php echo $billing['street_address']; ?></span><br>
                                                    <span><?php echo $billing['city'] . ", " . $billing['state'] . " " . $billing['postcode']; ?></span>
                                                <?php else: ?>
                                                    <span>No billing address set.</span>
                                                <?php endif; ?>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="woocommerce-address">
                                            <div class="address-billi">
                                                <h3>Shipping address</h3>
                                                <a href="edit-address.php?type=Shipping" class="edit">Edit</a>
                                            </div>
                                            <address class="billing-address">
                                                <?php if ($shipping): ?>
                                                    <span><?php echo $shipping['first_name'] . " " . $shipping['last_name']; ?></span><br>
                                                    <span><?php echo $shipping['street_address']; ?></span><br>
                                                    <span><?php echo $shipping['city'] . ", " . $shipping['state'] . " " . $shipping['postcode']; ?></span>
                                                <?php else: ?>
                                                    <span>No shipping address set.</span>
                                                <?php endif; ?>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "../includes/footer.php"; ?>