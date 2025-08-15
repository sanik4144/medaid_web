<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT `Email` FROM users WHERE id = $user_id");
$data = mysqli_fetch_assoc($query);
$email = $data['Email']; 

$name = $_POST['patientName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$requestFor = $_POST['requestFor'];
$speciality = $_POST['speciality'];
$doctor = $_POST['doctor'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];

$query2 = "INSERT INTO appointment(`Patient Name`, `Date of Birth`, `Gender`, `Contact Number`, `Email`, `Request For`, `Specialty For Consultation`, `Doctor`, `Appointment Date`, `Appointment Time`) 
VALUES ('$name', '$dob', '$gender', '$contact', '$email', '$requestFor', '$speciality', '$doctor', '$appointmentDate', '$appointmentTime')";

$run = mysqli_query($con, $query2);

    if(!$run){
        echo "Submission Failed!!!";
    }
    else{
        header("Location: profile.php");
    }

?>

