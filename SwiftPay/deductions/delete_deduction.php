<?php
include '../connect.php';

if (isset($_GET['deduction_id'])) {
    $deductionId = $_GET['deduction_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM deductions WHERE deduction_id = $deductionId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: viewdeduction.php"); // Redirect back to the deduction list page
        exit();
    } else {
        echo "Error deleting deduction record: " . mysqli_error($con);
    }
}
?>
