<?php
session_start(); // Start the session
include '../connect.php';

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    $sqlAdmin = "SELECT * FROM admin WHERE BINARY userAdmin = ? AND BINARY passAdmin = ?";
    $sqlEmployee = "SELECT * FROM employee WHERE BINARY employee_id = ? AND BINARY password = ?";

    $stmtAdmin = mysqli_prepare($con, $sqlAdmin);
    $stmtEmployee = mysqli_prepare($con, $sqlEmployee);

    mysqli_stmt_bind_param($stmtAdmin, "ss", $username, $password);
    mysqli_stmt_bind_param($stmtEmployee, "ss", $username, $password);

    mysqli_stmt_execute($stmtAdmin);
    $resultAdmin = mysqli_stmt_get_result($stmtAdmin);

    mysqli_stmt_execute($stmtEmployee);
    $resultEmployee = mysqli_stmt_get_result($stmtEmployee);

    if (!$resultAdmin || !$resultEmployee) {
        //check if executing query has an error
        echo "Error executing query";
    } else {
        if (mysqli_num_rows($resultAdmin)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;

            // Redirect to admin dashboard
            header("Location: ../dashboard/dashboard.php");
            exit();
        } else if (mysqli_num_rows($resultEmployee)) {
            $_SESSION['username'] = $username;
            $_SESSION['user-type'] = 'secretary';
            //page directory for employee  
            header("Location: ../dashboard/employee_dashboard.php");
            exit();
        } else {
            header("Location: ../index.php");
        }
    }
    // Close the statements
    mysqli_stmt_close($stmtAdmin);
    mysqli_stmt_close($stmtEmployee);
}

// Your validate function here


// Check if the user is already logged in
if (isset($_SESSION['username']) && isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'admin') {
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else if ($_SESSION['user_type'] == 'secretary') {
        header("Location: ../dashboard/employee_dashboard.php");
        exit();
    }
}
?>