<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footerbase">
            <div class="footercredits">
                <p> © 2024 Shadows Photo Printing - WordPress Theme by <a href="#">Kadence WP</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<div class="login-popup">
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="woocommerce-notices-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="customer_login">
                                <div class="woocommerce-form">
                                    <h2>Login</h2>

                                    <?php if (isset($_SESSION['error'])): ?>
                                        <div style="color:red; margin-bottom:10px; text-align:center;">
                                            <?php
                                            echo $_SESSION['error'];
                                            unset($_SESSION['error']);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php include_once __DIR__ . "/../config/config.php"; ?>
                                    <form action="<?php echo BASE_URL; ?>auth/login.php" method="POST">
                                        <div class="woocommerce-wrapper">
                                            <label for="username-pop">Username or email address *</label>
                                            <input type="text" name="username" id="username-pop">
                                        </div>
                                        <div class="woocommerce-wrapper">
                                            <label for="username-pop">Password*</label>
                                            <input type="password" name="password" id="username-pop">
                                        </div>

                                        <div class="woocommerce-wrapper">
                                            <button type="submit" name="login" class="login-btn">Login</button>
                                        </div>
                                        <div class="woocommerce-wrapper">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </div>
                                        <p class="woocommerce-LostPassword lost_password">
                                            <a href="#">Lost your password?</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="customer_login">
                                <div class="woocommerce-form">
                                    <h2>Register
                                    </h2>
                                    <form action="<?php echo BASE_URL; ?>auth/register.php" method="post">
                                        <div class="woocommerce-wrapper">
                                            <label for="username-pop">Username *</label>
                                            <input type="text" name="username" id="username-pop" class="form-control" required>
                                        </div>

                                        <div class="woocommerce-wrapper">
                                            <label for="email-pop">Email address *</label>
                                            <input type="email" name="email" id="email-pop" class="form-control" required>
                                        </div>

                                        <div class="woocommerce-wrapper">
                                            <label for="password-pop">Password *</label>
                                            <input type="password" name="password" id="password-pop" class="form-control" required>
                                        </div>

                                        <div class="woocommerce-wrapper">
                                            <p>Your personal data will be used to support your experience
                                                throughout
                                                this website, to manage access to your account, and for other
                                                purposes described in our <span class="privacy-text">privacy
                                                    policy</span>.</p>
                                        </div>

                                        <div class="woocommerce-wrapper">
                                            <button type="submit" name="register_user" class="login-btn">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<a id="button"></a>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/slick.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/aos.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/custom.js"></script>

<script src="<?php echo BASE_URL; ?>includes/scripts.js"></script>   

</body>
</html>