<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $patientName = $_POST['patient_name'];
    $appointmentDate = $_POST['appointment_date'];
    $reason = $_POST['reason'];

    $sql = "UPDATE appointments SET patient_name='$patientName', appointment_date='$appointmentDate', reason='$reason' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $sql = "SELECT * FROM appointments WHERE id=$appointment_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $patientName = $row['patient_name'];
        $appointmentDate = $row['appointment_date'];
        $reason = $row['reason'];
    } else {
        echo "No appointment found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="edit_appointment.css">
</head>
<body>
    <div class="container">
        <h2><center>Edit Appointment</center></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" value="<?php echo $patientName; ?>" required>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $appointmentDate; ?>" required>

            <label for="reason">Reason for Appointment:</label>
            <textarea id="reason" name="reason" required><?php echo $reason; ?></textarea>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>