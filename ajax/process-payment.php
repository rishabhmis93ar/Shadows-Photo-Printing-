<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

\Stripe\Stripe::setApiKey("sk_test_YOUR_SECRET_KEY_HERE");

header('Content-Type: application/json');

$payment_method_id = $_POST['payment_method_id'] ?? null;

if (!$payment_method_id) {
    echo json_encode(["error" => "Invalid Payment"]);
    exit();
}

include_once "../config/config.php";
include_once "../config/functions.php";

// Safety check
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo json_encode(["error" => "Cart is empty"]);
    exit();
}

// Calculate total
$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $product = getByID($conn, 'products', $item['product_id']);
    if (!$product) continue;

    $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
    $total += $price * $item['qty'];
}

$total += 20; // shipping
$total = $total * 100; // cents

try {

    $intent = \Stripe\PaymentIntent::create([
        'amount' => $total,
        'currency' => 'usd',
        'payment_method' => $payment_method_id,
        'confirm' => true,

        // NO confirmation_method
        'automatic_payment_methods' => [
            'enabled' => true,
            'allow_redirects' => 'never'
        ],
    ]);

    echo json_encode(["success" => true,]);
    exit();

} catch (Exception $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}