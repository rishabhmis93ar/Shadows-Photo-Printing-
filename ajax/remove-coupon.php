<?php
session_start();
if (isset($_SESSION['applied_coupon'])) {
    unset($_SESSION['applied_coupon']);
    $_SESSION['message'] = "Coupon removed successfully.";
}
header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect to same page
exit();
?>