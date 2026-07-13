<?php include_once "../includes/header.php"; ?>

<section class="logoutpage">
    <div class="container">
        <div class="woocommerce-notices-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="customer_login">
                        <div class="woocommerce-form">
                            <h2>Login</h2>
                            <form action="login.php" method="post">
                                <div class="woocommerce-wrapper">
                                    <label for="user_name">Username or email address *</label>
                                    <input type="text" name="username" id="user_name">
                                </div>
                                <div class="woocommerce-wrapper">
                                    <label for="user_pass">Password*</label>
                                    <input type="password" name="password" id="user_pass">
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
                            <form action="register.php" method="post">
                                <div class="woocommerce-wrapper">
                                    <label for="username">Username *</label>
                                    <input type="text" name="username" id="username">
                                </div>
                                <div class="woocommerce-wrapper">
                                    <label for="email">Email address *</label>
                                    <input type="email" name="email" id="email">
                                </div>
                                <div class="woocommerce-wrapper">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" id="password">
                                </div>

                                <div class="woocommerce-wrapper">
                                    <p>Your personal data will be used to support your experience
                                        throughout
                                        this website, to manage access to your account, and for other
                                        purposes described in our <span class="privacy-text">privacy
                                            policy</span>.</p>
                                </div>
                                <div class="woocommerce-wrapper">
                                    <button type="submit" class="login-btn" name="register_user">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include_once "../includes/footer.php"; ?>