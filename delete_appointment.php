<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$id = $_GET['id'];
mysqli_query($con, "DELETE FROM appointment WHERE id = $id");
header("Location: profile.php");
exit();
?>
