<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar_file'])) {
    $file = $_FILES['avatar_file'];
    
    if ($file['error'] === 0) {
        $filename = $file['name'];
        $tmp_name = $file['tmp_name'];
        
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (in_array($ext, $allowed)) {
            // Naya safe random file name
            $new_name = "avatar_" . $user_id . "_" . time() . "." . $ext;
            
            // PATH CORRECTION: file customer folder mein hai, isliye root ke assets ke liye '../' lagega
            $upload_destination = "../assets/images/" . $new_name;
            
            if (move_uploaded_file($tmp_name, $upload_destination)) {
                // DB statement create karein
                $stmt = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
                $stmt->bind_param("si", $new_name, $user_id);
                
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Profile picture updated successfully!";
                } else {
                    $_SESSION['message'] = "Database insertion failed.";
                }
                $stmt->close();
            } else {
                $_SESSION['message'] = "Failed to move file to destination folder.";
            }
        } else {
            $_SESSION['message'] = "Invalid file type. Only JPG, PNG and WEBP allowed.";
        }
    } else {
        $_SESSION['message'] = "Error occurred during file upload.";
    }
}

// Jis page se click kiya tha, wahi redirect karne ke liye fallback handling
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: my-account.php");
}
exit();
?>