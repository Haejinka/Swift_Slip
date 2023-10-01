<?php include '../nav/nav_bar.php';
// Include the database connection
include '../connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch data from the jobstatus table with the applied search filter
$query = "SELECT * FROM jobstatus";

if (!empty($searchTerm)) {
    $query .= " WHERE jobstatus_name LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched data
$jobStatusData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $jobStatusData[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Status List</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Status List</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <form class="flex-grow-1" method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search status"
                                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addModal">
                        <i class="fa-solid fa-plus"></i>
                    </button> -->
                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Status ID</th>
                    <th>Status Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobStatusData as $status) { ?>
                    <tr>
                        <td>
                            <?php echo $status['jobstatus_id']; ?>
                        </td>
                        <td>
                            <?php echo $status['jobstatus_name']; ?>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm edit-btn"
                                data-deduction-id="<?php echo $status['jobstatus_id']; ?>"
                                data-deduction-name="<?php echo $status['jobstatus_name']; ?>"
                                >Edit</a>
                            <!-- <a href="delete_jobstatus.php?jobstatus_id=<?php echo $status['jobstatus_id']; ?>"
                                class="btn btn-danger btn-sm">Delete</a> -->
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editDeductionForm" method="POST" action="edit_status.php">
                        <input type="hidden" name="deduction_id" value="">
                        <div class="form-group">
                            <label for="deduction_name">Status Name:</label>
                            <input type="text" class="form-control" id="deduction_name" name="deduction_name" value="">
                        </div>
                        <button type="button" id="editDeductionBtn" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.edit-btn').click(function () {
                var deductionId = $(this).data('deduction-id');
                var deductionName = $(this).data('deduction-name');
                
                $('#editModal input[name="deduction_id"]').val(deductionId);
                $('#editModal input[name="deduction_name"]').val(deductionName);
                
                $('#editModal').modal('show');
            });

            $('#editDeductionBtn').click(function () {
                $('#editDeductionForm').submit();
            });
        });
    </script>

    <?php include 'addstatusmodal.php'; ?>
    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
