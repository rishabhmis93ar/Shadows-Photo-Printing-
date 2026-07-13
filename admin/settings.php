<?php
$title = "General Settings";
include_once "../config/config.php";
include_once "../config/functions.php";
include_once "includes/header.php";

// Update Logic
if (isset($_POST['update_settings'])) {
    foreach ($_POST['settings'] as $key => $value) {
        $key = mysqli_real_escape_string($conn, $key);
        $value = mysqli_real_escape_string($conn, $value);

        // Update query
        mysqli_query($conn, "UPDATE settings SET setting_value = '$value' WHERE setting_key = '$key'");
    }
    echo "<script>alert('Settings Updated Successfully!'); window.location.href='settings.php';</script>";
}

// Current Values fetch karein
$shipping = getSetting($conn, 'shipping_cost');
$gst = getSetting($conn, 'gst_percentage');

include_once "includes/navbar.php";
include_once "includes/sidebar.php";
?>


<body class="g-sidenav-show bg-gray-200">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Store Settings (Shipping & Tax)</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pb-2">
                            <form role="form" method="POST">

                                <div class="mb-4">
                                    <label class="form-label font-weight-bold">Flat Shipping Cost ($)</label>
                                    <div class="input-group input-group-outline is-filled">
                                        <input type="number" step="0.01" name="settings[shipping_cost]" value="<?php echo $shipping; ?>" class="form-control" required>
                                    </div>
                                    <small class="text-secondary">This amount will be added to every order.</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label font-weight-bold">GST Percentage (%)</label>
                                    <div class="input-group input-group-outline is-filled">
                                        <input type="number" step="0.1" name="settings[gst_percentage]" value="<?php echo $gst; ?>" class="form-control" required>
                                    </div>
                                    <small class="text-secondary">Tax calculated on (Subtotal + Shipping - Discount).</small>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="update_settings" class="btn bg-gradient-dark w-100 my-4 mb-2">Save Settings</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>