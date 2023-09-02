<?php
include '../connect.php';

// Fetch all attendance records
$query = "SELECT * FROM attendance";
$result = mysqli_query($con, $query);

if ($result) {
    while ($attendanceData = mysqli_fetch_assoc($result)) {
        // Insert the attendance record into the archive table
        $archiveQuery = "INSERT INTO archive_attendance (employee_id, time_in, time_out, hours_worked) 
            VALUES ('{$attendanceData['employee_id']}', '{$attendanceData['time_in']}', '{$attendanceData['time_out']}', '{$attendanceData['hours_worked']}')";
        $archiveResult = mysqli_query($con, $archiveQuery);

        if ($archiveResult) {
            // Successfully archived, now delete from the main attendance table
            $deleteQuery = "DELETE FROM attendance WHERE attendance_id = '{$attendanceData['attendance_id']}'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            if (!$deleteResult) {
                // Error deleting records from attendance
                echo "Error deleting records: " . mysqli_error($con);
                exit();
            }
        } else {
            // Error in archiving records
            echo "Error archiving records: " . mysqli_error($con);
            exit();
        }
    }

    // All records archived and deleted successfully, redirect to a success page
    header("Location: viewattendance.php");
    exit();
} else {
    // Error fetching records from attendance
    echo "Error fetching records: " . mysqli_error($con);
}
?>