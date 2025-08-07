<?php
include 'connect.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill in both email and password.";
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password == $row['Password']) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                header("location: profile.php");
                exit();
            } else {
                echo "Password is incorrect!";
            }
        } else {
            echo "No user found with this email!";
        }
    }
}
?>
