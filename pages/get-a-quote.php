<?php
$page_title = "Contact Us";
include_once "../includes/header.php";
include_once "../config/config.php";
include_once "../config/mail.php";


$message_sent = false;

if (isset($_POST['submit_quote'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone_number'];
    $email = $_POST['email'];
    $requested_size = $_POST['requested'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contact (first_name, last_name, phone, email, requested_size, message) VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fname, $lname, $phone, $email, $requested_size, $message);

    if ($stmt->execute()) {
        $subject = "Your Quote Request Has Been Received – Shadows Photo Printing";
        $message_body = "
                    <h2 style='color:#333;'>Thank you for your request!</h2>

                    <p>Hi <strong>{$fname} {$lname}</strong>,</p>

                    <p>We have received your quote request successfully. Our team is currently reviewing your requirements and will get back to you shortly with a detailed quotation.</p>

                    <hr>

                    <h3>📌 Request Summary:</h3>
                    <p><strong>Size:</strong> {$requested_size}</p>

                    <hr>

                    <p>We aim to respond within <strong>24 hours</strong>.</p>

                    <p>If you have any urgent queries, feel free to contact us.</p>

                    <br>

                    <p>Best regards,<br>
                    <strong>Shadows Photo Printing Team</strong></p>

                    <p style='font-size:12px;color:gray;'>
                    This is an automated email. Please do not reply directly.
                    </p>
                    ";

        $message_sent = sendEmail($email, $subject, $message_body);
    } else {
        $error_db = "DB Error: " . $stmt->error;
    }
}
?>

<!-- Contact us -->
<section class="get-a-quote">
    <div class="container">
        <div class="contact-bnr-text">
            <h2>Get a Quote </h2>
        </div>
    </div>
</section>

<section class="get-quote">
    <div class="container">
        <div class="get-quote-inner">

            <?php if ($message_sent): ?>
                <div class="alert alert-success" style="color: green; background: #e0ffe0; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    Thank you! Your quote request has been submitted and a confirmation email has been sent.
                </div>
            <?php else: ?>
                <div class="alert alert-success" style="color: green; background: #e0ffe0; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    Email Failed
                </div>
            <?php endif; ?>

            <form id="myForm" action="" method="post">
                <div class="wrapper-latest">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-inner">
                                <label for="name">First Name</label>
                                <input type="text" id="name" name="fname" required placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-inner">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="lname" required placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper-latest">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-inner">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-inner">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" required placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper-latest">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-inner">
                                <label for="requested">Requested Size to be printed</label>
                                <input type="text" id="requested" name="requested" placeholder="For Example: 10x10">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper-latest">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-inner">
                                <label for="message">Message*</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-submit text-center">
                    <button type="submit" name="submit_quote" class="btn btn-dark">Get a Quote</button>
                </div>
            </form>
        </div>
    </div>
</section>


<?php include_once "../includes/footer.php"; ?>