<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $appointment_id = $_GET['delete'];
    $sql = "DELETE FROM appointments WHERE id=$appointment_id";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Patient Name</th><th>Appointment Date</th><th>Reason</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["patient_name"] . "</td>";
        echo "<td>" . $row["appointment_date"] . "</td>";
        echo "<td>" . $row["reason"] . "</td>";
        echo "<td><a href='edit_appointment.php?id=" . $row["id"] . "'>Edit</a> | <a href='doctor_panel.php?delete=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No appointments found";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="doctor_panel.css">
</head>
<body>
    
</body>
</html>