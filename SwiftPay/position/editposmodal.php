 <!-- Modal for editing position -->
 <form id="editPositionForm" method="POST" action="edit_position.php">
    <!-- Modal for editing position -->
<div class="modal fade" id="editPositionModal" tabindex="-1" role="dialog" aria-labelledby="editPositionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPositionForm" method="POST" action="edit_position.php">
                <div class="modal-body">
                    <input type="hidden" id="editPositionId" name="position_id">
                    <div class="form-group">
                        <label for="editPositionName">Position Name</label>
                        <input type="text" class="form-control" id="editPositionName" name="position_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editHourlyRate">Hourly Rate</label>
                        <input type="text" class="form-control" id="editHourlyRate" name="hourly_rate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </form>