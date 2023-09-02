<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deductionId = $_POST['deduction_id'];
    $deductionName = $_POST['deduction_name'];
    $deductionAmount = $_POST['deduction_amount'];

    // Update the database record without prepared statements (not recommended)
    $updateQuery = "UPDATE deductions SET deduction_name = '$deductionName', deduction_amount = '$deductionAmount' WHERE deduction_id = $deductionId";
    
    if (mysqli_query($con, $updateQuery)) {
        // Redirect back to the main page after editing
        header('Location: viewdeduction.php');
        exit();
    } else {
        // Handle database update error
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
