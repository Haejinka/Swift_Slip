<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addDeductionForm" method="POST" action="add_deduction.php">
                    <div class="form-group">
                        <label for="deductionName">Deduction Name</label>
                        <input type="text" class="form-control" id="deductionName" name="deduction_name" required>
                    </div>
                    <div class="form-group">
                        <label for="deductionAmount">Deduction Amount</label>
                        <input type="number" class="form-control" id="deductionAmount" name="deduction_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="deductionMethod">Deduction Method</label>
                        <select class="form-control" id="deductionMethod" name="deduction_method" required>
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Deduction</button>
                </form>
            </div>
        </div>
    </div>
</div>
