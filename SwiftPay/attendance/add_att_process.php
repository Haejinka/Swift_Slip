<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeID = $_POST['employee_id'];
    $checkInTime = $_POST['check_in_time'];
    $checkOutTime = $_POST['check_out_time'];

    $checkEmployeeQuery = "SELECT * FROM employee WHERE employee_id = $employeeID";
    $checkEmployeeResult = mysqli_query($con, $checkEmployeeQuery);

    if (mysqli_num_rows($checkEmployeeResult) == 0) {
        echo "<center>Employee does not exist.";
        exit(); // Stop further processing
    }

    // Calculate hours worked
    $startTime = strtotime($checkInTime);
    $endTime = strtotime($checkOutTime);
    $secondsWorked = $endTime - $startTime;
    $hoursWorked = $secondsWorked / 3600;

    // Use a prepared statement with parameter binding to insert attendance with hours worked
    $insertQuery = "INSERT INTO attendance (employee_id, time_in, time_out, hours_worked) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insertQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "issd", $employeeID, $checkInTime, $checkOutTime, $hoursWorked);

    // Execute the prepared statement
    $insertResult = mysqli_stmt_execute($stmt);

    if ($insertResult) {
        header("Location: employee_attendance.php"); // Redirect back to the attendance list
        exit();
    } else {
        echo "Error adding attendance: " . mysqli_error($con);
    }
}
?>