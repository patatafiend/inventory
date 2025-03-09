<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUnitModal">Add Unit</button>

<div class="modal fade" id="addUnitModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addUnitForm">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Unit</button>
                </form>
            </div>
        </div>
    </div>
</div>
