<?php
include '../connect.php';

// Check if the attendance_id is provided in the URL
if (isset($_GET['attendance_id'])) {
    $attendance_id = $_GET['attendance_id'];

    // Fetch the attendance record to be archived
    $query = "SELECT * FROM attendance WHERE attendance_id = '$attendance_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $attendanceData = mysqli_fetch_assoc($result);

        // Insert the attendance record into the archive table
        $archiveQuery = "INSERT INTO archive_attendance (employee_id, time_in, time_out, hours_worked) VALUES ('{$attendanceData['employee_id']}', '{$attendanceData['time_in']}', '{$attendanceData['time_out']}', '{$attendanceData['hours_worked']}')";
        $archiveResult = mysqli_query($con, $archiveQuery);

        if ($archiveResult) {
            // Successfully archived, now delete from main attendance table
            $deleteQuery = "DELETE FROM attendance WHERE attendance_id = '$attendance_id'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            if ($deleteResult) {
                // Record archived and deleted successfully
                header("Location: viewattendance.php?");//redirect to the View Attendance
                exit();
            } else {
                //Error deleting records from attendance
               echo "ERROR DELETING RECORDS" . mysqli_error($con);
            }
        } else {
            //Error in archiving records
           echo "ERROR ARCHING RECORDS" . mysqli_error($con);
        }
    } else {
        // Attendance record not found
        echo "Attendance record not found" . mysqli_error($con);
    }
} 
?>