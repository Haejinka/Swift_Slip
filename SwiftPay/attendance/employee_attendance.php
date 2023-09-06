<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

date_default_timezone_set('Asia/Manila');
include '../connect.php';
include '../nav/employee_navbar.php';

$employeeID = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeID = $_POST['employee_id'];
    $currentDate = date('Y-m-d'); // Current date

    // Check if the employee is on leave
    $checkLeaveQuery = "SELECT jobstatus_name FROM employee e
                        JOIN jobstatus j ON e.jobstatus_id = j.jobstatus_id
                        WHERE e.employee_id = ?";

    $stmt = mysqli_prepare($con, $checkLeaveQuery);
    mysqli_stmt_bind_param($stmt, "i", $employeeID);
    mysqli_stmt_execute($stmt);
    $leaveResult = mysqli_stmt_get_result($stmt);

    if ($leaveRow = mysqli_fetch_assoc($leaveResult)) {
        $jobstatus_name = $leaveRow['jobstatus_name'];

        // Check if the employee is on leave (assuming 'On Leave' is the job status name)
        if ($jobstatus_name == 'On Leave') {
            echo '<script>alert("Employee is on leave and cannot make attendance.");
            window.location.href = "employee_attendance.php";
            </script>';
            exit();
        }
    }

    // Determine the day of the month
    $dayOfMonth = date('j');

    // Define the pay term boundaries (you can adjust these as needed)
    $firstHalfBoundary = 15; // Example: First half of the month ends on the 15th
    $secondHalfBoundary = 31; // Example: Second half of the month ends on the 31st

    $payTerm = '';

    if ($dayOfMonth <= $firstHalfBoundary) {
        $payTerm = 'First Half';
    } elseif ($dayOfMonth <= $secondHalfBoundary) {
        $payTerm = 'Second Half';
    } else {
        $payTerm = 'Out of Range';
    }

    if (isset($_POST['time_in'])) {
        // Check if the employee has already timed in today
        $existingTimeInQuery = "SELECT * FROM attendance WHERE employee_id = ? AND date = ?";
        $stmt = mysqli_prepare($con, $existingTimeInQuery);
        mysqli_stmt_bind_param($stmt, "is", $employeeID, $currentDate);
        mysqli_stmt_execute($stmt);
        $existingTimeInResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($existingTimeInResult) > 0) {
            echo '<script>alert("Employee has already timed in today.");</script>';
        } else {
            // Handle Time In button click
            $checkInTime = date('Y-m-d H:i:s'); // Current timestamp

            // Insert data into the database for Time In (include date and pay_term)
            $insertQuery = "INSERT INTO attendance (employee_id, time_in, date, pay_term) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($stmt, "isss", $employeeID, $checkInTime, $currentDate, $payTerm);
            $insertResult = mysqli_stmt_execute($stmt);

            if ($insertResult) {
                // Time In recorded successfully, display message
                echo '<script>alert("Time In recorded successfully for ' . $payTerm . ' pay term.");</script>';
            } else {
                echo "Error recording Time In.";
            }
        }
    } elseif (isset($_POST['time_out'])) {
        // Check if the employee has timed in today before allowing time out
        $existingTimeInQuery = "SELECT * FROM attendance WHERE employee_id = ? AND date = ?";
        $stmt = mysqli_prepare($con, $existingTimeInQuery);
        mysqli_stmt_bind_param($stmt, "is", $employeeID, $currentDate);
        mysqli_stmt_execute($stmt);
        $existingTimeInResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($existingTimeInResult) > 0) {
            // Handle Time Out button click
            $checkOutTime = date('Y-m-d H:i:s'); // Current timestamp

            // Update the existing record in the database for Time Out (include date)
            $updateQuery = "UPDATE attendance SET time_out = ? WHERE employee_id = ? AND date = ? AND time_out IS NULL";
            $stmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmt, "sss", $checkOutTime, $employeeID, $currentDate); // Use "sss" for DATETIME
            $updateResult = mysqli_stmt_execute($stmt);

            if ($updateResult) {
                // Time Out recorded successfully, display message
                echo '<script>alert("Time Out recorded successfully.");</script>';
            } else {
                echo "Error recording Time Out: " . mysqli_error($con);
            }
        } else {
            echo '<script>alert("Please Time In before timing out.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="employee_attendance_style.css">
    <title>Add Attendance</title>
    <script>
        // Function to disable the "Time Out" button if the employee has not timed in
        function disableTimeOutButton() {
            var timeInButton = document.getElementsByName('time_in')[0];
            var timeOutButton = document.getElementsByName('time_out')[0];

            if (timeInButton.disabled) {
                timeOutButton.disabled = true;
            } else {
                timeOutButton.disabled = false;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Add Attendance</h2>
            <form action="" method="post">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" id="employee_id" required>

                <label for="check_in_time">Check In Time:</label>
                <input type="hidden" id="check_in_time" name="check_in_time">
                <button type="submit" name="time_in" onclick="disableTimeOutButton()">Time In</button>

                <!-- For Time Out button -->
                <label for="check_out_time">Check Out Time:</label>
                <input type="hidden" id="check_out_time" name="check_out_time">
                <button type="submit" name="time_out">Time Out</button>
            </form>
        </div>
    </div>
</body>

</html>