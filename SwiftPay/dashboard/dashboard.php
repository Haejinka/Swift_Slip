<?php
// Start the session
session_start();

// Redirect to the login page if the user is not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Include necessary files
include '../nav/nav_bar.php';
include '../connect.php';

// Query to get the total number of employees
$employeequery = "SELECT COUNT(*) as count FROM employee";
$employeeresult = $con->query($employeequery);
$employeecount = $employeeresult->fetch_assoc();

// Query to get the total number of departments
$departmentquery = "SELECT COUNT(*) as count FROM department";
$departmentresult = $con->query($departmentquery);
$departmentcount = $departmentresult->fetch_assoc();

// Query to get the total number of active employees
$jobstatus_id = 3016; // Active job status ID
$employeequery1 = "SELECT COUNT(*) as count FROM employee WHERE jobstatus_id = $jobstatus_id";
$employeeresult1 = $con->query($employeequery1);
$employeecount1 = $employeeresult1->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="dashboard_style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <?php if (isset($_SESSION['username'])): ?>
                <h1 class="display-4">Welcome,
                    <?php echo strtoupper($_SESSION['username']); ?>!
                </h1>
            <?php else: ?>
                <h1 class="display-4">Welcome!</h1>
            <?php endif; ?>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <canvas id="employeeDonutChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-4x mb-3 text-success"></i>
                        <h3 class="card-title">Total Employees</h3>
                        <h4 class="card-text">
                            <?php echo $employeecount['count']; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-4x mb-3 text-warning"></i>
                        <h3 class="card-title">Total Departments</h3>
                        <h4 class="card-text">
                            <?php echo $departmentcount['count']; ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // Data for the donut chart
        var totalEmployees = <?php echo $employeecount['count']; ?>;
        var activeEmployees = <?php echo $employeecount1['count']; ?>;
        var inactiveEmployees = totalEmployees - activeEmployees;

        // Create a data object for the chart
        var data = {
            labels: ['Active Employees', 'Inactive Employees'],
            datasets: [{
                data: [activeEmployees, inactiveEmployees],
                backgroundColor: ['#FF5F1F', '#FF69B4'],
                hoverBackgroundColor: ['#FF5F1F', '#FF69B4']
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('employeeDonutChart').getContext('2d');

        // Create and render the donut chart
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data
        });
    </script>
</body>

</html>