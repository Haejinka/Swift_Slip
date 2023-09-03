<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $time_in = $_POST['time_in'];
    $time_out = $_POST['time_out'];

    // Check if the employee ID exists in the employee table using a prepared statement
    $checkEmployeeQuery = "SELECT * FROM employee WHERE employee_id = ?";
    $stmt = mysqli_prepare($con, $checkEmployeeQuery);

    // Bind the employee_id parameter
    mysqli_stmt_bind_param($stmt, "i", $employee_id);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $checkEmployeeResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkEmployeeResult) == 0) {
        echo "Employee does not exist.";
        exit(); // Stop further processing
    }

    // Initialize hours worked to 0
    $hours_worked = 0;

    // Check if both "time_in" and "time_out" are not empty
    if (!empty($time_in) && !empty($time_out)) {
        // Calculate hours worked
        $start_time = strtotime($time_in);
        $end_time = strtotime($time_out);
        $seconds_worked = $end_time - $start_time;
        $hours_worked = $seconds_worked / 3600;
    }

    // Insert the new attendance record into the database along with hours_worked using a prepared statement
    $insertQuery = "INSERT INTO attendance (employee_id, time_in, time_out, hours_worked) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $insertQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "issd", $employee_id, $time_in, $time_out, $hours_worked);

    // Execute the prepared statement
    $insertResult = mysqli_stmt_execute($stmt);

    if ($insertResult) {
        header("Location: viewattendance.php"); // Redirect back to the attendance list
        exit();
    } else {
        echo "Error adding attendance: " . mysqli_error($con);
    }
}
?>