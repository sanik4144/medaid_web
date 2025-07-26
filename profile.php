<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #dbeafe, #e0f2fe);
            margin: 0;
            margin-top: 30px;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        }

        .profile-box {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            background-color: #e0e7ff;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 50px;
            color: #4f46e5;
        }

        h2 {
            margin: 10px 0 5px;
            font-size: 24px;
            color: #1f2937;
        }

        .info-label {
            font-size: 14px;
            color: #6b7280;
        }

        .info-value {
            font-size: 16px;
            margin-bottom: 15px;
            color: #111827;
        }

        a.button {
            display: inline-block;
            margin: 5px;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #2563eb;
        }

        table tr td{
            padding: 10px;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['user_id'])) {
    $conn = new mysqli("localhost", "root", "", "project");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT `Full Name`, `Email` FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $email);

    if ($stmt->fetch()) {
        echo "<div class='profile-box'>";
        echo "<div class='profile-image'>👤</div>";
        echo "<h2>" . htmlspecialchars($name) . "</h2>";
        echo "<p class='info-value'>" . htmlspecialchars($email) . "</p>";
        echo "<a href='index.html' class='button'>Home</a>";
        echo "<a href='logout.php' class='button'>Logout</a>";
        echo "</div>";
    } else {
        echo "<div class='profile-box'><h2>User not found</h2></div>";
    }

    $stmt->close();

    // appointment info
    echo "<h3 style='text-align:center;'>My Appointments</h3>";

    $apptQuery = "SELECT * FROM appointment WHERE Email = ?";
    $apptStmt = $conn->prepare($apptQuery);
    $apptStmt->bind_param("s", $email);
    $apptStmt->execute();
    $apptResult = $apptStmt->get_result();

    if ($apptResult->num_rows > 0) {
        echo "<table border='1' style='margin:auto; margin-top:20px; border-collapse: collapse;'>
                <tr>
                    <th>Patient Name</th><th>DOB</th><th>Gender</th><th>Contact</th><th>Request</th>
                    <th>Specialty</th><th>Doctor</th><th>Date</th><th>Time</th><th>Actions</th>
                </tr>";

        while ($row = $apptResult->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Patient Name']}</td>
                    <td>{$row['Date of Birth']}</td>
                    <td>{$row['Gender']}</td>
                    <td>{$row['Contact Number']}</td>
                    <td>{$row['Request For']}</td>
                    <td>{$row['Specialty For Consultation']}</td>
                    <td>{$row['Doctor']}</td>
                    <td>{$row['Appointment Date']}</td>
                    <td>{$row['Appointment Time']}</td>
                    <td>
                        <a href='update_appointment.php?id={$row['id']}' class='button'>Update</a>
                        <a href='delete_appointment.php?id={$row['id']}' class='button' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No appointments found.</p>";
    }

    $apptStmt->close();
    $conn->close();
} else {
    echo "<div class='profile-box'>";
    echo "<div class='profile-image'>👤</div>";
    echo "<h2>You are not logged in!</h2>";
    echo "<a href='login.html' class='button'>Login</a> ";
    echo "<a href='signupform.html' class='button'>Sign Up</a>";
    echo "</div>";
}
?>


</body>
</html>
