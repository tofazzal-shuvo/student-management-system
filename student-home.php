<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
} else if ($_SESSION['role'] !== 'student') {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student home</title>
</head>

<body>
    <h2>student home</h2>
    <a href="logout.php">logout</a>
</body>

</html>