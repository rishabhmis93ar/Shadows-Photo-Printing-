<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";

// Get Order ID from URL
$order_id = $_GET['id'] ?? null;

if (!$order_id || !isset($_SESSION['user_id'])) {
    header("Location: orders.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch Order Main Details
$order_query = "SELECT * FROM orders WHERE id = '$order_id' AND user_id = '$user_id' LIMIT 1";
$order_res = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_res);

if (!$order) {
    die("Order not found or unauthorized access.");
}

// Fetch Order Items (Join with Products to get Title)
$items_query = "SELECT oi.*, p.title FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = '$order_id'";
$items_res = mysqli_query($conn, $items_query);

$page_title = "Order #" . $order_id;
include_once "../includes/header.php";
?>


<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">

                <?php include_once "partials/sidebar.php"; ?>

                <!-- Order Content -->
                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Order #<?php echo $order['id']; ?></h2>
                            <div class="notices-wrap">
                                <p>Order #<?php echo $order['id']; ?> was placed on
                                    <strong><?php echo date("F j, Y", strtotime($order['created_at'])); ?></strong>
                                    and is currently <strong><?php echo ucfirst($order['status']); ?></strong>.
                                </p>
                            </div>

                            <div class="order-details">
                                <div class="order-box">
                                    <h2>Order details</h2>
                                </div>

                                <table class="shop-details">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        while ($item = mysqli_fetch_assoc($items_res)):
                                            $line_total = $item['price'] * $item['qty'];
                                            $subtotal += $line_total;
                                        ?>
                                            <tr>
                                                <td>
                                                    <a href="#"><?php echo $item['title']; ?></a>
                                                    <strong>× <?php echo $item['qty']; ?></strong>
                                                    <?php if (!empty($item['paper_type'])): ?>
                                                        <br><small>Paper: <?php echo $item['paper_type']; ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span>$<?php echo number_format($line_total, 2); ?></span></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Subtotal:</th>
                                            <td><span>$<?php echo number_format($subtotal, 2); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td><span>$<?php echo number_format($order['shipping_cost'], 2); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Payment method:</th>
                                            <td><span>Stripe Card</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><strong>$<?php echo number_format($order['total'], 2); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Customer Address Section -->
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <div class="customer-details">
                                        <h2>Billing address</h2>
                                        <address>
                                            <span><?php echo $order['fname'] . " " . $order['lname']; ?></span><br>
                                            <span><?php echo $order['company_name']; ?></span><br>
                                            <span><?php echo $order['billing_address']; ?></span><br>
                                            <p><?php echo $order['email']; ?></p>
                                            <p><?php echo $order['phone']; ?></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="customer-details">
                                        <h2>Shipping address</h2>
                                        <address>
                                            <span><?php echo $order['shipping_fname'] . " " . $order['shipping_lname']; ?></span><br>
                                            <span><?php echo $order['shipping_street']; ?></span><br>
                                            <?php if (!empty($order['shipping_suite'])) echo "<span>" . $order['shipping_suite'] . "</span><br>"; ?>
                                            <span><?php echo $order['shipping_suburb'] . ", " . $order['shipping_state'] . " " . $order['shipping_postcode']; ?></span>
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
</section>

<?php include_once "../includes/footer.php"; ?>