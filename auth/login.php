<?php
session_start();
include_once "../config/config.php";

if (isset($_POST['login'])) {

    $input = $_POST['username']; // email or username
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'] ?? 'user';
            $_SESSION['logged_in'] = true;

            unset($_SESSION['error']);

            if ($_SESSION['user_role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../index.php?login=success");
            }
            exit;

        } else {
            $_SESSION['error'] = "Invalid login credentials.";
            header("Location: ../index.php?login=failed");
            exit;
        }

    } else {
        $_SESSION['error'] = "Invalid login credentials.";
        header("Location: ../index.php?login=failed");
        exit;
    }
}
?>