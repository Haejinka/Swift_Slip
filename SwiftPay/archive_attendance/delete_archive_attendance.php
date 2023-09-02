<?php
include '../connect.php';

if (isset($_GET['attendance_id'])) {
    $attendanceId = $_GET['attendance_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM archive_attendance WHERE attendance_id = $attendanceId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: archive_attendance.php"); // Redirect back to the attendance list page
        exit();
    } else {
        echo "Error deleting attendance record: " . mysqli_error($con);
    }
}
?>
