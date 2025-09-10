<?php
session_start();

if (isset($_POST['verify'])){
    $code = $_POST['code'];

    if ($code == $_SESSION['2fa_code']){
        $_SESSION['logged_in'] = true;
        header("Location: success.php");
        exit;
    } else{
        echo "Invalid code.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Login</title>
</head>
<body>
    <h2>Enter Verification Code</h2>
    <form method="POST" action="">
        <input type="text" name="code" placeholder="6-digit code" required><br><br>
        <button type="submit" name="verify">Verify</button>
    </form>
</body>
</html>
