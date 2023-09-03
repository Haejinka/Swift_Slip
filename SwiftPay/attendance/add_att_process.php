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

    // Check if both check-in and check-out times are provided and not empty
    if (!empty($checkInTime) && !empty($checkOutTime)) {
        // Calculate hours worked
        $startTime = strtotime($checkInTime);
        $endTime = strtotime($checkOutTime);
        $secondsWorked = $endTime - $startTime;
        $hoursWorked = $secondsWorked / 3600;
    }

    // Use an UPDATE statement to set hours_worked directly
    $updateQuery = "UPDATE attendance SET hours_worked = ? WHERE employee_id = ? AND time_in = ?";
    $stmt = mysqli_prepare($con, $updateQuery);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "dis", $hoursWorked, $employeeID, $checkInTime);

    // Execute the prepared statement
    $updateResult = mysqli_stmt_execute($stmt);

    if ($updateResult) {
        header("Location: employee_attendance.php"); // Redirect back to the attendance list
        exit();
    } else {
        echo "Error updating attendance: " . mysqli_error($con);
    }
}
?>