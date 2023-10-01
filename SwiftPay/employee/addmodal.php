<?php
// Fetch data for job positions
$positionQuery = "SELECT * FROM jobposition";
$positionResult = mysqli_query($con, $positionQuery);
$jobposition = array();
while ($positionRow = mysqli_fetch_assoc($positionResult)) {
    $jobposition[] = $positionRow;
}

// Fetch data for departments
$departmentQuery = "SELECT * FROM department";
$departmentResult = mysqli_query($con, $departmentQuery);
$department = array();
while ($departmentRow = mysqli_fetch_assoc($departmentResult)) {
    $department[] = $departmentRow;
}

// Fetch data for job statuses
$jobstatusQuery = "SELECT * FROM jobstatus";
$jobstatusResult = mysqli_query($con, $jobstatusQuery);
$jobstatus = array();
while ($jobstatusRow = mysqli_fetch_assoc($jobstatusResult)) {

    $jobstatus[] = $jobstatusRow;
}
// Fetch data for deductions
$deductionQuery = "SELECT * FROM deductions";
$deductionResult = mysqli_query($con, $deductionQuery);
$deductions = array();
while ($deductionRow = mysqli_fetch_assoc($deductionResult)) {
    $deductions[] = $deductionRow;
}

?>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="addEmployeeForm" action="add_employee.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="hire_date">Hire Date</label>
                        <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                    </div>
                    <div class="form-group">
                        <label for="position_id">Position</label>
                        <select class="form-control" id="position_id" name="position_id" required>
                            <option value="">Select Position</option>
                            <?php foreach ($jobposition as $position) { ?>
                                <option value="<?php echo $position['position_id']; ?>"><?php echo $position['position_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select class="form-control" id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                            <?php foreach ($department as $dept) { ?>
                                <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['department_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jobstatus_id">Job Status</label>
                        <select class="form-control" id="jobstatus_id" name="jobstatus_id" required>
                            <option value="">Select Job Status</option>
                            <?php foreach ($jobstatus as $status) { ?>
                                <option value="<?php echo $status['jobstatus_id']; ?>"><?php echo $status['jobstatus_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
    <label for="deduction_id">Deductions</label>
    <?php foreach ($deductions as $deduction) { ?>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="deduction_<?php echo $deduction['deduction_id']; ?>"
                                    name="deduction_id[]" value="<?php echo $deduction['deduction_id']; ?>">
                                <label class="form-check-label" for="deduction_<?php echo $deduction['deduction_id']; ?>">
                                    <?php
                                    $deductionAmount = $deduction['deduction_amount']; // Assuming deduction amount is a decimal number (e.g., 0.05 for 5%)
                                
                                    if ($deduction['deduction_method'] === 'fixed') {
                                        // Deduction method is fixed, so no need to multiply by 100
                                        echo $deduction['deduction_name'] . ' (' . $deductionAmount . ')';
                                    } elseif ($deduction['deduction_method'] === 'percentage') {
                                        // Deduction method is percentage, so multiply by 100 and add % sign
                                        $deductionAmount *= 100;
                                        echo $deduction['deduction_name'] . ' (' . $deductionAmount . '%)';
                                    } else {
                                        // Handle other cases or provide a default behavior
                                        echo 'Invalid deduction method';
                                    }
                                    ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>