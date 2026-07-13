<?php

// This code is working for both Stripe Checkout(Official page of Stripe) and Stripe Element(on your custom site) , This page will be redirected when stripe payment is successful

ob_start();
session_start();

include_once "../config/config.php";
include_once "../config/functions.php";
include_once "../config/mail.php";

// CHECK SESSION DATA
if (!isset($_SESSION['checkout_data']) || !isset($_SESSION['cart_backup'])) {
    // Redirect to home if someone tries to access this page directly without session
    header("Location: index.php");
    exit();
}

// Check if order is already processed in this session to prevent double entry
if (isset($_SESSION['order_processed'])) {
    header("Location: order-received.php?order_id=" . $_SESSION['last_order_id']);
    exit();
}

$data = $_SESSION['checkout_data'];
$cart = $_SESSION['cart_backup'];

// LOGIN CHECK
$user_id = $_SESSION['user_id'] ?? NULL;

// BILLING DATA (FROM SESSION)
$fname      = trim($data['fname'] ?? '');
$lname      = trim($data['lname'] ?? '');
$company    = trim($data['company_name'] ?? '');
$email      = trim($data['email12'] ?? '');
$phone      = trim($data['number1'] ?? '');
$street     = trim($data['street'] ?? '');
$suite      = trim($data['suite'] ?? '');
$suburb     = trim($data['billing_suburb'] ?? '');
$state      = trim($data['state'] ?? '');
$postcode   = trim($data['postcode'] ?? '');
$order_notes = trim($data['order_comments'] ?? '');


// SHIPPING DATA
$ship_fname    = trim($data['shipping_fname'] ?? $fname);
$ship_lname    = trim($data['shipping_lname'] ?? $lname);
$ship_company  = trim($data['shipping_company'] ?? '');
$ship_street   = trim($data['shipping_street'] ?? $street);
$ship_suite    = trim($data['shipping_suite'] ?? $suite);
$ship_suburb   = trim($data['shipping_suburb'] ?? $suburb);
$ship_state    = trim($data['shipping_state'] ?? $state);
$ship_postcode = trim($data['shipping_postcode'] ?? $postcode);


// CALCULATE TOTAL
$subtotal = 0;
$shipping_cost = 20;

foreach ($cart as $item) {
    $product = getByID($conn, 'products', $item['product_id']);
    if ($product) {
        $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
        $subtotal += $price * $item['qty'];
    }
}

$total = $subtotal + $shipping_cost;


// ADDRESS BUILD
$billing_address_full = $street;
if (!empty($suite)) $billing_address_full .= ", $suite";
$billing_address_full .= ", $suburb, $state $postcode";

$shipping_address_full = $ship_street;
if (!empty($ship_suite)) $shipping_address_full .= ", $ship_suite";
$shipping_address_full .= ", $ship_suburb, $ship_state $ship_postcode";


// INSERT ORDER
$stmt = $conn->prepare("INSERT INTO orders (
    user_id,
    fname,
    lname,
    company_name,
    email,
    phone,
    billing_address,
    state,
    postcode,
    shipping_fname,
    shipping_lname,
    shipping_company,
    shipping_street,
    shipping_suite,
    shipping_suburb,
    shipping_state,
    shipping_postcode,
    total,
    shipping_cost,
    order_notes
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "isssssssssssssssssds",
    $user_id,
    $fname,
    $lname,
    $company,
    $email,
    $phone,
    $billing_address_full,
    $state,
    $postcode,
    $ship_fname,
    $ship_lname,
    $ship_company,
    $ship_street,
    $ship_suite,
    $ship_suburb,
    $ship_state,
    $ship_postcode,
    $total,
    $shipping_cost,
    $order_notes
);

$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

// INSERT ORDER ITEMS
foreach ($cart as $item) {
    $product = getByID($conn, 'products', $item['product_id']);
    if (!$product) continue;

    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];

    $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, qty, paper_type, price) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("iiisd", $order_id, $item['product_id'], $item['qty'], $item['paper_type'], $price);
    $stmt2->execute();
    $stmt2->close();
}



// EMAIL BUILD
// Send Order Mail to Customer
$subject = "Order Confirmation - #{$order_id} | Shadows Photo Printing";

$product_rows = '';
foreach ($_SESSION['cart'] as $item) {
    $product = getByID($conn, 'products', $item['product_id']);
    if (!$product) continue;
    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
    $product_rows .= "
        <tr>
            <td style='border:1px solid #ddd; padding:8px;'>{$product['title']}</td>
            <td style='border:1px solid #ddd; padding:8px;'>{$item['qty']}</td>
            <td style='border:1px solid #ddd; padding:8px;'>$" . number_format($price, 2) . "</td>
        </tr>
    ";
}

$message = "
            <h2 style='color:#28a745;'>Your Order is Confirmed 🎉</h2>

            <p>Hi <strong>{$fname} {$lname}</strong>,</p>

            <p>Thank you for your order! We're excited to start processing it.</p>

            <hr>

            <h3>🧾 Order Details:</h3>
            <p><strong>Order ID:</strong> {$order_id}</p>
            <p><strong>Total Amount:</strong> $" . number_format($total, 2) . "</p>

            <hr>

            <h3>📦 Items Ordered:</h3>

            <table style='width:100%; border-collapse: collapse;'>
                <thead>
                    <tr style='background:#f5f5f5;'>
                        <th style='border:1px solid #ddd; padding:8px;'>Product</th>
                        <th style='border:1px solid #ddd; padding:8px;'>Qty</th>
                        <th style='border:1px solid #ddd; padding:8px;'>Price</th>
                    </tr>
                </thead>
                <tbody>
                    {$product_rows}
                </tbody>
            </table>

            <hr>

            <h3>📍 Billing Address:</h3>
            <p>{$billing_address_full}</p>

            <h3>🚚 Shipping Address:</h3>
            <p>{$shipping_address_full}</p>

            <hr>

            <p>We will notify you once your order is shipped.</p>

            <p>If you have any questions, feel free to contact us.</p>

            <br>

            <p>Best regards,<br>
            <strong>Shadows Photo Printing Team</strong></p>

            <p style='font-size:12px;color:gray;'>
            This is an automated email. Please do not reply directly.
            </p>
            ";

// Call sendMail() function to send the mail (To Customer)
sendEmail($email, $subject, $message);


// Send Order Mail to Admin
$adminEmail = "riturajmishra.avology@gmail.com";
$adminSubject = "New Order Received #" . $order_id;
$adminMessage = "
                <h2>New Order Received</h2>

                <p><strong>Customer:</strong> $fname $lname</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Total:</strong> $$total</p>
                <p><strong>Order ID:</strong> $order_id</p>
                ";
sendEmail($adminEmail, $adminSubject, $adminMessage);

// CLEAR SESSION
unset($_SESSION['cart']);
unset($_SESSION['cart_backup']);
unset($_SESSION['checkout_data']);

// REDIRECT
header("Location: order-received.php?order_id=" . $order_id);
exit();
