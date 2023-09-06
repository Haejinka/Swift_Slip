<?php
// Database connection
$hostName = "localhost";
$hostUsername = "root";
$hostPassword = "";
$hostDB = "swiift_slip"; //change this depending on you dbname

// Connect PHP file to database
$con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB) or die("Error in Database connection...");
?>