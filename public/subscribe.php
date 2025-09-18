<?php
require_once __DIR__ . '/../classes/mail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notify_email'])) {
    $email = $_POST['notify_email'];

    $mailer = new Mailer();
    $result = $mailer->sendNotification($email);

    if ($result === true) {
        echo "Confirmation email sent to $email!";
    } else {
        echo "Error: $result";
    }
}
?>