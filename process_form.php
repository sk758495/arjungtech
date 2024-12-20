<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoload file (if using Composer)

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $details = htmlspecialchars(trim($_POST['details']));

    // Validate required fields
    if (empty($name) || empty($surname) || !$email || empty($details)) {
        die("All fields are required, and email must be valid.");
    }

    // Create a PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Email server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'arjuncableconverters@gmail.com'; // Your SMTP username
        $mail->Password = 'mtrlfujdiyxxryjz'; // Use your App Password here
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Use 587 for TLS

        // Sender and recipient settings
        $mail->setFrom($email, "$name $surname");
        $mail->addAddress('sk758495@gmail.com', 'Dhanji Bharwad'); // Your email address

        // Email content
        $mail->isHTML(true);
        $mail->addEmbeddedImage('assets/images/arjungtech-logo-removebg-preview.png', 'company_logo');
        $mail->Subject = 'New Contact Form Submission In Arjun G-tech';
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #333333;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    background-color: #f4f4f4;
                    width: 100%;
                    padding: 20px;
                    box-sizing: border-box;
                }
                .email-content {
                    background-color: #ffffff;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #2c3e50;
                    font-size: 24px;
                    margin-bottom: 20px;
                }
                .logo {
                    width: 150px;
                    margin-bottom: 20px;
                    text-align:center;
                    justify-content:center;
                }
                p {
                    font-size: 16px;
                    line-height: 1.5;
                    color: #555555;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 14px;
                    color: #999999;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-content'>
                    <!-- Company Logo -->
                    <img src='cid:company_logo' alt='Arjun G-tech Logo' class='logo'>
                    
                    <h2>New Form Submission</h2>
                    
                    <p><strong>Name:</strong> {$name}</p>
                    <p><strong>Surname:</strong> {$surname}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Details:</strong> {$details}</p>
                    
                    <div class='footer'>
                        <p>Thank you for reaching out to us! We will get back to you soon.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";

         // Send email
         $mail->send();

         // Redirect after success
     // Redirect with success status
     header("Location: index.php?status=success");
     exit();
 } catch (Exception $e) {
     // Redirect with error status
     header("Location: index.php?status=error");
     exit();
 }
} else {
 header("Location: index.php");
 exit();
}
?>
