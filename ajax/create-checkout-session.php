<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
include_once "../config/config.php";
include_once "../config/functions.php";

\Stripe\Stripe::setApiKey("sk_test_YOUR_SECRET_KEY_HERE"); 

// Save checkout data in session
$_SESSION['checkout_data'] = $_POST;
$_SESSION['cart_backup'] = $_SESSION['cart'];

// Calculate total
$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $product = getByID($conn, 'products', $item['product_id']);
    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
    $total += $price * $item['qty'];
}

$shipping = 20;
$total += $shipping;

// Stripe expects amount in cents
$total = $total * 100;

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'Order Payment',
            ],
            'unit_amount' => $total,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost/shadowsphotoprinting-main/order-success.php',
    'cancel_url' => 'http://localhost/shadowsphotoprinting-main/checkout.php',
]);

header("Location: " . $session->url);
exit();