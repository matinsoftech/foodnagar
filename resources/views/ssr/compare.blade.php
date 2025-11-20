@foreach($products as $product)
<div class="product-compare-table col-lg-3 col-md-4 col-sm-6 col-12">
    <div class="compare-product_item">
        <img src="{{ $product->getFirstMediaUrl('default') }}"
            alt="">
        <div class="product-compart-title my-2">
            <a href="{{ url('product_detail') }}/{{ $product->id }}">{{ $product->name }}</a>
        </div>
        <div class="compare-product-price d-flex flex-wrap align-items-center gap-8 my-2">
            <span class="text-accent text-dark">Rs. {{ $product->price - $product->discount_price }}
                <del class="compare-discount-product-price">
                    Rs. {{ $product->price }}
                </del>
            </span>
        </div>
        <div class="product-compare-description">
            <div class="product-compare-rating my-3">
                <div class="compare-stars">
                    5
                    <i class="fa fa-star text-white" aria-hidden="true"></i>
                </div>
                <div class="compare-review-count">
                    <a href="#" class="">20
                        Reviews</a>
                </div>
            </div>
            <div class="product-compare-specification my-3">
                <span>
                    Product Details
                </span>
            </div>
            <div class="product-compare-variants my-2">
                <p class="varients-title m-0">Color</p>
                <p class="varients-content m-0">
                    Black, Blue, Green, Pink, Yellow
                </p>
            </div>
        </div>
        <div class="compare-buynow my-3">
            <div class="__btn-grp search-page-buttons mt-2 mb-3">
                <form id="add-to-cart-form" class="mb-2 px-2">
                    <div>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn" data-id="{{ $product->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach