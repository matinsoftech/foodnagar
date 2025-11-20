<section>
    @if($flashSales->isNotEmpty())
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-6">
                <h3 class="mb-0">Flash Sale</h3>
            </div>
        </div>
        <div class="table-responsive-lg pb-6">
            <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4 flex-nowrap">
                <div class="col">
                    <div class="pt-8 px-6 px-xl-8 rounded" style="background: url('{{ asset('css/assets/images/banner/banner-deal.jpg') }}') no-repeat; background-size: cover; height: 470px">
                        <div>
                            <h3 class="fw-bold text-white">Build Smart, Save Big!</h3>
                            <p class="text-white">Get the best deal before close.</p>
                            <a href="#!" class="btn btn-primary">
                                Shop Now
                                <i class="feather-icon icon-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flash-sale-carousel owl-carousel owl-theme" style="width: 80% !important">
                    @foreach($flashSales as $flashSale)
                    @foreach($flashSale->items as $item)
                    <div class="">
                        <div class="card card-product item">
                            <div class="card-body">
                                <div class="text-center position-relative">
                                    <a href="{{route('product_details',$item->product->id)}}"><img src="{{ $item->product->getFirstMediaUrl('default') }}" alt="{{  $item->product->name}}" class="mb-3 img-fluid" style="height: 155px;" /></a>

                                    <div class="card-product-action">
                                        <a href="javascript:void(0)" class="btn-action quickViewModal" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-id={{$item->product->id}}>
                                            <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn-action add_favourite" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist" data-id={{$item->product->id}}><i class="bi bi-heart"></i></a>
                                        <a href="javascript:void(0)" class="btn-action Compare" data-bs-toggle="tooltip" data-bs-html="true" title="Compare" data-id={{$item->product->id}}><i class="bi bi-arrow-left-right"></i></a>
                                    </div>
                                </div>
                                <div class="text-small mb-1">
                                    <a href="{{route('product_details',$item->product->id)}}" class="text-decoration-none text-muted "><small class="text-truncate">{{ $item->product->categories->first()->name ?? '' }}</small></a>
                                </div>
                                <h2 class="fs-6"><a href="{{route('product_details',$item->product->id)}}" class="text-inherit text-decoration-none text-truncate">{{ $item->product->name }}</a></h2>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn variation-trigger-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    150 ml
                                </button>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        @if($item->product->discount_price == null || $item->product->discount_price <= 0)
                                                  <span class=" text-dark">{{ currencyFormat($item->product->price) }}</span>
                                                @else
                                                    <span class=" text-dark">{{ currencyFormat($item->product->discount_price) }}</span>
                                                    <span class="text-decoration-line-through text-muted">{{ currencyFormat($item->product->price) }}</span>
                                                    {{--  <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}% Off</small></span>  --}}
                                                @endif
                                    </div>
                                    <div>
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <span><small>4.5</small></span>
                                    </div>
                                </div>
                                <div class="d-grid mt-2">
                                    <a href="javascript:void(0)" class="btn btn-primary product_btn" data-id="{{ $item->product->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19">
                                            </line>
                                            <line x1="5" y1="12" x2="19" y2="12">
                                            </line>
                                        </svg>
                                        Add to cart
                                    </a>
                                </div>
                                <div class="d-flex justify-content-start text-center mt-3">
                                    <div class="deals-countdown w-100" data-countdown="{{ $flashSale->expires_at }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <h3>No Flash Deals Available</h3>
    </div>
    @endif
</section>
