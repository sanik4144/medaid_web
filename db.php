<?php
$host = "localhost";      // usually localhost
$user = "root";           // your DB username
$pass = "Arifen 5284@#";               // your DB password (empty if default XAMPP)
$dbname = "user_system";  // your DB name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    echo("Connection failed: " . mysqli_connect_error());
}
else {
    echo "Connected successfully";
    // Uncomment the line below to see a success message
    // echo "Connected successfully";
}
?>
