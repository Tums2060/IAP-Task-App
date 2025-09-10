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
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <h2>Sign Up</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>