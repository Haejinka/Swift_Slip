<?php
session_start(); // Start or resume the session

if (!isset($_SESSION['username']) || !isset($_SESSION['user-type'])) {
    // User is not logged in, so redirect to index.php
    header("Location: ../index.php");
    exit();
} else if ($_SESSION['user-type'] != 'admin' && $_SESSION['user-type'] != 'secretary') {
    // User does not have the required user type, so redirect to index.php
    header("Location: ../index.php");
    exit();
}
?>