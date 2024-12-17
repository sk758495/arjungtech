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
        $mail->Username = 'sk758495@gmail.com'; // Your SMTP username
        $mail->Password = 'xqikzqodohxrldkr'; // Use your App Password here
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Use 587 for TLS

        // Sender and recipient settings
        $mail->setFrom($email, "$name $surname");
        $mail->addAddress('sk758495@gmail.com', 'Dhanji Bharwad'); // Your email address

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission In Arjun G-tech';
        $mail->Body    = "
            <h2>New Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Surname:</strong> {$surname}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Details:</strong> {$details}</p>
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
