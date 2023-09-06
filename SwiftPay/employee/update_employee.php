<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employee_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $hireDate = $_POST['hire_date'];
    $positionId = $_POST['position_id'];
    $departmentId = $_POST['department_id'];
    $jobStatusId = $_POST['jobstatus_id'];
    $deductionIds = $_POST['deduction_id']; // Updated to an array

    // Convert the array of deduction IDs to a comma-separated string
    $deductionId = implode(',', $deductionIds);

    // Update the database
    $updateQuery = "UPDATE employee SET first_name = '$firstName', last_name = '$lastName', hire_date = '$hireDate', position_id = $positionId, department_id = $departmentId, jobstatus_id = $jobStatusId, deduction_id = '$deductionId' WHERE employee_id = $employeeId";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Redirect back to the viewemployee.php page
        header("Location: viewemployee.php");
        exit(); // Important: Terminate the script to ensure immediate redirection
    } else {
        echo "Error updating employee information: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
