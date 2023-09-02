<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar-custom {
      background-color: #0A1C44;
    }
    .logo-img {
  max-width: 50px; /* Adjust the max width to your desired value */
  height: auto; /* Automatically adjust the height to maintain aspect ratio */
}
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container">
  <a class="navbar-brand"><img src="../nav/nav_media/logo.png" alt="Logo" class="img-fluid logo-img" ></a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="../dashboard/dashboard.php">Home</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../employee/viewemployee.php">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../position/viewposition.php">Position</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../department/viewdepartment.php">Department</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../deductions/viewdeduction.php">Deductions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../status/viewstatus.php">Status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../attendance/viewattendance.php">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../archive_attendance/archive_attendance.php">Archive-Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../payroll/viewpayroll.php">Payroll</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="../archive_payroll/archive_payroll.php">Payroll-Archive</a>
        </li> 
      </ul>
    </div>
    <button class="btn btn-secondary ml-auto">
        <a href="../loginLogic/logout.php" style="text-decoration: none; color: white;">Logout</a>
    </button>
  </div>
</nav>

<!-- Include Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

