<!-- Edit Deduction Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDeductionForm" method="post" action="edit_deduction.php">
                    <input type="hidden" name="deduction_id">
                    <div class="form-group">
                        <label for="deduction_name">Deduction Name</label>
                        <input type="text" class="form-control" name="deduction_name" required>
                    </div>
                    <div class="form-group">
                        <label for="deduction_amount">Deduction Amount</label>
                        <input type="text" class="form-control" name="deduction_amount" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editDeductionBtn" >Save Changes</button>
            </div>
        </div>
    </div>
</div>