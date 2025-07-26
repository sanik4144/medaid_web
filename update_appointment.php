<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid appointment ID.";
    exit();
}

$result = mysqli_query($con, "SELECT * FROM appointment WHERE id = $id");
if (!$result || mysqli_num_rows($result) === 0) {
    echo "Appointment not found.";
    exit();
}
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['patientName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $requestFor = $_POST['requestFor'];
    $speciality = $_POST['speciality'];
    $doctor = $_POST['doctor'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];

    $query = "UPDATE appointment SET 
        `Patient Name`='$name', 
        `Date of Birth`='$dob', 
        `Gender`='$gender', 
        `Contact Number`='$contact', 
        `Request For`='$requestFor', 
        `Specialty For Consultation`='$speciality', 
        `Doctor`='$doctor', 
        `Appointment Date`='$appointmentDate', 
        `Appointment Time`='$appointmentTime' 
        WHERE id=$id";

    if (mysqli_query($con, $query)) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Failed to update appointment.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            padding: 40px;
            font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        }

        .form-container {
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 10px;
            background-color: #0077cc;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update Appointment</h2>
        <form method="post">
            <label>Patient Name</label>
            <input type="text" name="patientName" value="<?= htmlspecialchars($data['Patient Name']) ?>">

            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?= htmlspecialchars($data['Date of Birth']) ?>">

            <label>Gender</label>
            <select name="gender">
                <option <?= $data['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                <option <?= $data['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option <?= $data['Gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>

            <label>Contact Number</label>
            <input type="text" name="contact" value="<?= htmlspecialchars($data['Contact Number']) ?>">

            <label>Request For</label>
            <select name="requestFor">
                <?php
                $options = ['Outpatient Consultation', 'Investigation', 'Health Check Package', 'Other'];
                foreach ($options as $opt) {
                    $selected = $data['Request For'] == $opt ? 'selected' : '';
                    echo "<option $selected>$opt</option>";
                }
                ?>
            </select>

            <label>Specialty For Consultation</label>
            <select name="speciality">
                <?php
                $specialties = ['Cardiology', 'Dermatology', 'Neurology', 'Orthopedics', 'Pediatrics',
                                'Psychiatry', 'General Medicine', 'Gynecology', 'Ophthalmology',
                                'ENT', 'Urology', 'Gastroenterology', 'ICU'];
                foreach ($specialties as $spec) {
                    $selected = $data['Specialty For Consultation'] == $spec ? 'selected' : '';
                    echo "<option $selected>$spec</option>";
                }
                ?>
            </select>

            <label>Doctor</label>
            <select name="doctor">
                <?php
                $doctors = ['Dr. Istaque Ahmed Milton', 'Prof. Mir Jamal Uddin', 'Dr. Md. Mahmudul Hasan',
                            'Dr. Md. Afzarul Rahman', 'Dr. Md. Kalam Hossion', 'Prof. Dr. Md. Khaled Hasan'];
                foreach ($doctors as $doc) {
                    $selected = $data['Doctor'] == $doc ? 'selected' : '';
                    echo "<option $selected>$doc</option>";
                }
                ?>
            </select>

            <label>Appointment Date</label>
            <input type="date" name="appointmentDate" value="<?= htmlspecialchars($data['Appointment Date']) ?>">

            <label>Appointment Time</label>
            <input type="time" name="appointmentTime" value="<?= htmlspecialchars($data['Appointment Time']) ?>">

            <button type="submit">Update Appointment</button>
        </form>
    </div>
</body>
</html>
