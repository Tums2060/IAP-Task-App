<?php
include __DIR__ . '/..config/config.php';
require __DIR__ . '/../classes/mail.php';

session_start();

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()){
        if (password_verify($password, $user['password'])){
            // random code
            $code = rand(100000, 999999);

            $_SESSION['2fa_email'] = $email;
            $_SESSION['2fa_code'] = $code;

            $mailer = new Mailer();
            $mailer->sendMail($email, "Your login code is: $code");

            header("Location: verify.php");
            exit;
        } else{
            echo "Invalid Password";
        } 
        }else{
            echo "Email not found";
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
