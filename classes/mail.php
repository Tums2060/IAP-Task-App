<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

class Mailer{
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host   =  'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'tumainiwamukota@gmail.com';
        $this->mail->Password = 'fiab afip pwmp ennm';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->setFrom('tumainiwamukota@gmail.com', 'Signup App');

    }

    public function sendMail($toEmail, $toName){
        try{
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->Subject = "Welcome to ICS2.2! Account Verification";
            $this->mail->Body = '
                        <p>Hello $toName, </p> <br><br>
                        <p>You requested an account on ICS2.2.</p> <br><br>
                        <p>In order to use this account you need to <a>Click here </a> to complete the registration process <br><br>
                        <p>Regards,</p><br>
                        <p>Systems Admin</p><br>
                        <p>ICS2.2</p>
                        ';
            $this->mail->send();
            return true;

        } catch (Exception $e){
            return "Mailer Error: ".$this->mail->ErrorInfo;
        }
    }
}



?>