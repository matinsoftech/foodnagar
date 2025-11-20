@if (count($latest_products) > 0)
    <section class="my-lg-14 my-8">
        <div class="container">
            <div class="row">
                <div class="col-8 mb-6">
                    <h3 class="mb-0">Latest Products</h3>
                </div>
                <div class="col-4 mb-6 text-end">
                    <a href="{{ url()->current() }}/products">View All</a>
                </div>
            </div>

            <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
                @foreach ($latest_products as $product)
                    <div class="col">
                        <div class="card card-product">
                            <div class="card-body">
                                <div class="text-center position-relative">
                                    @if ($product->subscription == 'yes')
                                        <div class="position-absolute top-0 start-0">
                                            <span class="badge bg-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 12a9 9 0 1 1-3-6.7" />
                                                    <polyline points="21 3 21 8 16 8" />
                                                    <polyline points="9 12 11 14 15 10" />
                                                </svg>
                                                Subscription
                                            </span>
                                        </div>
                                    @endif
                                    {{-- <div class="position-absolute top-0 start-0">
                                        <span class="badge bg-danger">{{$vendor_name }}</span>
                                    </div> --}}
                                    @if ($vendor_name == 'Home Services')
                                        <a href="{{ route('service.product_details', $product->id) }}">
                                            <img src="{{ $product->getFirstMediaUrl('default') }}" alt=""
                                                class="mb-3 img-fluid" style="height: 174.8px;" />
                                        </a>
                                    @else
                                        <a href="{{ route('product_details', $product->id) }}">
                                            <img src="{{ $product->getFirstMediaUrl('default') }}" alt=""
                                                class="mb-3 img-fluid" style="height: 174.8px;" />
                                        </a>
                                    @endif
                                    <div class="card-product-action">
                                        <a href="javascript:void(0)" class="btn-action quickViewModal"
                                            data-id={{ $product->id }}>
                                            <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Quick View"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn-action add_favourite "
                                            data-bs-toggle="tooltip" data-bs-html="true" title="Saved items"
                                            data-id={{ $product->id }}>
                                            {{-- <i class="bi bi-heart"></i> --}}
                                            <svg style="width: 1.2rem" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z">
                                                </path>
                                            </svg>
                                        </a>
                                        {{-- <a href="javascript:void(0)" class="btn-action Compare" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Compare" data-id={{$product->id}}><i
                                            class="bi bi-arrow-left-right"></i></a> --}}
                                    </div>
                                </div>

                                <div class="text-small mb-1">
                                    @if ($vendor_name == 'Home Services')
                                        <a href="{{ route('product_details', $product->id) }}"
                                            class="text-decoration-none text-muted"><small>
                                                {{ $product->categories ? $product->categories->name : '' }}
                                            </small></a>
                                    @else
                                        @foreach ($product->categories as $category)
                                            <a href="{{ route('product_details', $product->id) }}"
                                                class="text-decoration-none text-muted"><small>
                                                    {{ $category ? $category->name : '' }}
                                                </small></a>
                                        @endforeach
                                    @endif
                                </div>

                                <h2 class="fs-6"><a href="{{ route('product_details', $product->id) }}"
                                        class="text-inherit text-decoration-none line-clamp-1">{{ $product->name }}</a>
                                </h2>
                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn variation-trigger-button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    150 ml
                                </button> --}}
                                <div>
                                    <small class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </small>
                                    <span class="text-muted small">4.5(149)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        @if ($product->discount_price == null || $product->discount_price <= 0)
                                            <span class=" text-dark">{{ currencyFormat($product->price) }}</span>
                                        @else
                                            <span
                                                class=" text-dark">{{ currencyFormat($product->discount_price) }}</span>
                                            <span
                                                class="text-decoration-line-through text-muted">{{ currencyFormat($product->price) }}</span>
                                            {{--  <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}% Off</small></span>  --}}
                                        @endif
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn"
                                            data-id="{{ $product->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19">
                                                </line>
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                            </svg>
                                            Add
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endif
