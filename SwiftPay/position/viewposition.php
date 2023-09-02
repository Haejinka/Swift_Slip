<?php
include '../nav/nav_bar.php';
include '../connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch data from the jobposition table with the applied search filter
$query = "SELECT * FROM jobposition";

if (!empty($searchTerm)) {
    $query .= " WHERE position_name LIKE '%$searchTerm%' OR hourly_rate LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched data
$positionData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $positionData[] = $row;
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
    <title>Position List</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Position List</h1>
            </div>
            <div class="col-md-4">
                <div class="d-flex">
                    <form class="flex-grow-1" method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search position"
                                value="<?php echo $searchTerm; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addPositionModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>

        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Position Name</th>
                    <th>Hourly Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($positionData as $position) { ?>
                    <tr>
                        <td>
                            <?php echo $position['position_name']; ?>
                        </td>
                        <td>
                            <?php echo $position['hourly_rate']; ?>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm edit-position-btn" data-toggle="modal"
                                data-target="#editPositionModal" data-position-id="<?php echo $position['position_id']; ?>"
                                data-position-name="<?php echo $position['position_name']; ?>"
                                data-hourly-rate="<?php echo $position['hourly_rate']; ?>">
                                Edit
                            </a>
                            <a href="delete_position.php?position_id=<?php echo $position['position_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this position?')">Delete</a>
                        </td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <?php include 'editposmodal.php';
   include 'addposmodal.php';?>
    <script>
        $(document).ready(function () {
        $(".edit-position-btn").click(function () {
            var positionId = $(this).data("position-id");
            var positionName = $(this).data("position-name");
            var hourlyRate = $(this).data("hourly-rate");

            $("#editPositionId").val(positionId);
            $("#editPositionName").val(positionName);
            $("#editHourlyRate").val(hourlyRate);

            // Show the modal
            $("#editPositionModal").modal("show");
        });
    });
    </script>


</body>

</html>