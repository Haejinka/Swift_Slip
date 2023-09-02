<?php
include '../connect.php';  // Include your database connection file

if (isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];

    // Perform the delete operation (replace 'employee' with your actual table name)
    $deleteQuery = "DELETE FROM employee WHERE employee_id = $employeeId";

    if (mysqli_query($con, $deleteQuery)) {
        // Delete successful, you can redirect back to the employee list or handle it as needed
        header('Location: viewemployee.php');  // Replace with the actual URL of your employee list page
        exit();
    } else {
        // Delete failed, handle the error
        echo "Error deleting employee: " . mysqli_error($con);
    }
}
?>
