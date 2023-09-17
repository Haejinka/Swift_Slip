<?php include '../nav/nav_bar.php';

// Include the database connection
include '../connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch data from the department table with the applied search filter
$query = "SELECT * FROM department";

if (!empty($searchTerm)) {
    $query .= " WHERE department_id LIKE '%$searchTerm%' OR department_name LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched data
$departmentData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $departmentData[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery (make sure it's included before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Department List</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Department List</h1>
            </div>
            <div class="col-md-4">
    <div class="d-flex">
        <form class="flex-grow-1" method="GET" action="">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search department"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addDeptModal">
    <i class="fas fa-plus"></i>
</button>

    </div>
</div>

        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($departmentData as $department) { ?>
                    <tr>
                        <td>
                            <?php echo $department['department_id']; ?>
                        </td>
                        <td>
                            <?php echo $department['department_name']; ?>
                        </td>
                        <td class="text-center">
                        <a href="delete_department.php?department_id=<?php echo $department['department_id']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this position?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include 'adddeptmodal.php';?>
</body>

</html>