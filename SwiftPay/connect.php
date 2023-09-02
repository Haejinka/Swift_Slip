<?php
// Database connection
$hostName = "mysql5048.site4now.net";
$hostUsername = "a9d9ab_payroll";
$hostPassword = "teamgroup4";
$hostDB = "db_a9d9ab_payroll"; //change this depending on you dbname

// Connect PHP file to database
$con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB) or die("Error in Database connection...");
?>