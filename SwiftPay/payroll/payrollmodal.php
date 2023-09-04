<!-- Add Payroll Modal -->
<div class="modal fade" id="addPayrollModal" tabindex="-1" role="dialog" aria-labelledby="addPayrollModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPayrollModalLabel">Add New Payroll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="process_payroll.php">
                    <div class="form-group">
                        <label for="employeeID">Employee ID</label>
                        <input type="text" class="form-control" id="employeeID" name="employee_id" list="employeeIDs" autocomplete="off">
                        <datalist id="employeeIDs">
                            <?php
                            $employeeQuery = "SELECT employee_id FROM employee";
                            $employeeResult = mysqli_query($con, $employeeQuery);

                            while ($employeeRow = mysqli_fetch_assoc($employeeResult)) {
                                echo '<option value="' . $employeeRow['employee_id'] . '">' . $employeeRow['employee_id'] . '</option>';
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="payTerm">Pay Term</label>
                        <select class="form-control" id="payTerm" name="pay_term">
                            <option value="FIRST HALF">First Half</option>
                            <option value="SECOND HALF">Second Half</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="savePayroll">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>