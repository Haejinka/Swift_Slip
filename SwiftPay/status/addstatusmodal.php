<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStatusForm" method="POST" action="add_status.php">
                    <div class="form-group">
                        <label for="statusName">Status Name</label>
                        <input type="text" class="form-control" id="statusName" name="status_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
