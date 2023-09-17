<?php
session_start(); // Start the session
include '../connect.php';

if (isset($_SESSION['username']) && isset($_SESSION['user-type'])) {
    if ($_SESSION['user-type'] == 'admin') {
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else if ($_SESSION['user-type'] == 'secretary') {
        header("Location: ../dashboard/employee_dashboard.php");
        exit();
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Check if the login was successful for admin
    if (mysqli_num_rows($resultAdmin) > 0) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["user-type"] = 'admin';

        // Redirect to admin dashboard
        header("Location: ../dashboard/dashboard.php");
        exit();
    }

    // Check if the login was successful for secretary
    if (mysqli_num_rows($resultEmployee) > 0) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["user-type"] = 'secretary';

        // Redirect to secretary dashboard
        header("Location: ../dashboard/employee_dashboard.php");
        exit();
    }

    // Login failed, redirect to index.php
    header("Location: ../index.php");
    exit();
}

// If no login attempt was made, stay on the login page
?>
