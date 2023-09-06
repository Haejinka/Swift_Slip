<?php
include '../connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $deductionName = $_POST['deduction_name'];
    $deductionAmount = $_POST['deduction_amount'];
    $deductionMethod = $_POST['deduction_method']; // Added deduction method

    // Prepare the query based on deduction method
    if ($deductionMethod === 'percentage') {
        // If the deduction is percentage-based, divide the amount by 100
        $deductionAmount /= 100;
        $insertQuery = "INSERT INTO deductions (deduction_name, deduction_amount, deduction_method) VALUES ('$deductionName', $deductionAmount, 'percentage')";
    } elseif ($deductionMethod === 'fixed') {
        // If the deduction is fixed, no need to modify the amount
        $insertQuery = "INSERT INTO deductions (deduction_name, deduction_amount, deduction_method) VALUES ('$deductionName', $deductionAmount, 'fixed')";
    } else {
        echo "Invalid deduction method."; // Handle invalid deduction methods
        exit;
    }

    // Insert new deduction into the database
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header('Location: viewdeduction.php'); // Redirect to a page that lists deductions
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Send an error response
    }
}
?>
