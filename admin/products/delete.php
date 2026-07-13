<?php
include_once "../../config/config.php";
include_once "../../config/functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product_query = mysqli_query($conn, "SELECT category_id FROM products WHERE id = '$id'");
    $product_data = mysqli_fetch_assoc($product_query);

    if ($product_data) {
        $category_id = $product_data['category_id'];

        $delete_query = "DELETE FROM products WHERE id = '$id'";
        
        if (mysqli_query($conn, $delete_query)) {

            $update_count_query = "UPDATE category SET product_count = product_count - 1 WHERE id = '$category_id'";
            mysqli_query($conn, $update_count_query);

            header("Location: ../tables.php?msg=deleted");
            exit;
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Product not found.";
    }
} else {
    header("Location: ../tables.php");
    exit;
}
?>