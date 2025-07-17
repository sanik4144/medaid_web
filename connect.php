<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "project";

    $con = mysqli_connect($host, $user, $password, $db);
    
    if(!$con){
        echo "Connection Failed!";
    }
    else{
        echo "Connection Successfull!";
    }

?>