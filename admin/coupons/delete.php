<?php
session_start();
include_once "../../config/config.php";
include_once "../../config/functions.php";

// Check if Admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

//  Check if ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $coupon_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete Query
    $query = "DELETE FROM coupons WHERE id = '$coupon_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success Message
        $_SESSION['message'] = "Coupon deleted successfully!";
    } else {
        // Error Message
        $_SESSION['message'] = "Something went wrong. Could not delete coupon.";
    }

    // Redirect back to Coupons Table
    header("Location: ../tables.php");
    exit();

} else {
    header("Location: ../tables.php");
    exit();
}
?>