<?php
session_start();
include_once "../../config/config.php";
include_once "../../config/functions.php";

// Check if Admin is logged in (Security)
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if ID is provided in URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $order_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Professional Approach: Transaction use karein taaki dono tables se data sahi se delete ho
    mysqli_begin_transaction($conn);

    try {
        // Pehle 'order_items' table se saare products delete karein jo is order se jude hain
        $delete_items = "DELETE FROM order_items WHERE order_id = '$order_id'";
        mysqli_query($conn, $delete_items);

        // Phir main 'orders' table se order delete karein
        $delete_order = "DELETE FROM orders WHERE id = '$order_id'";
        mysqli_query($conn, $delete_order);

        // Agar dono query sahi chali toh database mein changes save karein
        mysqli_commit($conn);

        $_SESSION['message'] = "Order #$order_id deleted successfully!";
        header("Location: ../tables.php"); // Wapas table page par bhej dein
        exit();

    } catch (Exception $e) {
        // Agar koi error aaye toh rollback karein (kuch bhi delete nahi hoga)
        mysqli_rollback($conn);
        $_SESSION['message'] = "Error: Could not delete order.";
        header("Location: ../tables.php");
        exit();
    }
} else {
    // Agar ID nahi mili toh redirect
    header("Location: ../tables.php");
    exit();
}
?>