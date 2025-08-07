<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$userQuery = mysqli_query($con, "SELECT `Email` FROM users WHERE id = $user_id");
$userData = mysqli_fetch_assoc($userQuery);
$email = $userData['Email'];  // Get email from session-linked user

// Get form values
$name = $_POST['patientName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$requestFor = $_POST['requestFor'];
$speciality = $_POST['speciality'];
$doctor = $_POST['doctor'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];

// Insert into DB
$query = "INSERT INTO appointment(`Patient Name`, `Date of Birth`, `Gender`, `Contact Number`, `Email`, `Request For`, `Specialty For Consultation`, `Doctor`, `Appointment Date`, `Appointment Time`) 
VALUES ('$name', '$dob', '$gender', '$contact', '$email', '$requestFor', '$speciality', '$doctor', '$appointmentDate', '$appointmentTime')";

$run = mysqli_query($con, $query);

    if(!$run){
        echo "Submission Failed!!!";
    }
    else{
        echo "Submission Successfull!!!"; <br><br>
        echo "Thank You, Mr. $name";
    }

?>
