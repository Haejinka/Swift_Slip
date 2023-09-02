<?php
include '../connect.php';

if (isset($_GET['jobstatus_id'])) {
    $jobStatusId = $_GET['jobstatus_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM jobstatus WHERE jobstatus_id = $jobStatusId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: viewstatus.php"); // Redirect back to the job status list page
        exit();
    } else {
        echo "Error deleting job status record: " . mysqli_error($con);
    }
}
?>
