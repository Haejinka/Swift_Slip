<?php
include '../nav/nav_bar.php';
include '../connect.php';

// Check if the search parameter is provided in the URL
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = mysqli_real_escape_string($con, $search); // Sanitize input
    $search_query = " AND (p.payroll_id LIKE '%$search%' OR p.employee_id LIKE '%$search%' OR p.pay_term LIKE '%$search%')";
} else {
    $search_query = "";
}

// Create a SELECT query to calculate total_percentage_deduction and total_fixed_deduction
$selectQuery = "
    SELECT
        p.*,
        SUM(CASE WHEN d.deduction_method = 'percentage' THEN d.deduction_amount ELSE 0 END) AS total_percentage_deduction,
        SUM(CASE WHEN d.deduction_method = 'fixed' THEN d.deduction_amount ELSE 0 END) AS total_fixed_deduction
    FROM payroll p
    LEFT JOIN employee e ON p.employee_id = e.employee_id
    LEFT JOIN deductions d ON FIND_IN_SET(d.deduction_id, e.deduction_id)
    WHERE 1 $search_query
    GROUP BY p.payroll_id
";

$result = mysqli_query($con, $selectQuery);

// Update the payroll table with the calculated values
while ($row = mysqli_fetch_assoc($result)) {
    $payrollId = $row['payroll_id'];
    $totalPercentageDeduction = $row['total_percentage_deduction'];
    $totalFixedDeduction = $row['total_fixed_deduction'];

    // Update the payroll table with the calculated values
    $updateQuery = "
        UPDATE payroll
        SET total_deduct_p = '$totalPercentageDeduction',
            total_deduct_f = '$totalFixedDeduction'
        WHERE payroll_id = '$payrollId'
    ";

    // Execute the update query
    mysqli_query($con, $updateQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWIFT SLIP</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Payroll List</h1>
        </div>
        <div class="col-md-5">
            <div class="d-flex">
                <form class="flex-grow-1" method="GET" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search payroll">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addPayrollModal">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <form action="generate_payroll.php" method="post">
                    <button type="submit" class="btn btn-outline-warning mr-2" name="generate_payroll">
                        <i class="fa-solid fa-equals"></i>
                    </button>
                </form>
                <a href="archive_all_process.php" class="btn btn-outline-primary">
                    <i class="fa-solid fa-archive"></i> Archive All
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark text-center">
            <tr>
                <th>Payroll ID</th>
                <th>Employee ID</th>
                <th>Pay Term</th>
                <th>Total Deduction (%)</th>
                <th>Total Fixed Deduction</th> 
                <th>Hours Worked</th>
                <th>Hourly Rate</th>
                <th>Gross Pay</th>
                <th>Net Pay</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Re-run the updated query to calculate total_percentage_deduction and total_fixed_deduction
            $result = mysqli_query($con, $selectQuery);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['payroll_id']; ?></td>
                <td><?php echo $row['employee_id']; ?></td>
                <td><?php echo $row['pay_term']; ?></td>
                <td><?php echo ($row['total_percentage_deduction'] * 100). '%'; ?></td>
                <td><?php echo $row['total_fixed_deduction']; ?></td>
                <td><?php echo $row['hours_worked']; ?></td>
                <td><?php echo $row['hourly_rate']; ?></td>
                <td><?php echo $row['gross_pay']; ?></td>
                <td><?php echo $row['net_pay']; ?></td>
                <td class="text-center">
                    <a href="archive_payroll_process.php?payroll_id=<?php echo $row['payroll_id']; ?>" class="btn btn-danger btn-sm">Archive</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include 'payrollmodal.php';?>

<!-- Add these scripts before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
