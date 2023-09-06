<div class="modal fade" id="addAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="addAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttendanceModalLabel">Add Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="add_att_process.php">
                    <div class="form-group">
                        <label for="employee_id">Employee ID:</label>
                        <input type="text" class="form-control" id="employee_id" name="employee_id" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time_in">Time In:</label>
                        <input type="datetime-local" class="form-control" id="time_in" name="time_in" required>
                    </div>
                    <div class="form-group">
                        <label for="time_out">Time Out:</label>
                        <input type="datetime-local" class="form-control" id="time_out" name="time_out" required>
                    </div>
                    <!-- Add more fields if needed -->
                    <button type="submit" class="btn btn-primary">Add Attendance</button>
                </form>
                <div id="responseMessage"></div> <!-- Display response message here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
