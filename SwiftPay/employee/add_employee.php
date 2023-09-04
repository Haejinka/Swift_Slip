<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $hire_date = $_POST["hire_date"];
    $position_id = $_POST["position_id"];
    $department_id = $_POST["department_id"];
    $jobstatus_id = $_POST["jobstatus_id"];
    $password = $_POST["password"];
    $deduction_ids = $_POST["deduction_id"]; // New deduction field (assuming it's an array)

    // Use implode to join multiple deduction IDs into a comma-separated string
    $deduction_id = implode(',', $deduction_ids);

    // Perform the database insert operation
    $insertEmployeeQuery = "INSERT INTO employee (first_name, last_name, hire_date, position_id, department_id, jobstatus_id, password, deduction_id) VALUES ('$first_name', '$last_name', '$hire_date', '$position_id', '$department_id', '$jobstatus_id', '$password', '$deduction_id')";

    if (mysqli_query($con, $insertEmployeeQuery)) {
        // Redirect back to the employee list page
        header("Location: viewemployee.php");
        exit();
    } else {
        echo "Error inserting employee: " . mysqli_error($con);
    }
}
?>
