<?php
include_once "../config/config.php";
include_once "../config/functions.php";

$message = "";

if (isset($_POST['register_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $check_user = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username' OR email = '$email'");
    
    if (mysqli_num_rows($check_user) > 0) {
        $row = mysqli_fetch_assoc($check_user);
        $message = "Username or Email already exists! Please try another one.";
        echo "<h4 style='color:red; text-align:center;'>" . $message . "</h4>";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../index.php?registration=success");
            exit(); 
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>