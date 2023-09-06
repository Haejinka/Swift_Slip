<?php
// Include necessary files and establish a database connection
include '../nav/nav_bar.php';
include '../connect.php';

// Retrieve the search term (if provided) from the URL query parameters
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Construct the SQL query to fetch employee data with deductions
$query = "SELECT e.*, d.department_name, jp.position_name, js.jobstatus_name, GROUP_CONCAT(DISTINCT ded.deduction_name SEPARATOR ', ') AS deduction_names
          FROM employee e
          LEFT JOIN department d ON e.department_id = d.department_id
          LEFT JOIN jobposition jp ON e.position_id = jp.position_id
          LEFT JOIN jobstatus js ON e.jobstatus_id = js.jobstatus_id
          LEFT JOIN deductions ded ON FIND_IN_SET(ded.deduction_id, e.deduction_id)
          GROUP BY e.employee_id";

// Add a search filter to the query if a search term is provided
if (!empty($searchTerm)) {
    $query .= " WHERE e.employee_id LIKE '%$searchTerm%' OR e.first_name LIKE '%$searchTerm%' OR e.last_name LIKE '%$searchTerm%' OR e.hire_date LIKE '%$searchTerm%' OR jp.position_name LIKE '%$searchTerm%' OR d.department_name LIKE '%$searchTerm%' OR js.jobstatus_name LIKE '%$searchTerm%'";
}

// Execute the SQL query to fetch employee data with deductions
$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched employee data
$employeeData = array();

// Fetch employee data and store it in the $employeeData array
while ($row = mysqli_fetch_assoc($result)) {
    $employeeData[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Employee List</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <form class="flex-grow-1" method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search attendance">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Hire Date</th>
                    <th>Position ID</th>
                    <th>Department ID</th>
                    <th>Deduction ID</th> 
                    <th>Job Status ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employeeData as $employee) { ?>
                    <tr>
                        <td>
                            <?php echo $employee['employee_id']; ?>
                        </td>
                        <td>
                            <?php echo $employee['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $employee['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $employee['hire_date']; ?>
                        </td>
                        <td>
                            <?php echo $employee['position_name']; ?>
                        </td>
                        <td>
                            <?php echo $employee['department_name']; ?>
                        </td>
                        <td>
                            <?php echo $employee['deduction_names']; ?> 
                        </td>
                        <td>
                            <?php echo $employee['jobstatus_name']; ?>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm edit-btn" data-toggle="modal" data-target="#editModal"
                                data-employee-id="<?php echo $employee['employee_id']; ?>">Edit</a>
                            <a href="delete_employee.php?employee_id=<?php echo $employee['employee_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include 'editmodal.php';
    include 'addmodal.php'; ?>;

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load edit modal content when clicking on the edit button
            $('.edit-btn').click(function () {
                var employeeId = $(this).data('employee-id');
                $('#editModal .modal-body').load('edit_employee_modal.php?employee_id=' + employeeId);
            });
        });
    </script>

    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
