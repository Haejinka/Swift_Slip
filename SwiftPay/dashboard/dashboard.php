<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include '../nav/nav_bar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<body>

<div class="content p-4">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="welcome-box text-center p-4">
          <h1 class="mb-3">Welcome, <?php echo strtoupper($_SESSION['username']); ?>!</h1>
        </div>
      </div>
    </div>
  </div>
</div>





   

    
</body>
</html>