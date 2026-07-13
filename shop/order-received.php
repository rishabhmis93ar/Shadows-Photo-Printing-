<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";

// GET ORDER ID FROM URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    header("Location: ../index.php");
    exit();
}

$order_id = intval($_GET['order_id']);

// FETCH ORDER DETAILS
$order = getByID($conn, 'orders', $order_id);

if (!$order) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $order['user_id']) {
    die("Unauthorized access");
}

// FETCH ORDER ITEMS
$items_query = "SELECT oi.*, p.title as product_title, p.image as product_image 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = ?";
$stmt = $conn->prepare($items_query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items_result = $stmt->get_result();

// PREPARE DATA
$order_date = date("F j, Y", strtotime($order['created_at'] ?? 'now'));
$order_email = $order['email'];
$order_total = number_format($order['total'], 2);

// Billing address
$billing_name = $order['fname'] . ' ' . $order['lname'];
$billing_address = $order['address'] ?? '';
$billing_state = $order['state'] ?? '';
$billing_postcode = $order['postcode'] ?? '';

// Shipping address (fallback to billing if not set)
$shipping_name = $order['shipping_fname'] ? $order['shipping_fname'] . ' ' . ($order['shipping_lname'] ?? '') : $billing_name;
$shipping_address = $order['shipping_address'] ?? $billing_address;
$shipping_state = $order['shipping_state'] ?? $billing_state;
$shipping_postcode = $order['shipping_postcode'] ?? $billing_postcode;

$page_title = "Order Received - Shadows Photo Printing";
include_once "../includes/header.php";
?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/order-received.css">

<!-- section -->
<section class="received-oorder">
    <div class="container">
        <div class="received-oorder-wrapper">
            <h2>Order received </h2>
            <p>Thank you. Your order has been received.</p>
            <div class="been-received">
                <ul>
                    <li> Order number: <strong><?php echo $order_id; ?></strong> </li>
                    <li> Date: <strong><?php echo $order_date; ?></strong> </li>
                    <li> Email:<strong><?php echo htmlspecialchars($order_email); ?></strong></li>
                    <li> Total: <strong>$<?php echo $order_total; ?></strong></li>
                    <li> Payment method: <strong>Invoice</strong> </li>
                    <li> Status: <strong><?php echo ucfirst($order['status'] ?? 'pending'); ?></strong></li>
                </ul>
            </div>
            <div class="clear"></div>
            <p>We will invoice your company</p>
        </div>
    </div>
</section>
<!-- section -->

<section class="order-detailss">
    <div class="container">
        <div class="order-details-wrapper">
            <h2>Order details</h2>

            <table class="table-order-details">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    if ($items_result->num_rows > 0) {
                        while ($item = $items_result->fetch_assoc()) {
                            $item_total = $item['price'] * $item['qty'];
                            $subtotal += $item_total;
                    ?>
                            <tr>
                                <td>
                                    <a href="single-product.php?id=<?php echo $item['product_id']; ?>">
                                        <?php echo htmlspecialchars($item['product_title']); ?>
                                    </a>
                                    <strong> × <?php echo $item['qty']; ?></strong>
                                    <ul class="wc-item-meta">
                                        <?php if (!empty($item['paper_type'])): ?>
                                            <li>
                                                <strong>Type:</strong>
                                                <p><?php echo htmlspecialchars($item['paper_type']); ?></p>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($item['size'])): ?>
                                            <li>
                                                <strong>Size:</strong>
                                                <p><?php echo htmlspecialchars($item['size']); ?></p>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                                <td>
                                    <span>$<?php echo number_format($item_total, 2); ?></span>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Subtotal:</th>
                        <td> $<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                    <tr>
                        <th>Shipping:</th>
                        <td>
                            $<?php echo number_format($order['shipping_cost'] ?? 20.00, 2); ?> via Flat rate
                        </td>
                    </tr>
                    <tr>
                        <th>Payment method: </th>
                        <td>Invoice </td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td> $<?php echo $order_total; ?> </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

<section class="column-title">
    <div class="container">
        <div class="column-title-ops">
            <div class="row">
                <div class="col-md-6">
                    <div class="billing-address">
                        <h2>Billing address</h2>
                        <address>
                            <span><?php echo htmlspecialchars($billing_name); ?></span>
                            <?php if (!empty($order['company_name'])): ?>
                                <span><?php echo htmlspecialchars($order['company_name']); ?></span>
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($billing_address); ?></span>
                            <span><?php echo htmlspecialchars($billing_state . ' ' . $billing_postcode); ?></span>
                            <p><?php echo htmlspecialchars($order_email); ?></p>
                        </address>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="billing-address">
                        <h2>Shipping address</h2>
                        <address>
                            <span><?php echo htmlspecialchars($shipping_name); ?></span>
                            <?php if (!empty($order['shipping_company'])): ?>
                                <span><?php echo htmlspecialchars($order['shipping_company']); ?></span>
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($shipping_address); ?></span>
                            <span><?php echo htmlspecialchars($shipping_state . ' ' . $shipping_postcode); ?></span>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<?php
$stmt->close();
include_once "../includes/footer.php";
?>