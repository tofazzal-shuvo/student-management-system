<?php
session_start();
if (!isset($_SESSION["email"]) || $_SESSION['role'] !== "admin") {
    header('location:login.php');
}
