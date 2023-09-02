<?php
include '../connect.php';

if (isset($_GET['department_id'])) {
    $departmentId = $_GET['department_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM department WHERE department_id = $departmentId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: viewdepartment.php"); // Redirect back to the department list page
        exit();
    } else {
        echo "Error deleting department record: " . mysqli_error($con);
    }
}
?>
