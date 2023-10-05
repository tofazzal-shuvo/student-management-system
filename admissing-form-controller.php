<?php
// error_reporting(0);
session_start();
$host = 'localhost';
$user = 'root';
$passord = '';
$dbName = 'student_management';

$db = mysqli_connect($host, $user, $passord, $dbName);


if ($db === false) {
    die('Connection error');
}


if (isset($_POST['apply'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    echo $username;

    $sql_query = "INSERT INTO admission(username, email, phone, message) VALUES ('$username', '$email', '$phone', '$message')";
    $result = mysqli_query($db, $sql_query);

    if ($result) {
        echo 'Apply success';
        $_SESSION['message'] = 'Your application sent seccessfully.';
        header("location:index.php");
    } else {
        $_SESSION['message'] = 'Something went wrong.';
    }
}
