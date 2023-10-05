
<?php
error_reporting(0);
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'student_management';
$db = mysqli_connect($host, $user, $password, $dbName);

if ($db === false) {
    die('db connection error');
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $sql_query = mysqli_query($db, $sql);
    $result = mysqli_fetch_array($sql_query);

    if ($result['role'] === 'student') {
        echo $result['role'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $result['role'];
        header('location:student-home.php');
    } else if ($result['role'] === 'admin') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $result['role'];
        header('location:admin-home.php');
    } else {
        echo 'Username or password not match.';
        $_SESSION['message'] = 'Username or password not match.';
        header('location:login.php');
    }
}
