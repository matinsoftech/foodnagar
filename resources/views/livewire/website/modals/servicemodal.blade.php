<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Service Form</h5>
                <button type="button" class="close closeButton float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="serviceForm">
                    <div class="form-group">
                        <label for="serviceName">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" name="serviceName" placeholder="Enter the service name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Service description"></textarea>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeButton" data-dismiss="modal">Close</button>
                <button type="submit" form="serviceForm" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
