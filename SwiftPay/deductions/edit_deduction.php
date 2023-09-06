<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deductionId = $_POST['deduction_id'];
    $deductionName = $_POST['deduction_name'];
    $deductionAmount = $_POST['deduction_amount'];
    $deductionMethod = $_POST['deduction_method'];

    // If the deduction method is "percentage," convert the amount to a decimal
    if ($deductionMethod === 'percentage') {
        $deductionAmount /= 100; // Convert percentage to decimal
    }

    // Use prepared statements to update the database record
    $updateQuery = "UPDATE deductions SET deduction_name = ?, deduction_amount = ?, deduction_method = ? WHERE deduction_id = ?";
    
    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $updateQuery)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "sssi", $deductionName, $deductionAmount, $deductionMethod, $deductionId);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the main page after editing
            header('Location: viewdeduction.php');
            exit();
        } else {
            // Handle database update error
            echo "Error updating record: " . mysqli_error($con);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle prepared statement error
        echo "Error preparing statement: " . mysqli_error($con);
    }
}
?>
