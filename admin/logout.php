<?php
session_start();
$uid = $_SESSION['id'];
session_destroy();
require_once('../includes/connect.php');
// redirect user to login page
header('location:login.php');
?>