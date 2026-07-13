<?php include_once "../includes/header.php"; ?>

        <section class="account-page">
            <div class="container">
                <div class="account-wrapper">
                    <div class="row">

                        <?php include_once "partials/sidebar.php"; ?>

                        <div class="col-md-9">
                            <div class="pangas-can">
                                <div class="endpointtitle">
                                    <h2>Add payment method </h2>
                                    <div class="notices-wrapper">
                                        <form action="add-payment-method">
                                            <div class="payment">
                                                <ul>
                                                    <li>
                                                        <input type="radio" checked="checked" name="payment-methods">
                                                        <label for="payment_method_stripe">Credit Card (Stripe) </label>
                                                        <div class="Paymentbox">
                                                            <div class="stripe-payment">
                                                                <p>Pay with your credit card via Stripe.</p>
                                                                <fieldset class="credit-card-form">
                                                                    <div class="form-row-wide">
                                                                        <label for="">Card Number*</label>
                                                                        <div class="stripe-card-group">
                                                                            <input type="text"
                                                                                placeholder="1234 1234 1234 1234">
                                                                            <span> <i
                                                                                    class="fa-solid fa-credit-card"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row-first">
                                                                        <div class="form-row-wide">
                                                                            <label for=""> Expiry Date *</label>
                                                                            <div class="stripe-card-group">
                                                                                <input type="text" placeholder="MM / YY">
                                                                                <span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row-wide">
                                                                            <label for="">Card Code (CVC) *</label>
                                                                            <div class="stripe-card-group">
                                                                                <input type="text" placeholder="CVC">
                                                                                <span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="quanti">
                                        <button type="button">Add payment method</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include_once "../includes/footer.php"; ?>