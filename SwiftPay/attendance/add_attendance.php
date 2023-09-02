<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];

    // Check if the employee ID exists in the employee table
    $checkEmployeeQuery = "SELECT * FROM employee WHERE employee_id = $employee_id";
    $checkEmployeeResult = mysqli_query($con, $checkEmployeeQuery);

    if (mysqli_num_rows($checkEmployeeResult) == 0) {
        echo "Employee does not exist.";
        exit(); // Stop further processing
    }

    // Insert the new attendance record into the database
    $insertQuery = "INSERT INTO attendance (employee_id, time_in, time_out) VALUES ('$employee_id', '$time_in', '$time_out')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header("Location: viewattendance.php"); // Redirect back to the attendance list
        exit();
    } else {
        echo "Error adding attendance: " . mysqli_error($con);
    }
}
?>