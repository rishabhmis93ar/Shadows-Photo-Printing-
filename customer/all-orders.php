<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";
include_once "../includes/header.php";

// Login check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Logged-in user ke saare orders fetch karein (Latest first)
$query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
                <?php include_once "partials/sidebar.php"; ?>

                <div class="col-lg-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Orders </h2>
                            <div class="orders-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th> Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $order_id = $row['id'];

                                                $item_query = "SELECT SUM(qty) as total_items FROM order_items WHERE order_id = '$order_id'";
                                                $item_res = mysqli_query($conn, $item_query);
                                                $item_data = mysqli_fetch_assoc($item_res);
                                                $total_qty = $item_data['total_items'] ?? 0;

                                                $order_date = date("F j, Y", strtotime($row['created_at']));
                                        ?>
                                                <tr>
                                                    <td><a href="view-order.php?id=<?php echo $order_id; ?>" class="orders"> #<?php echo $order_id; ?></a></td>
                                                    <td> <?php echo $order_date; ?></td>
                                                    <td> <?php echo ucfirst($row['status'] ?? 'Processing'); ?></td>
                                                    <td><span>$<?php echo number_format($row['total'], 2); ?> for <?php echo $total_qty; ?> item(s) </span></td>
                                                    <td>
                                                        <div class="quanti">
                                                            <a href="view-order.php?id=<?php echo $order_id; ?>">View <i class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' style='text-align:center; padding:20px;'>No orders found yet. <a href='order-prints.php'>Start shopping!</a></td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="next-btn">
                                <div class="quanti">
                                    <a href="orders-2.php">Next </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "../includes/footer.php"; ?>