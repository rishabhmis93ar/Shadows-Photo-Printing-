<?php
session_start();
include_once "../config/config.php";

header('Content-Type: application/json');

if (isset($_POST['coupon_code'])) {
    $code = mysqli_real_escape_string($conn, $_POST['coupon_code']);

    $query = "SELECT * FROM coupons WHERE code = '$code' AND status = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $coupon = mysqli_fetch_assoc($result);
   
        $_SESSION['applied_coupon'] = [
            'code' => $coupon['code'],
            'type' => $coupon['type'],
            'value' => $coupon['value']
        ];
        
        echo json_encode(['success' => true, 'message' => 'Coupon applied successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid or expired coupon code.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No code provided.']);
}
exit();