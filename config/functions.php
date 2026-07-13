<?php

function getAll($conn, $table)
{
    $sql = "SELECT * FROM $table ORDER BY id ASC";
    return mysqli_query($conn, $sql);
}

function deleteRecord($conn, $table, $id, $redirect)
{
    $id = intval($id);
    $sql = "DELETE FROM $table WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: $redirect?msg=deleted");
        exit;
    }
}

function getByID($conn, $table, $id)
{
    $id = intval($id);
    $sql = "SELECT * FROM $table WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function getAddress($conn, $user_id, $type)
{
    $query = "SELECT * FROM user_addresses WHERE user_id = '$user_id' AND address_type = '$type' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function insertRecord($conn, $table, $data)
{
    $columns = implode(", ", array_keys($data));
    $values  = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    return mysqli_query($conn, $sql);
}

// To get the all settings value like Shipping, GST dynamicallly 
function getSetting($conn, $key)
{
    $query = "SELECT setting_value FROM settings WHERE setting_key = '$key' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['setting_value'];
    }
    return 0;
}

// Function to Calculate Total Cart Amount
function calculateCartTotals($conn)
{
    $total = 0;
    $coupon_name = "";
    $discount = 0;

    //  Fetch Dynamic Settings
    $shipping = (float)getSetting($conn, 'shipping_cost');
    $gst_percentage = (float)getSetting($conn, 'gst_percentage'); // e.g., 10 or 15

    // Calculate Subtotal from Cart
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $product = getByID($conn, 'products', $item['product_id']);
            if (!$product) continue;

            $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['regular_price'];
            $total += ($price * $item['qty']);
        }
    }

    //  Apply Coupon Discount
    if (isset($_SESSION['applied_coupon'])) {
        $coupon_name = $_SESSION['applied_coupon']['code'];
        $c_type = $_SESSION['applied_coupon']['type'];
        $c_value = $_SESSION['applied_coupon']['value'];

        if ($c_type == 'fixed') {
            $discount = $c_value;
        } else {
            $discount = ($total * $c_value) / 100;
        }
    }

    // Calculate Taxable Amount (Subtotal + Shipping - Discount)
    $taxable_amount = max(0, ($total + $shipping) - $discount);

    //  Dynamic GST Calculation
    $gst_amount = ($taxable_amount * $gst_percentage) / 100;

    // Final Grand Total
    $final_grand_total = $taxable_amount + $gst_amount;

    // Returning all values
    return [
        'subtotal' => $total,
        'shipping' => $shipping,
        'discount' => $discount,
        'coupon_name' => $coupon_name,
        'gst_rate' => $gst_percentage,
        'gst_amount' => $gst_amount,
        'grand_total' => $final_grand_total
    ];
}

// To get the All coupons of a User
function getUserCoupons($conn, $user_id, $status)
{
    $query = "
        SELECT coupons.*
        FROM user_coupons
        JOIN coupons
        ON user_coupons.coupon_id = coupons.id
        WHERE user_coupons.user_id = '$user_id'
        AND user_coupons.status = '$status'
    ";

    $result = mysqli_query($conn, $query);

    $coupons = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $coupons[] = $row;
    }
    return $coupons;
}
