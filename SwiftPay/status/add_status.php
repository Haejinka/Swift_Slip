<?php
include '../connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statusName = $_POST['status_name'];

    // Insert new job status into the database
    $insertQuery = "INSERT INTO jobstatus (jobstatus_name) VALUES ('$statusName')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header('Location: viewstatus.php'); // Redirect back to job status list page
        exit;
    } else {
        echo "Error adding job status: " . mysqli_error($con);
    }
}
?>
