<?php
session_start();
include_once "../config/config.php";

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* =========================
   Add to Cart (AJAX)
========================= */
if (isset($_POST['add_to_cart']) || isset($_POST['update_cart_btn'])) {
    unset($_SESSION['applied_coupon']); // Cart badalte hi purana coupon khatam
}


if (isset($_POST['add_to_cart'])) {

    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;
    $paper_type = isset($_POST['paper_type']) ? htmlspecialchars($_POST['paper_type']) : 'Default';

    // Validation
    if ($product_id <= 0 || $qty <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        exit();
    }

    $found = false;

    // Check if same product + same paper type exists
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['product_id'] == $product_id && $item['paper_type'] == $paper_type) {
            $_SESSION['cart'][$key]['qty'] += $qty;
            $found = true;
            break;
        }
    }

    // If not found → add new item
    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'qty' => $qty,
            'paper_type' => $paper_type
        ];
    }

    // Calculate total quantity count
    $cart_count = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['qty'];
    }

    echo json_encode([
        'status' => 'success',
        'cart_count' => $cart_count,
        'message' => 'Product added successfully'
    ]);
    exit();
}


/* =========================
   Remove Item
========================= */
if (isset($_GET['remove_id'])) {

    $remove_key = (int)$_GET['remove_id'];

    if (isset($_SESSION['cart'][$remove_key])) {
        unset($_SESSION['cart'][$remove_key]);

        // Reindex array
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        $_SESSION['message'] = "Item removed from cart";
    }

    header("Location: ../shop/cart.php");
    exit();
}


/* =========================
   Update Cart
========================= */
if (isset($_POST['update_cart_btn'])) {

    if (isset($_POST['qty']) && is_array($_POST['qty'])) {

        foreach ($_POST['qty'] as $key => $new_qty) {

            $new_qty = (int)$new_qty;

            if (isset($_SESSION['cart'][$key])) {

                if ($new_qty > 0) {
                    $_SESSION['cart'][$key]['qty'] = $new_qty;
                } else {
                    // Remove item if qty = 0
                    unset($_SESSION['cart'][$key]);
                }
            }
        }

        // Reindex after update/remove
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        $_SESSION['message'] = "Cart updated successfully";
    }

    header("Location: ../shop/cart.php");
    exit();
}


/* =========================
   Default Response
========================= */
echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
exit();
?>