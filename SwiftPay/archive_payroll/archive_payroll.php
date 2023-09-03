<?php
include '../nav/nav_bar.php';
include '../connect.php';

// Check if the search parameter is provided in the URL
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search = mysqli_real_escape_string($con, $search); // Sanitize input
    $search_query = " AND (p.parc_id LIKE '%$search%' OR p.employee_id LIKE '%$search%' OR p.pay_ LIKE '%$search%' OR d.deduction_name LIKE '%$search%')";
} else {
    $search_query = "";
}

$query = "SELECT p.*, d.deduction_name FROM archive_payroll p
          LEFT JOIN deductions d ON p.deduction_id = d.deduction_id
          WHERE 1 $search_query";

$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAr</title>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Payroll List</h1>
        </div>
        <div class="col-md-4">
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
    </div>
</div>


    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark text-center">
            <tr>
                <th>Payroll ID</th>
                <th>Employee ID</th>
                <th>Pay Term</th>
                <th>Deduction ID</th>
                <th>Hours Worked</th>
                <th>Hourly Rate</th>
                <th>Gross Pay</th>
                <th>Net Pay</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                <td><?php echo $row['parc_id']; ?></td>

                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['pay_term']; ?></td>
                    <td><?php echo $row['deduction_name']; ?></td>
                    <td><?php echo $row['hours_worked']; ?></td>
                    <td><?php echo $row['hourly_rate']; ?></td>
                    <td><?php echo $row['gross_pay']; ?></td>
                    <td><?php echo $row['net_pay']; ?></td>
                    <td class="text-center">
                        
                    <a href="delete_archive_payroll.php?parc_id=<?php echo $row['parc_id']; ?>" class="btn btn-danger btn-sm">Delete</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



<!-- Add these scripts before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
