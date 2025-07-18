<?php

    include 'connect.php';

    $name = $_POST['patientName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $requestFor = $_POST['requestFor'];
    $speciality = $_POST['speciality'];
    $doctor = $_POST['doctor'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];

    $query = "INSERT INTO appointment(`Patient Name`, `Date of Birth`, `Gender`, `Contact Number`, `Email`, `Request For`, `Specialty For Consultation`, `Doctor`, `Appointment Date`, `Appointment Time`) 
                        VALUES ('$name', '$dob', '$gender', '$contact', '$email', '$requestFor', '$speciality', '$doctor', '$appointmentDate', '$appointmentTime')";


    $run = mysqli_query($con, $query);

    if(!$run){
        echo "Submission Failed!!!";
    }
    else{
        echo "Submission Successfull!!!";<br><br>
        echo "Thank You, Mr. $name";
    }

?>