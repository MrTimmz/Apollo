<?php
$to = 'apollocmsverify@gmail.com'; // Replace with your email address
$subject = 'Test Email';
$message = 'This is a test email sent using MailHog.';
$headers = 'From: apollocmsverify@gmail' . "\r\n" . // Replace with a valid sender address
           'Reply-To: apollocmsverify@gmail' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
} else {
    echo 'Email sending failed.';
}
?>
