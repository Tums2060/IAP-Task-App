<?php

$host = "localhost";
$user = "dbadmin";
$password = "password";
$db = "signup_db";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>