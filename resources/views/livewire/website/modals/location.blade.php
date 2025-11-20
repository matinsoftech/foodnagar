<!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-6">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1" id="locationModalLabel">Choose your Delivery Location</h5>
                        <p class="mb-0 small">Enter your address and we will specify the offer you area.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="my-5">
                    <input type="search" class="form-control" placeholder="Search your area" />
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Select Location</h6>
                    <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>
                </div>
                <div>
                    <div data-simplebar style="height: 300px">
                        <div class="list-group list-group-flush">
                            
                            @foreach ($deliveryzones as $key => $zone)
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action {{ $key == 0 ? 'active' : '' }}">
                                    <span>{{ $zone->name }}</span>
                                    <span>Min: ${{ $zone->delivery_fee }}</span>
                                </a>
                            @endforeach

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
