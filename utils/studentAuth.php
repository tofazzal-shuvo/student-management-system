<?php
session_start();
if (!isset($_SESSION["email"]) || $_SESSION['role'] !== "student") {
    header('location:login.php');
}
