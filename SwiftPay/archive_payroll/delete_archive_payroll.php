<?php
include '../connect.php';

if (isset($_GET['parc_id'])) {
    $parcId = $_GET['parc_id'];

    // Perform the delete query
    $deleteQuery = "DELETE FROM archive_payroll WHERE parc_id = $parcId";

    if (mysqli_query($con, $deleteQuery)) {
        header("Location: archive_payroll.php"); // Redirect back to the archived payroll list page
        exit();
    } else {
        echo "Error deleting archived payroll record: " . mysqli_error($con);
    }
}
?>
