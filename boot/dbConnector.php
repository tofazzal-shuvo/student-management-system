
<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "student_management";
$db = mysqli_connect($host, $user, $password, $db_name);

if ($db === false) {
    die("DB connection error.");
}
