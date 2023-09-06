<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];

    // Fetch employee data from the database
    $query = "SELECT * FROM employee WHERE employee_id = $employeeId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $employee = mysqli_fetch_assoc($result);
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<form action="update_employee.php" method="post">
    <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $employee['first_name']; ?>">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $employee['last_name']; ?>">
    </div>
    <div class="form-group">
        <label for="hire_date">Hire Date:</label>
        <input type="date" class="form-control" name="hire_date" value="<?php echo $employee['hire_date']; ?>">
    </div>
    <div class="form-group">
        <label for="position_id">Position:</label>
        <select class="form-control" name="position_id">
            <?php
            $positionQuery = "SELECT * FROM jobposition";
            $positionResult = mysqli_query($con, $positionQuery);

            while ($position = mysqli_fetch_assoc($positionResult)) {
                echo '<option value="' . $position['position_id'] . '" ' . ($employee['position_id'] == $position['position_id'] ? 'selected' : '') . '>' . $position['position_name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="department_id">Department:</label>
        <select class="form-control" name="department_id">
            <?php
            $departmentQuery = "SELECT * FROM department";
            $departmentResult = mysqli_query($con, $departmentQuery);

            while ($department = mysqli_fetch_assoc($departmentResult)) {
                echo '<option value="' . $department['department_id'] . '" ' . ($employee['department_id'] == $department['department_id'] ? 'selected' : '') . '>' . $department['department_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="jobstatus_id">Job Status:</label>
        <select class="form-control" name="jobstatus_id">
            <?php
            $jobStatusQuery = "SELECT * FROM jobstatus";
            $jobStatusResult = mysqli_query($con, $jobStatusQuery);

            while ($jobStatus = mysqli_fetch_assoc($jobStatusResult)) {
                echo '<option value="' . $jobStatus['jobstatus_id'] . '" ' . ($employee['jobstatus_id'] == $jobStatus['jobstatus_id'] ? 'selected' : '') . '>' . $jobStatus['jobstatus_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
    <label>Deductions:</label>
    <?php
    $selectedDeductions = explode(',', $employee['deduction_id']);
    $deductionQuery = "SELECT * FROM deductions";
    $deductionResult = mysqli_query($con, $deductionQuery);

    while ($deduction = mysqli_fetch_assoc($deductionResult)) {
        echo '<div class="form-check">';
        echo '<input type="checkbox" class="form-check-input" id="deduction_' . $deduction['deduction_id'] . '" name="deduction_id[]" value="' . $deduction['deduction_id'] . '" ' . (in_array($deduction['deduction_id'], $selectedDeductions) ? 'checked' : '') . '>';
        echo '<label class="form-check-label" for="deduction_' . $deduction['deduction_id'] . '">' . $deduction['deduction_name'] . '</label>';
        echo '</div>';
    }
    ?>
</div>


    
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
