<div class="row">
    @foreach ($vendor_products as $product)
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
            <div class="product-card m-0 shadow-sm hover-shadow-lg transition-all">
                <!-- Product Media Section -->
                <div class="product-media position-relative overflow-hidden rounded-top">
                    <!-- Product Image with Hover Effect -->
                    <div class="product-img position-relative" style="height: 200px; overflow: hidden;">
                        <img src="{{ $product->photo }}" alt="{{ $product->name }}"
                            class="img-fluid w-100 h-100 object-fit-cover transition-transform hover-scale">
                        <!-- Quick View Button (appears on hover) -->
                        <div
                            class="quick-view-btn position-absolute bottom-0 start-0 end-0 text-center p-2 bg-dark bg-opacity-50 translate-y-100 transition-all">
                            <a href="{{ route('products_view', $product->id) }}"
                                class="btn btn-sm btn-light rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i> Quick View
                            </a>
                        </div>
                    </div>

                    <!-- Badges -->
                    <div class="position-absolute top-0 end-0 d-flex flex-column">
                        <span class="badge bg-danger mb-1 rounded-0">
                            <i class="fas fa-fire me-1"></i> Hot
                        </span>
                        <span class="badge bg-success rounded-0">Sale</span>
                    </div>
                </div>

                <!-- Product Content Section -->
                <div class="product-content p-3 border border-top-0 rounded-bottom">
                    <!-- Categories -->
                    <div class="product-categories mb-2">
                        @if ($product->categories)
                            @foreach ($product->categories as $category)
                                <span class="badge bg-light text-dark me-1 mb-1">
                                    <i class="fas fa-tag me-1 text-primary"></i>
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Product Title -->
                    <h5 class="product-title mb-2">
                        <a href="{{ route('products_view', $product->id) }}"
                            class="text-dark text-decoration-none hover-text-primary">
                            {{ $product->name }}
                        </a>
                    </h5>

                    <!-- Location -->
                    @if ($product->address)
                        <div class="product-meta mb-2 text-muted">
                            <i class="fas fa-map-marker-alt text-primary me-1"></i>
                            <small>{{ Str::limit($product->address, 25) }}</small>
                        </div>
                    @endif

                    <!-- Price and Action Buttons -->
                    <div class="product-info d-flex justify-content-between align-items-center">
                        <div class="product-price">
                            <span class="fw-bold text-primary fs-5">{{ currencyFormat($product->price) }}</span>
                            @if ($product->compare_price)
                                <del class="text-muted small ms-1">{{ currencyFormat($product->compare_price) }}</del>
                            @endif
                        </div>

                        <div class="product-actions d-flex">
                            <!-- Wishlist Button -->
                            <!--<button type="button" title="Save to wishlist" data-id="{{ $product->id }}"
                                class="btn btn-sm btn-outline-secondary rounded-circle me-1 hover-bg-primary hover-text-white ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                            </button>-->

                            <!-- Add to Cart Button -->
                            <a type="button" href="javascript:void(0)" title="Add to cart" data-id="{{ $product->id }}"
                                class="btn btn-sm btn-primary rounded-circle hover-bg-dark product_btn">
                                <i class="fas fa-shopping-cart m-0"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
