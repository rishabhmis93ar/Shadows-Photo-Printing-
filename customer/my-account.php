<?php
include_once "../includes/header.php";
include_once "../config/config.php";
include_once "../config/functions.php";
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
                <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>My Account</h2>
                            <p>
                                <?php
                                $userId = $_SESSION['user_id'];
                                $result = getByID($conn, 'users', $userId);
                                if($result) {
                                ?>
                                Hello <strong><?php echo $result['username']; ?></strong> (not <strong><?php echo $result['username']; ?></strong>?
                                <a href="<?php echo BASE_URL; ?>auth/logout.php">Log out</a>)
                                <?php }?>
                            </p>
                            <p> From your account dashboard you can view your <a href="all-orders.php">recent
                                    orders</a>, manage your <a href="my-addresses.php">shipping and billing addresses</a>, and
                                <a href="edit-account.php">edit your password and account details</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "../includes/footer.php"; ?>