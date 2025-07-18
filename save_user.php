<?php
include 'db.php'; // This should contain your $conn = new mysqli(...) connection

session_start();

if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['password'])) {
    // Sanitize input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<p>Email already registered. Please <a href='login.php'>login here</a>.</p>";
        exit();
    }

    // Insert new user into database
    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        // Get new user's ID and save to session
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['email'] = $email; // Optional

        // Redirect to profile page
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Please fill all required fields.";
}

mysqli_close($conn);
?>
