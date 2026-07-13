<?php
session_start();
include_once "../config/config.php";
include_once "../config/functions.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../log-out.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$type = isset($_GET['type']) ? strtolower(mysqli_real_escape_string($conn, $_GET['type'])) : 'billing';

$query = "SELECT * FROM user_addresses WHERE user_id = '$user_id' AND address_type = '$type' LIMIT 1";
$res = mysqli_query($conn, $query);
$address = mysqli_fetch_assoc($res);

if (isset($_POST['save_address'])) {

    $form_type = strtolower(mysqli_real_escape_string($conn, $_POST['address_type']));

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $suburb = mysqli_real_escape_string($conn, $_POST['suburb']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Checking that the address is already present or not
    $check = mysqli_query($conn, "SELECT id FROM user_addresses WHERE user_id = '$user_id' AND address_type = '$form_type'");

    if (mysqli_num_rows($check) > 0) {

        $sql = "UPDATE user_addresses 
                SET 
                first_name='$fname',
                last_name='$lname',
                company_name='$company', 
                street_address='$street',
                city='$suburb',
                state='$state', 
                postcode='$postcode',
                phone='$phone',
                email='$email' 
                WHERE user_id='$user_id' AND address_type='$form_type'";
    } else {

        $sql = "INSERT INTO user_addresses (user_id, address_type, first_name, last_name, company_name, street_address, city, state, postcode, phone, email) 
                VALUES (
                '$user_id',
                '$form_type',
                '$fname',
                '$lname',
                '$company',
                '$street',
                '$suburb',
                '$state',
                '$postcode',
                '$phone',
                '$email')";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: my-addresses.php?status=success");
        exit();
    }
}
include_once "../includes/header.php";
?>

<section class="account-page">
    <div class="container">
        <div class="account-wrapper">
            <div class="row">

                <?php include_once "partials/sidebar.php"; ?>

                <div class="col-md-9">
                    <div class="pangas-can">
                        <div class="endpointtitle">
                            <h2>Addresses
                            </h2>
                            <div class="notices-wrapper">
                                <form action="edit-address.php" method="POST">
                                    <input type="hidden" name="address_type" value="<?php echo $type; ?>">
                                    <h3><?php echo $_GET['type']; ?></h3>

                                    <div class="fields__field-wrapper">
                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="billing_first">
                                                        <label>First name * </label>
                                                        <input type="text" name="fname" value="<?php echo $address['first_name'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="billing_first">
                                                        <label>Last name * </label>
                                                        <input type="text" name="lname" value="<?php echo $address['last_name'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Company name (optional)</label>
                                                        <input type="text" name="company" value="<?php echo $address['company_name'] ?? ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Street address * </label>
                                                        <input type="text" name="street" value="<?php echo $address['street_address'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Suburb * </label>
                                                        <input type="text" name="suburb" value="<?php echo $address['city'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>State * </label>
                                                        <select name="state" id="SelExample" required>
                                                            <?php
                                                            $states = ["Australian Capital Territory", "Northern Territory", "Queensland", "South Australia", "New South Wales", "Tasmania", "Victoria", "Western Australia"];
                                                            foreach ($states as $s):
                                                                $selected = (isset($address['state']) && $address['state'] == $s) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?php echo $s; ?>" <?php echo $selected; ?>><?php echo $s; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Postcode * </label>
                                                        <input type="text" name="postcode" value="<?php echo $address['postcode'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Phone * </label>
                                                        <input type="text" name="phone" value="<?php echo $address['phone'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="billing_first">
                                                        <label>Email address * </label>
                                                        <input type="email" name="email" value="<?php echo $address['email'] ?? ''; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fields-inner">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="quanti">
                                                        <button type="submit" name="save_address" style="background: #16a085; color: white; border: none; padding: 10px 20px; cursor: pointer; font-family: inherit;">Save address</button>
                                                    </div>
                                                </div>
                                            </div>
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