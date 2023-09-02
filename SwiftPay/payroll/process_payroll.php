<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employee_id'];
    $payTerm = $_POST['pay_term'];  // Changed from $_POST['pay_date']
    $deductionId = $_POST['deduction_id'];

    // Check if employee_id exists in employee table
    $employeeCheckQuery = "SELECT COUNT(*) as count FROM employee WHERE employee_id = '$employeeId'";
    $employeeCheckResult = mysqli_query($con, $employeeCheckQuery);
    $employeeExists = mysqli_fetch_assoc($employeeCheckResult)['count'];

    // Check if deduction_id exists in deductions table
    $deductionCheckQuery = "SELECT COUNT(*) as count FROM deductions WHERE deduction_id = '$deductionId'";
    $deductionCheckResult = mysqli_query($con, $deductionCheckQuery);
    $deductionExists = mysqli_fetch_assoc($deductionCheckResult)['count'];

    if ($employeeExists && $deductionExists) {
        // Both employee_id and deduction_id exist, so insert the new payroll record
        $insertQuery = "INSERT INTO payroll (employee_id, pay_term, deduction_id) VALUES ('$employeeId', '$payTerm', '$deductionId')";
        $insertResult = mysqli_query($con, $insertQuery);

        if ($insertResult) {
            header("Location: viewpayroll.php"); // Redirect back to the payroll list
            exit();
        } else {
            echo "Error adding payroll: " . mysqli_error($con);
        }
    } else {
        echo "Employee ID or Deduction ID does not exist.";
    }
}
?>
