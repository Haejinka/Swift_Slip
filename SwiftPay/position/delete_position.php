<?php
include '../connect.php';

if (isset($_GET['position_id'])) {
    $positionId = $_GET['position_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM jobposition WHERE position_id = $positionId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: viewposition.php"); // Redirect back to the position list page
        exit();
    } else {
        echo "Error deleting position record: " . mysqli_error($con);
    }
}
?>
