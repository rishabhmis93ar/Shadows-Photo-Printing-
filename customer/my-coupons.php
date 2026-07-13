<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";
include_once "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$availableCoupons = getUserCoupons($conn, $user_id, 'available');
$usedCoupons = getUserCoupons($conn, $user_id, 'used');
$expiredCoupons = getUserCoupons($conn, $user_id, 'expired');
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
                <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>My Account</h2>
                            <div class="wt-mycoupons">
                                <h4>Available Coupons</h4>
                                <div class="available-coupon">
                                    <form action="#">
                                        <span>Sort by </span>
                                        <select name="wt_sc_available_coupons_orderby">
                                            <option value="created_date:desc">Latest first</option>
                                            <option value="created_date:asc" selected="selected">Latest last
                                            </option>
                                            <option value="amount:desc">Price high to low</option>
                                            <option value="amount:asc">Price low to high</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="clear"></div>
                                <div class="wt-coupon-wrapper">
                                    <?php if (!empty($availableCoupons)): ?>
                                        <?php foreach ($availableCoupons as $coupon): ?>
                                            <div class="single-coupon">
                                                <div class="coupon-content">
                                                    <div class="coupon-amount">
                                                        <span class="coupon-amount-amount">
                                                            <?php
                                                            if ($coupon['type'] == 'fixed') {
                                                                echo "$" . $coupon['value'];
                                                            } else {
                                                                echo $coupon['value'] . "%";
                                                            }
                                                            ?>
                                                        </span>

                                                        <span class="coupon-type">Cart discount</span>
                                                    </div>

                                                    <div class="coupon-code">
                                                        <span><?php echo htmlspecialchars($coupon['code']); ?></span>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Sorry, you don't have any available coupons</p>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="cssa-soupons">
                                <h4>Used Coupons</h4>
                                <div class="wt-used-coupons">
                                    <?php foreach ($usedCoupons as $coupon): ?>
                                        <div class="single-coupon">
                                            <div class="coupon-content">
                                                <div class="coupon-amount">
                                                    <span class="coupon-amount-amount">
                                                        <?php
                                                        if ($coupon['type'] == 'fixed') {
                                                            echo "$" . $coupon['value'];
                                                        } else {
                                                            echo $coupon['value'] . "%";
                                                        }
                                                        ?>
                                                    </span>
                                                    <span class="coupon-type">Cart discount</span>
                                                </div>

                                                <div class="coupon-code">
                                                    <span><?php echo htmlspecialchars($coupon['code']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="expired-coupons">
                                <div class="expired-wrapper">
                                    <h4>Expired Coupons</h4>
                                    <div class="myaccount-no">
                                        <?php if (!empty($expiredCoupons)): ?>
                                            <?php foreach ($expiredCoupons as $coupon): ?>
                                                <div class="single-coupon">
                                                    <div class="coupon-content">
                                                        <div class="coupon-amount">
                                                            <span class="coupon-amount-amount">
                                                                <?php
                                                                if ($coupon['type'] == 'fixed') {
                                                                    echo "$" . $coupon['value'];
                                                                } else {
                                                                    echo $coupon['value'] . "%";
                                                                }
                                                                ?>
                                                            </span>

                                                            <span class="coupon-type">Cart discount</span>
                                                        </div>

                                                        <div class="coupon-code">
                                                            <span><?php echo htmlspecialchars($coupon['code']); ?></span>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>Sorry, you don't have any expired coupons</p>
                                        <?php endif; ?>
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