<section class="my-lg-14 my-8">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-6 d-flex justify-content-between">
                <div>
                    <h4 style="color: #ffb600; letter-spacing: 4px;">Top Stores</h3>
                </div>

                <a href="{{ url('shoplist') }}">View All</a>
            </div>
        </div>
        <div class="owl-carousel shop-list-carousel">
            @foreach($vendors as $vendor)
            <a href="{{ route('shop.detail',$vendor->id) }}" class="others-store-card text-capitalize">
                <div class="overflow-hidden other-store-banner">
                    <!-- <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                        class="w-100 h-100 object-cover" alt="store-banner-image"> -->
                </div>
                <div class="name-area">
                    <div class="position-relative">
                        <div class="overflow-hidden other-store-logo rounded-full">
                            <img class="rounded-full"
                                src="{{ $vendor->logo }}"
                                alt="store-images">
                        </div>
                    </div>
                    <div class="info pt-2">
                        <h5>{{ $vendor->name }}</h5>
                        <div class="d-flex align-items-center">
                            <h6 style="color:#ff6600">0.0</h6>
                            <i class="tio-star text-star mx-1"></i>
                            <small>Rating</small>
                        </div>
                    </div>
                </div>
                <div class="info-area">
                    <div class="info-item">
                        <h6 style="color:#ff6600">0</h6>
                        <span>Reviews</span>
                    </div>
                    <div class="info-item">
                        <h6 style="color:#ff6600">0</h6>
                        <span>Products</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</section>
