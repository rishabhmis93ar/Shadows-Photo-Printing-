<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";

// If cart is empty redirect to cart page
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
$user_data = null;
$billing = null;

// If user is logged in
if ($user_id) {
    $user_data = getByID($conn, 'users', $user_id);
    $billing = getAddress($conn, $user_id, 'billing');
    $shipping = getAddress($conn, $user_id, 'shipping');
}


$page_title = "Checkout- Shadows Photo Printing";
include_once "../includes/header.php";
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/checkout.css">

<section class="coupon-main">
    <div class="container">
        <div class="coupon-inner">
            <div class="coupon-wrapper">
                <p> Returning customer? <a href="<?php echo BASE_URL; ?>auth/log-out.php">Click here to login</a> </p>
                <p> Have a coupon? <a href="#">Click here to enter your code</a> </p>
            </div>
            <!-- Form Start -->
            <form id="payment-form">
                <div class="billing-row">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="woocommerce-billing-fields">
                                <h3>Billing details</h3>
                                <div class="fields__field-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="form-row">
                                                <label>First name * </label>
                                                <input type="text" name="fname" value="<?php echo $billing['first_name'] ?? ''; ?>" placeholder="John" required>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="form-row">
                                                <label>Last name *</label>
                                                <input type="text" name="lname" value="<?php echo $billing['last_name'] ?? ''; ?>" placeholder="Cena" required>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="form-row">
                                        <label>Company name (optional) </label>
                                        <input type="text" name="company_name" value="<?php echo $billing['company_name'] ?? ''; ?>" placeholder="TCS">
                                    </p>

                                    <p class="form-row">
                                        <label>Country / Region *</label>
                                        <span> <strong>Australia </strong></span>
                                    </p>

                                    <p class="form-row">
                                        <label> Street address *</label>
                                        <input type="text" name="street" value="<?php echo $billing['street_address'] ?? ''; ?>" placeholder="House number and street name" required>
                                        <input type="text" name="suite" value="<?php echo $billing['suite'] ?? ''; ?>" placeholder="Apartment, suite, unit, etc. (optional) ">
                                    </p>

                                    <p class="form-row">
                                        <label> Suburb * </label>
                                        <input type="text" name="billing_suburb" value="<?php echo $billing['city'] ?? ''; ?>" placeholder="" required>
                                    </p>

                                    <p class="form-row">
                                    <div class="custom-select">
                                        <input type="hidden" name="state" id="billingStateInput">

                                        <div class="select-box">
                                            <div class="selected-item">Select an option</div>
                                            <div class="arrow">
                                                <i class="fa-solid fa-caret-down"></i>
                                            </div>
                                        </div>

                                        <ul class="options">
                                            <input type="text" class="billingStateInput" placeholder="Search options">
                                            <li class="option">Australian Capital Territory</li>
                                            <li class="option">New South Wales</li>
                                            <li class="option">Northern Territory</li>
                                            <li class="option">Queensland</li>
                                            <li class="option">South Australia</li>
                                            <li class="option">Tasmania</li>
                                            <li class="option">Victoria</li>
                                            <li class="option">Western Australia</li>
                                            <!-- Add more options as needed -->
                                        </ul>
                                    </div>
                                    </p>

                                    <p class="form-row">
                                        <label> Postcode *</label>
                                        <input type="text" name="postcode" value="<?php echo $billing['postcode'] ?? ''; ?>" required>
                                    </p>

                                    <p class="form-row">
                                        <label> Phone (optional)</label>
                                        <input type="number" name="number1" value="<?php echo $billing['phone'] ?? ''; ?>">
                                    </p>

                                    <p class="form-row">
                                        <label> Email address *</label>
                                        <input type="email" name="email12" value="<?php echo $billing['email'] ?? ''; ?>" required>
                                    </p>

                                    <p class="form-row">
                                        <label> Account username * </label>
                                        <input type="text" name="username" id="postcode" value="<?php echo $user_data['username'] ?? ''; ?>" placeholder="Username" required>
                                    </p>

                                    <p class="form-row">
                                        <label> Create account password *</label>
                                        <input type="password" name="password" placeholder="Password" required>
                                    </p>
                                </div>

                                <!-- SHIPPING SECTION -->
                                <div class="Ship-field">
                                    <div class="ship-to-different">
                                        <h3 class="ship-to-different-address">
                                            <label for="chkPassport">
                                                <input type="checkbox" id="chkPassport"> <span> Ship to a different address?</span>
                                            </label>
                                        </h3>
                                        <div class="fields__field-_gangast" id="dvPassport">
                                            <div class="fields__field-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p class="form-row">
                                                            <label>First name * </label>
                                                            <input type="text" name="shipping_fname" value="<?php echo $shipping['first_name'] ?? ''; ?>" placeholder="developer">
                                                        </p>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <p class="form-row">
                                                            <label>Last name *</label>
                                                            <input type="text" name="shipping_lname" value="<?php echo $shipping['last_name'] ?? ''; ?>" placeholder="dev">
                                                        </p>
                                                    </div>
                                                </div>

                                                <p class="form-row">
                                                    <label>Company name (optional) </label>
                                                    <input type="text" name="shipping_company" value="<?php echo $shipping['company_name'] ?? ''; ?>" placeholder="test ">
                                                </p>

                                                <p class="form-row">
                                                    <label>Country / Region *</label>
                                                    <span> <strong>Australia </strong></span>
                                                </p>

                                                <p class="form-row">
                                                    <label> Street address *</label>
                                                    <input type="text" name="shipping_street" value="<?php echo $shipping['street_address'] ?? ''; ?>" placeholder="House number and street name">
                                                    <input type="text" name="shipping_suite" value="<?php echo $shipping['apartment_suite'] ?? ''; ?>" placeholder="Apartment, suite, unit, etc. (optional)">
                                                </p>

                                                <p class="form-row">
                                                    <label> Suburb * </label>
                                                    <input type="text" name="shipping_suburb" value="<?php echo $shipping['city'] ?? ''; ?>" placeholder="">
                                                </p>

                                                <p class="form-row">
                                                <div class="custom-select">
                                                    <input type="hidden" name="shipping_state" id="shippingStateInput">
                                                    <div class="select-box">
                                                        <div class="selected-item">Select an option</div>
                                                        <div class="arrow">
                                                            <i class="fa-solid fa-caret-down"></i>
                                                        </div>
                                                    </div>
                                                    <ul class="options">
                                                        <input type="text" class="search-box" placeholder="Search options">
                                                        <li class="option">Australian Capital Territory</li>
                                                        <li class="option">New South Wales</li>
                                                        <li class="option">Northern Territory</li>
                                                        <li class="option">Queensland</li>
                                                        <li class="option">South Australia</li>
                                                        <li class="option">Tasmania</li>
                                                        <li class="option">Victoria</li>
                                                        <li class="option">Western Australia</li>
                                                        <!-- Add more options as needed -->
                                                    </ul>
                                                </div>

                                                </p>
                                                <p class="form-row">
                                                    <label> Postcode *</label>
                                                    <input type="text" name="shipping_postcode" value="<?php echo $shipping['postcode'] ?? ''; ?>">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="order-notes">
                                            <p class="form-row">
                                                <label>Order notes (optional) </label>
                                                <textarea name="order_comments" class="input-text" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols=""></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SHIPPING SECTION -->
                            </div>
                        </div>

                        <!-- ORDER SUMMARY -->
                        <div class="col-lg-6">
                            <div class="woocommerce-billing-fields">
                                <h3>Your order</h3>
                                <div class="order_review">
                                    <table class="shop_table ">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                                foreach ($_SESSION['cart'] as $item) {
                                                    $product = getByID($conn, 'products', $item['product_id']);
                                                    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
                                                    $subtotal = $price * $item['qty'];
                                                    $total += $subtotal;
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($product['title']); ?> × <?php echo $item['qty']; ?>
                                                            <br><small><?php echo htmlspecialchars($item['paper_type']); ?></small>
                                                        </td>
                                                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <?php
                                            // Calling the function 
                                            $cartTotals = calculateCartTotals($conn);

                                            $total = $cartTotals['subtotal'];
                                            $shipping = $cartTotals['shipping'];
                                            $discount = $cartTotals['discount'];
                                            $coupon_name = $cartTotals['coupon_name'];
                                            $grand_total = $cartTotals['grand_total'];
                                            $gst_amount = $cartTotals['gst_amount'];
                                            ?>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>$<?php echo number_format($total, 2); ?></td>
                                            </tr>

                                            <tr>
                                                <th>Coupon: <?php echo htmlspecialchars($coupon_name); ?></th>
                                                <td>-<span><span>$</span><?php echo number_format($discount, 2); ?></span> </td>
                                            </tr>

                                            <tr>
                                                <th>Shipping</th>
                                                <td>$<?php echo $shipping; ?></td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong>$<?php echo number_format($grand_total, 2); ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div id="payment">
                                        <div class="payment_methods">
                                            <ul>
                                                <li>
                                                    <label>Credit Card (Stripe)</label>
                                                    <div class="payment_box_payment_method_stripe">
                                                        <div class="stripe-payment-data">
                                                            <p>Pay securely using your credit/debit card.</p>
                                                        </div>

                                                        <div class="wc-stripe-cc-form">
                                                            <fieldset class="wc-stripe">
                                                                <div class="wc-content">
                                                                    <label>Card Details *</label>
                                                                    <!-- Stripe Card Element -->
                                                                    <div id="card-element"></div>
                                                                    <!-- Error message -->
                                                                    <div id="card-errors"></div>
                                                                </div>
                                                            </fieldset>
                                                        </div>

                                                        <fieldset class="checkbox-wrapper">
                                                            <input type="checkbox">
                                                            <span>Save payment information for future purchases</span>
                                                        </fieldset>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="experience-throughout">
                                            <p>
                                                Your personal data will be used to process your order and support your experience.
                                            </p>

                                            <div class="place-order">
                                                <input type="hidden" name="total_amount" value="<?php echo $total + $shipping; ?>">
                                                <button type="submit" id="submit-btn">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Form End -->
        </div>
    </div>
    </div>
</section>


<?php include_once "../includes/footer.php"; ?>
<script src="<?php echo BASE_URL; ?>assets/js/checkout.js"></script>

<!-- Load Stripe official library to use Stripe() function -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Etablish connection between Stripe and Backend (Making bridge between Backend and Stripe )
    const stripe = Stripe("pk_test_51TSEMwPwZJyMtPhGyMuPGPJY0HkJZfd3OHhdKYwqf0g4tv4KhUKmwVgcMqn00VdeRdkQwE5bcjJ5ny8FjNx8U4fm00wkWNc42r");

    // Element is a container which groups differrent inputs (card number, expiry) to apply same style
    const elements = stripe.elements();

    // Creating a generic card element, which includes Card Number, Expiry and CVV in a single line
    const card = elements.create("card", {
        hidePostalCode: true, // By default stripe card will create an input field named as ZIP code, if we don't need it we can hide it 
        style: { // Applying style on card to match website's design
            base: {
                fontSize: "16px",
                color: "#32325d",
                "::placeholder": {
                    color: "#aab7c4"
                }
            }
        }
    });

    card.mount("#card-element"); // This line loads real secure input box inside the '<div id="card-element"></div>'

    // Error handling (If user enters wrong information of card then, show error in '<div id="card-errors"></div>' this div)
    card.on("change", function(event) {
        document.getElementById("card-errors").textContent =
            event.error ? event.error.message : "";
    });

    // Form submit (Form Submission & Tokenization)

    const form = document.getElementById("payment-form");

    form.addEventListener("submit", async function(e) { // When user clicks on Place Order button then, e.preventDefault() stops browser to reload the page, to process the payment first in background 
        e.preventDefault();

        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod({ // It sends the user's card details to Stripe server, Stripe saves card details and returns a safe ID.
            type: "card",
            card: card
        });

        if (error) {
            document.getElementById("card-errors").textContent = error.message;
        } else {
            const formData = new FormData(form);

            // After getting Payment Method ID, two background calls fetch
            // SAVE CHECKOUT DATA : Before finalize payment store user's information into SESSION, so that agar payment success ho jaye, toh humein pata ho ki kis customer ke liye database mein order insert karna hai.
            fetch("../ajax/save-checkout-data.php", {
                method: "POST",
                body: formData
            }).then(() => {
                // THEN DO PAYMENT (Processing Payment)
                formData.append("payment_method_id", paymentMethod.id); // Hum Stripe se mili hui ID ko form data mein jod dete hain.

                fetch("../ajax/process-payment.php", { // eh aapki backend PHP file ko call karta hai. Wahan aapki Secret Key ka use karke asli paise kaate jate hain.
                        method: "POST",
                        body: formData
                    })
                    .then(res => res.json()) // Backend se jo jawab (Response) aata hai, use JSON format mein convert kiya jata hai.
                    .then(data => {
                        if (data.success) {
                            window.location.href = "<?php echo BASE_URL;?>shop/order-success.php"; // gar PHP file se success: true aaya, toh user ko order-success.php page par bhej diya jata hai.
                        } else {
                            alert(data.error); // Agar payment decline hui ya koi error aaya, toh user ko alert box dikhaya jata hai.
                        }
                    });
            });
        }
    });
</script>