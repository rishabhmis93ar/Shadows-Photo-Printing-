<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// First check logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}

// Now check the role , if the role is not admin then don't give access
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    
    $_SESSION['status'] = "Access Denied! You are not an Admin.";

    header("Location: ../index.php");
    exit();
}
?>