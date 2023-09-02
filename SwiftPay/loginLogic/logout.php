<?php
// Start session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the index.php page after logout
header("Location: ../index.php");
exit();
?>
