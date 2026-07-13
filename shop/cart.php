<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once "../config/config.php";
include_once "../config/functions.php";
$page_title = "Cart - Shadows Photo Printing";
include_once "../includes/header.php";
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/cart.css">

<section class="coupon-main">
    <div class="container">
        <div class="coupon-inner">
            <!-- Alert message for Remove/Update actions -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="coupon-wrapper">
                    <p> <?php echo $_SESSION['message'];
                        unset($_SESSION['message']); ?> </p>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <div class="kt-woo-cart-form-wrap">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="../ajax/handle-cart.php" class="intero" method="POST">
                                <div class="cart-summary">
                                    <h2>Cart Summary</h2>
                                </div>
                                <table cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">Remove</th>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // Calling the function 
                                        $cartTotals = calculateCartTotals($conn);

                                        $total = $cartTotals['subtotal'];
                                        $shipping = $cartTotals['shipping'];
                                        $discount = $cartTotals['discount'];
                                        $coupon_name = $cartTotals['coupon_name'];
                                        $grand_total = $cartTotals['grand_total'];
                                        $gst_amount = $cartTotals['gst_amount'];

                                        // Check if cart is not empty
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                                            foreach ($_SESSION['cart'] as $key => $item) {
                                                // Fetch latest product details from DB
                                                $product = getByID($conn, 'products', $item['product_id']);
                                                if (!$product) continue;
                                                $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
                                                $subtotal = $price * $item['qty'];
                                        ?>
                                                <tr>
                                                    <td class="product-remove">
                                                        <a href="../ajax/handle-cart.php?remove_id=<?php echo $key; ?>">×</a>
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <img src="<?php echo BASE_URL; ?>admin/assets/img/<?php echo $product['image']; ?>" alt="">
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="<?php echo BASE_URL; ?>shop/single-product.php?id=<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a>
                                                        <br><small>Style: <?php echo htmlspecialchars($item['paper_type']); ?></small>
                                                    </td>
                                                    <td class="product-price">
                                                        <span>$<?php echo number_format($price, 2); ?></span>
                                                    </td>
                                                    <td class="product-quantity">
                                                        <!-- Quantity input with array name to update all at once -->
                                                        <input type="number" name="qty[<?php echo $key; ?>]" value="<?php echo $item['qty']; ?>" min="1">
                                                    </td>
                                                    <td class="product-subtotal">
                                                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                                                    </td>
                                                </tr>
                                        <?php
                                            } // End of Foreach
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center p-4'>Your cart is empty!</td></tr>";
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6" class="actions">
                                                <div class="coupon-icons">
                                                    <input type="text" name="coupon_code" class="input-text"
                                                        id="coupon_code" value="" placeholder="Coupon code">
                                                    <button type="button" class="button" id="apply_coupon_btn" name="apply_coupon">Apply coupon</button>
                                                </div>
                                                <button type="submit" class="button satay" name="update_cart_btn"
                                                    value="Update cart">Update cart</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <div class="cart-collaterals">
                                <div class="cart_totals ">
                                    <h2>Cart totals</h2>
                                </div>
                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>$<?php echo number_format($total, 2); ?></td>
                                        </tr>

                                        <!-- Show coupon only if the discount is greater than 0 -->
                                        <?php if ($discount > 0): ?>
                                            <tr class="cart-discount coupon-eofy-discount">
                                                <th>
                                                    Coupon: <?php echo htmlspecialchars($coupon_name); ?>
                                                    <a href="../ajax/remove-coupon.php" style="color:red; font-size:12px; margin-left:10px;">[Remove]</a>
                                                </th>
                                                <td data-title="<?php echo htmlspecialchars($coupon_name); ?>">-<span
                                                        class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol">$</span><?php echo number_format($discount, 2); ?></span>
                                                </td>

                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <th>Shipping</th>
                                            <td>
                                                <?php $user_id = $_SESSION['user_id'] ?? null; ?>

                                                <span class="flat-rate"> Flat rate: <?php if(isset($user_id)){ echo '$' . number_format($shipping, 2);} else {echo '$0';} ?></span>
                                                <br><br>
                                                <?php
                                                $address = null;

                                                if (isset($_SESSION['user_id'])) {
                                                    $user_id = $_SESSION['user_id'];
                                                    $address = getAddress($conn, $user_id, 'billing');

                                                ?>
                                                    <p class="">
                                                        Shipping to: <br>
                                                        <?php if ($address) { ?>
                                                            <strong>
                                                                <?php echo $address['street_address'] ?? 'No Address'; ?> <br>
                                                                <?php echo $address['city'] . " (" .  $address['postcode'] . ")" ?? ''; ?> <br>
                                                                <?php echo $address['country'] ?? ''; ?>
                                                            </strong>
                                                        <?php } ?>
                                                    </p>
                                                <?php } else { ?>
                                                    <a href="<?php echo BASE_URL; ?>auth/log-out.php">
                                                        <p class="">
                                                            <strong>Logged Out? Login Here</strong>
                                                        </p>
                                                    </a>
                                                <?php } ?>

                                                <p class="woocommerce-shipping-destination">
                                                    Shipping options will be updated during checkout.
                                                </p>

                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td data-title="Total">
                                                <strong><?php if(isset($user_id)){ echo '$' . number_format($grand_total, 2);} else {echo '$0';} ?></strong>
                                                <small class="includes_tax">(includes
                                                    <span><?php if(isset($user_id)){ echo '$' . number_format($gst_amount, 2);} else {echo '$0';} ?></span> GST)
                                                </small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="wc-proceed-to-checkout">
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <a href="<?php echo BASE_URL; ?>shop/checkout.php" class="checkout-button button alt wc-forward">
                                            Proceed to checkout
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" id="show-login-msg" class="checkout-button button alt wc-forward">
                                            Proceed to checkout
                                        </a>
                                        <!-- Error Message Div -->
                                        <div id="auth-error-msg" style="display:none; margin-top: 0px; padding: 10px; background-color: #fff0f0; color: #d9534f; border: 1px solid #d9534f; border-radius: 4px; text-align: center; font-size: 14px;">
                                            ⚠️ Please login or register to proceed.
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="shopping_btn_cstm"> <a href="<?php echo BASE_URL; ?>shop/order-prints.php" class="shop_cont_button">Continue Shopping →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Button click handle karna
        $('#show-login-msg').on('click', function(e) {
            e.preventDefault();

            // Message ko dikhana
            $('#auth-error-msg').fadeIn('fast');

            // 4 second baad automatic hide karna
            setTimeout(function() {
                $('#auth-error-msg').fadeOut('slow');
            }, 4000);
        });
    });
</script>

<?php include_once "../includes/footer.php"; ?>
<script src="<?php echo BASE_URL; ?>assets/js/cart.js"></script>
<script>
    document.getElementById('apply_coupon_btn').addEventListener('click', function() {
        const code = document.getElementById('coupon_code').value;

        if (code == "") {
            alert("Please enter a code");
            return;
        }

        fetch('../ajax/apply-coupon.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'coupon_code=' + encodeURIComponent(code)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Success hone par total update karne ke liye reload
                } else {
                    alert(data.message);
                }
            });
    });
</script>