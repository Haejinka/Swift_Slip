<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $positionId = $_POST['position_id'];
    $newPositionName = $_POST['position_name'];
    $newHourlyRate = $_POST['hourly_rate'];

    // Update the position using the input data
    $updateQuery = "UPDATE jobposition SET position_name = '$newPositionName', hourly_rate = $newHourlyRate WHERE position_id = $positionId";
    
    if (mysqli_query($con, $updateQuery)) {
        mysqli_close($con);
        header("Location: viewposition.php"); // Redirect back to your previous page
        exit;
    } else {
        // Handle error
        echo "Error updating position: " . mysqli_error($con);
    }
}
?>
