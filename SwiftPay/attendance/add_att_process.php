<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $employee_id = $_POST["employee_id"];
    $date = $_POST["date"];
    $time_in = $_POST["time_in"];
    $time_out = $_POST["time_out"];

    // Calculate hours worked
    $hours_worked = (strtotime($time_out) - strtotime($time_in)) / 3600;

    // Calculate pay term based on the date
    $day_of_month = date("j", strtotime($date));
    $last_day_of_month = date("t", strtotime($date));
    
    if ($day_of_month <= 15 || ($day_of_month == $last_day_of_month && $day_of_month >= 16)) {
        $pay_term = "First Half";
    } else {
        $pay_term = "Second Half";
    }

    // SQL query to insert data into the attendance table
    $sql = "INSERT INTO `attendance` (`employee_id`, `date`, `pay_term`, `time_in`, `time_out`, `hours_worked`) 
            VALUES ('$employee_id', '$date', '$pay_term', '$time_in', '$time_out', '$hours_worked')";

    if (mysqli_query($con, $sql)) {
        // Redirect to employee_attendance.php
        header("Location: viewattendance.php");
        exit(); // Stop script execution to ensure the redirect works
    } else {
        echo "Error: " .mysqli_error($con);
    }
}
?>