<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $deptName = $_POST['deptName'];

    // Insert new department into the database
    $insertQuery = "INSERT INTO department (department_name) VALUES ('$deptName')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header('Location: viewdepartment.php'); // Redirect back to department list page
        exit;
    } else {
        echo "Error adding department: " . mysqli_error($con);
    }
}
?>
