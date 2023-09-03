<?php include '../nav/nav_bar.php';
// Include the database connection
include '../connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch data from the deductions table with the applied search filter
$query = "SELECT * FROM deductions";

if (!empty($searchTerm)) {
    $query .= " WHERE deduction_name LIKE '%$searchTerm%' OR deduction_amount LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched data
$deductionData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $deductionData[] = $row;
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
    <title>Deduction List</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Deduction List</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <form class="flex-grow-1" method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search deduction"
                                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#addModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>

                </div>
            </div>

        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Deduction Name</th>
                    <th>Deduction Percentage</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($deductionData as $deduction) { ?>
                    <tr>
                        <td>
                            <?php echo $deduction['deduction_name']; ?>
                        </td>
                        <td>
    <?php echo number_format($deduction['deduction_amount'] * 100, 2) . '%'; ?>
</td>

                        <td class="text-center">
                            <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal" data-target="#editModal"
                                data-deduction-id="<?php echo $deduction['deduction_id']; ?>"
                                data-deduction-name="<?php echo $deduction['deduction_name']; ?>"
                                data-deduction-amount="<?php echo $deduction['deduction_amount']; ?>">
                                Edit
                            </button>
                            <a href="delete_deduction.php?deduction_id=<?php echo $deduction['deduction_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <?php include 'adddeductionmodal.php'; 
    include 'editdeductmodal.php';?>
<script>
    $(document).ready(function () {
        $('.edit-btn').click(function () {
            var deductionId = $(this).data('deduction-id');
            var deductionName = $(this).data('deduction-name');
            var deductionAmount = $(this).data('deduction-amount');
            
            $('#editModal input[name="deduction_id"]').val(deductionId);
            $('#editModal input[name="deduction_name"]').val(deductionName);
            $('#editModal input[name="deduction_amount"]').val(deductionAmount);
        });
    });
    $(document).ready(function () {
        $('#editDeductionBtn').click(function () {
            $('#editDeductionForm').submit();
        });
    });
</script>


    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>