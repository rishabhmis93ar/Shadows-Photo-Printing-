<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['checkout_data'] = $_POST;
    $_SESSION['cart_backup'] = $_SESSION['cart'];
    echo json_encode(["status" => "success"]);
}
exit();
