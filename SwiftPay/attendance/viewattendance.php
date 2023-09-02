<?php
include '../nav/nav_bar.php';
include '../connect.php';
include 'add_attendance_form.php';

// Fetch data from the attendance table
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM attendance";

if (!empty($searchTerm)) {
    $query .= " WHERE employee_id LIKE '%$searchTerm%' OR time_in LIKE '%$searchTerm%' OR time_out LIKE '%$searchTerm%' OR hours_worked LIKE '%$searchTerm%'";
}

$result = mysqli_query($con, $query);

// Initialize an empty array to store the fetched data
$attendanceData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $attendanceData[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include jQuery (make sure it's included before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // code for initializing the modal if needed
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9">
                <h1>Attendance List</h1>
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
                    <button class="btn btn-outline-success mr-2" data-toggle="modal" data-target="#addAttendanceModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <a href="archive_all_attendance_process.php" class="btn btn-outline-primary">
                        <i class="fa-solid fa-archive"></i> Archive All
                    </a>
                </div>
            </div>



        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Employee ID</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Hours Worked</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceData as $attendance) { ?>
                    <tr>
                        <td>
                            <?php echo $attendance['employee_id']; ?>
                        </td>
                        <td>
                            <?php echo $attendance['time_in']; ?>
                        </td>
                        <td>
                            <?php echo $attendance['time_out']; ?>
                        </td>
                        <td>
                            <?php echo $attendance['hours_worked']; ?>
                        </td>
                        <td class="text-center">

                            <a href="archive_process.php?attendance_id=<?php echo $attendance['attendance_id']; ?>"
                                class="btn btn-danger btn-sm">Archive</a>


                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS (for any required functionality) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
        $(document).ready(function () {
            // Handle form submission
            $("form").submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                var employee_id = $("#employee_id").val();
                var time_in = $("#time_in").val();
                var time_out = $("#time_out").val();

                // AJAX request
                $.ajax({
                    url: "add_attendance.php",
                    type: "POST",
                    data: {
                        employee_id: employee_id,
                        time_in: time_in,
                        time_out: time_out
                    },
                    success: function (response) {
                        $("#responseMessage").html(response); // Display the response message
                    },
                    error: function () {
                        $("#responseMessage").html("Error submitting form.");
                    }
                });
            });
        });
    </script>
</body>

</html>