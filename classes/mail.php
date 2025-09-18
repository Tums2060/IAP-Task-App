<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'tumainiwamukota@gmail.com';
        $this->mail->Password   = 'fiab afip pwmp ennm'; // App password
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
        $this->mail->setFrom('tumainiwamukota@gmail.com', 'Signup App');
    }

    public function send2FA($toEmail, $toName) {
        try {
            // Generate 6-digit random code
            $code = random_int(100000, 999999);

            $this->mail->clearAddresses();
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->Subject = "Your ICS2.2 2FA Verification Code";
            $this->mail->isHTML(true);

            $this->mail->Body = "
                <p>Hello {$toName},</p>
                <p>We received a request to verify your account on <strong>ICS2.2</strong>.</p>
                <p>Your <strong>2FA verification code</strong> is:</p>
                <h2 style='color:blue;'>{$code}</h2>
                <p>This code will expire in 10 minutes.</p>
                <br>
                <p>If you did not request this, please ignore this email.</p>
                <br>
                <p>Regards,</p>
                <p>Systems Admin</p>
                <p>ICS2.2</p>
            ";

            $this->mail->send();
            return true; // return the code so you can store/verify later

        } catch (Exception $e) {
            return "Mailer Error: " . $this->mail->ErrorInfo;
        }
    }

    public function sendNotification($toEmail){
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($toEmail);
            $this->mail->Subject = "Thank you for subscribing!";
            $this->mail->isHTML(true);

            $this->mail->Body = "
                <p>Hello, </p>
                <p>Thank you for subscribing to Tumaini's newsletter!</p>
                <p>I will keep you updated with the latest news and updates.</p>
                <br>
                <p>Regards,</p>
                <p>Tumaini Wamukota</p>
            ";

            $this->mail->send();
            return true;

        } catch (Exception $e) {
            return "Mailer Error: " . $this->mail->ErrorInfo;
        }
    }
}
