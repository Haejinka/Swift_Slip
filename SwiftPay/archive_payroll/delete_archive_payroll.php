<?php
include '../connect.php';

// Check if the payroll_id parameter is set in the URL
if (isset($_GET['payroll_id'])) {
    $payroll_id = mysqli_real_escape_string($con, $_GET['payroll_id']);
    
    // Create the SQL query to delete the record
    $deleteQuery = "DELETE FROM archive_payroll WHERE payroll_id = '$payroll_id'";
    
    // Perform the deletion and check for success
    if (mysqli_query($con, $deleteQuery)) {
        // Deletion was successful
        header("Location: archive_payroll.php"); // Redirect back to your original page
        exit();
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Handle the case where payroll_id is not provided in the URL
    echo "Invalid request.";
}
?>
