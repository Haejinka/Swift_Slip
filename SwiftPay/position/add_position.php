<?php
include '../connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $positionName = $_POST['positionName'];
    $hourlyRate = $_POST['hourlyRate'];

    // Insert data into the jobposition table
    $query = "INSERT INTO jobposition (position_name, hourly_rate) VALUES ('$positionName', '$hourlyRate')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('Location: viewposition.php'); // Redirect to viewposition.php after successful insertion
        exit; // Make sure to exit after sending the header
    } else {
        echo "Error adding position: " . mysqli_error($con);
    }
}
?>
