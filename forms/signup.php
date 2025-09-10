<?php
include __DIR__ . '/../config/config.php';
require __DIR__ . '/../classes/mail.php';

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validating email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Invalid email format");
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "Sign up successful";

        $mailer = new Mailer();
        $result = $mailer->sendMail($email, $name);

        if ($result === true){
            echo "Email sent";
        } else{
            echo $result;
        }
    } else {
        echo "Error: ".$conn->error;
    }
}


?>

