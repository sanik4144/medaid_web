<?php

    include 'connect.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirmPassword'];


    $query = "INSERT INTO users(`Full Name`, `Email`, `Password`, `Confirm Password`)
                VALUES('$name', '$email', '$pass', '$cpass')";

    $run = mysqli_query($con, $query);

    if(!$run){
        echo "Submission Failed!!!";
    }
    else{
        header("location: profile.php");
    }
?>