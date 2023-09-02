<?php
// Include the database connection
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deductionId = $_POST['deduction_id'];
    $deductionName = $_POST['deduction_name'];

    // Update the status name in the database
    $query = "UPDATE jobstatus SET jobstatus_name = '$deductionName' WHERE jobstatus_id = $deductionId";
    
    if (mysqli_query($con, $query)) {
        header("Location: viewstatus.php"); // Redirect back to the job status list page
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con); // Send error response
    }
}
?>
