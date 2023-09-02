<?php
include '../connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $deductionName = $_POST['deduction_name'];
    $deductionAmount = $_POST['deduction_amount'];

    // Divide the deduction amount by 100
    $deductionAmount /= 100;

    // Insert new deduction into the database
    $insertQuery = "INSERT INTO deductions (deduction_name, deduction_amount) VALUES ('$deductionName', $deductionAmount)";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header('Location: viewdeduction.php'); // Redirect to a page that lists deductions
        exit;
    } else {
        echo "Error: " . mysqli_error($con); // Send an error response
    }
}
?>
