@if (count($all_products) > 0)

        @foreach ($all_products as $product)
        <div class="col">
            <div class="card card-product">
                <div class="card-body">
                    <div class="text-center position-relative w-33">
                        <div class="position-absolute top-0 start-0">
                            <span class="badge bg-danger">Sale</span>
                        </div>
                        @if($vendor_name === 'Services')
                        <a href="{{route('service.product_details',$product->id)}}">
                            <img src="{{ $product->getFirstMediaUrl('default') }}"
                                alt="" class="mb-3 img-fluid" style="height: 174.8px;"/>
                        </a>
                        @else
                            <a href="{{route('product_details',$product->id)}}">
                                <img src="{{ $product->getFirstMediaUrl('default') }}"
                                    alt="" class="mb-3 img-fluid" style="height: 174.8px;"/>
                            </a>
                        @endif

                        <div class="card-product-action">
                            <a href="javascript:void(0)" class="btn-action quickViewModal" data-id={{ $product->id }}>
                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                    title="Quick View"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn-action add_favourite" data-bs-toggle="tooltip"
                                data-bs-html="true" title="Wishlist" data-id={{ $product->id }}><i
                                    class="bi bi-heart"></i></a>
                            <a href="javascript:void(0)" class="btn-action Compare" data-bs-toggle="tooltip"
                                data-bs-html="true" title="Compare" data-id={{ $product->id }}><i
                                    class="bi bi-arrow-left-right"></i></a>
                        </div>
                    </div>
                    <div class="w-67">
                        <div class="text-small mb-1">
                            @foreach ($product->categories as $category)
                                <a href="{{ route('product_details', $product->id) }}"
                                    class="text-decoration-none text-muted"><small>
                                        {{ $category->name }}
                                    </small></a>
                            @endforeach
                        </div>
                        <h2 class="fs-6"><a href="{{ route('product_details', $product->id) }}"
                                class="text-inherit text-decoration-none">{{ $product->name }}</a></h2>
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
                        <div class="d-flex justify-content-between align-items-center mt-3 search-single-list">
                            <div>
                                @if($product->discount_price == null || $product->discount_price <= 0)
                                <span class=" text-dark">{{ currencyFormat($product->price) }}</span>
                              @else
                                  <span class=" text-dark">{{ currencyFormat($product->discount_price) }}</span>
                                  <span class="text-decoration-line-through text-muted">{{ currencyFormat($product->price) }}</span>
                                  {{--  <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}% Off</small></span>  --}}
                              @endif
                            </div>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn"
                                    data-id="{{ $product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
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
        </div>
    @endforeach


@endif
