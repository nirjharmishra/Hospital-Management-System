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
    $patientName = $_POST["patient_name"];
    $appointmentDate = $_POST["appointment_date"];
    $reason = $_POST["reason"];

    $sql = "INSERT INTO appointments (patient_name, appointment_date, reason) VALUES ('$patientName', '$appointmentDate', '$reason')";

    if ($conn->query($sql) === TRUE) {
        echo "New appointment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointment Form</title>
    <link rel="stylesheet" href="appointment.css">
</head>
<body>
    <div class="container">
        <h2>Patient Appointment Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <label for="reason">Reason for Appointment:</label>
            <textarea id="reason" name="reason" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>