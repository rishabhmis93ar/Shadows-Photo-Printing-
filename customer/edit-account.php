<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";
include_once "../includes/header.php";

$page_title = "Account Details";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$status_msg = "";

// Fetch User Current Data
$user = getByID($conn, 'users', $user_id);

// Account Details Update Logic
if (isset($_POST['update_account'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $display_name = mysqli_real_escape_string($conn, $_POST['display_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];

    // Update Basic Info (Using new columns fname, lname)
    $update_query = "UPDATE users SET fname='$fname', lname='$lname', username='$display_name', email='$email' WHERE id='$user_id'";

    if (mysqli_query($conn, $update_query)) {
        $status_msg = "Account details updated successfully!";

        // Password Change Logic
        if (!empty($current_pass) && !empty($new_pass)) {
            if (password_verify($current_pass, $user['password'])) {
                $hashed_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE users SET password='$hashed_new_pass' WHERE id='$user_id'");
                $status_msg .= " Password changed.";
            } else {
                $status_msg = "Error: Current password incorrect.";
            }
        }
        // Refresh user data after update
        $user = getByID($conn, 'users', $user_id);
    }
}

// Profile Photo Upload Logic
if (isset($_POST['upload_photo'])) {
    $image = $_FILES['profile_image']['name'];
    $image_tmp = $_FILES['profile_image']['tmp_name'];
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $new_name = "user_" . $user_id . "_" . time() . "." . $extension;

    if (move_uploaded_file($image_tmp, "uploads/profile/" . $new_name)) {
        mysqli_query($conn, "UPDATE users SET image='$new_name' WHERE id='$user_id'");
        header("Location: edit-account.php?status=photo_updated");
        exit();
    }
}
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">
                
                <?php include_once "partials/sidebar.php"; ?>

                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Account details</h2>
                            <div class="notices-wrapper">
                                <?php if ($status_msg): ?>
                                    <p style="color: #16a085; font-weight: bold;"><?php echo $status_msg; ?></p>
                                <?php endif; ?>

                                <form action="edit-account.php" method="POST" class="account-details">
                                    <div class="fields__field-wrapper">
                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="billing_first">
                                                        <label>First name *</label>
                                                        <input type="text" name="fname" value="<?php echo $user['fname'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="billing_first">
                                                        <label>Last name *</label>
                                                        <input type="text" name="lname" value="<?php echo $user['lname'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Display name *</label>
                                                        <input type="text" name="display_name" value="<?php echo $user['username'] ?? ''; ?>" required>
                                                        <span><em>This name appears in reviews and account section.</em></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Email address *</label>
                                                        <input type="email" name="email" value="<?php echo $user['email'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <fieldset>
                                            <legend>Password change</legend>
                                            <div class="billing_first">
                                                <label>Current password</label>
                                                <input type="password" name="current_password">
                                            </div>
                                            <div class="billing_first">
                                                <label>New password</label>
                                                <input type="password" name="new_password">
                                            </div>
                                        </fieldset>

                                        <div class="quanti" style="margin-top: 20px;">
                                            <button type="submit" name="update_account" class="checkout-button button alt">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "../includes/footer.php"; ?>