<!-- Modal -->
<div class="modal fade" id="addPositionModal" tabindex="-1" role="dialog" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPositionModalLabel">Add Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add a new position -->
                <form method="post" action="add_position.php">
                    <div class="form-group">
                        <label for="positionName">Position Name</label>
                        <input type="text" class="form-control" id="positionName" name="positionName" required>
                    </div>
                    <div class="form-group">
                        <label for="hourlyRate">Hourly Rate</label>
                        <input type="number" class="form-control" id="hourlyRate" name="hourlyRate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Position</button>
                </form>
            </div>
        </div>
    </div>
</div>
