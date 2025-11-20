{{-- @section('css') --}}
    <style>
        .add_favourite.active {
            color: #ff6600;
        }
    </style>
{{-- @endsection --}}

<div class="ps-lg-8 mt-6 mt-lg-0">
    <a href="#!" class="mb-4 d-block">
        @if($vendor_name === 'Home Services')
            @if($product_detail->categories)
                <button class="btn btn-success btn-sm">{{$product_detail->categories ?  $product_detail->categories->name : ''}}</button>
            @endif
        @else
                @foreach ($product_detail->categories as $category)
                     <button class="btn btn-success btn-sm">{{ $category->name }}</button>
                @endforeach
        @endif
    </a>
    {{--  <a href="#!" class="mb-4 d-block">
        @foreach ($product_detail->categories as $category)
            <button class="btn btn-success btn-sm">{{ $category->name }}</button>
        @endforeach
    </a>  --}}
    <h2 class="mb-1 h1">{{ $product_detail->name }}</h2>
    <div class="mb-4">
        <small class="text-warning">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
        </small>
        <a href="#" class="ms-2">(30 reviews)</a>
    </div>
    <div class="fs-4">
        @if($product_detail->discount_price == null || $product_detail->discount_price <= 0)
            <span class="fw-bold text-dark">{{ currencyFormat($product_detail->price) }}</span>
        @else
            <span class="fw-bold text-dark">{{ currencyFormat($product_detail->discount_price) }}</span>
            <span class="text-decoration-line-through text-muted">{{ currencyFormat($product_detail->price) }}</span>
            <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}% Off</small></span>
        @endif
    </div>
    <hr class="my-6" />
    @if ($product_detail->options)
        <div class="mb-4">
            @foreach ($product_detail->options as $option)
                <button type="button" class="btn btn-outline-secondary">{{ $option->name }}</button>
            @endforeach

        </div>
    @endif
    <div>
        @if(isset($product_detail->duration))
            @if($product_detail->duration != 'fixed')
                <div class="input-group input-spinner">
                    <input type="button" value="-" class="button-minus btn btn-sm"
                        data-field="quantity" />
                    <input type="number" step="1" max="10" value="1" name="quantity"
                        class="quantity-field form-control-sm form-input" />
                    <input type="button" value="+" class="button-plus btn btn-sm"
                        data-field="quantity" />
                        <span class="p-2">{{ isset($product_detail->duration) ? $product_detail->duration : ''}}</span>
                </div>
            @endif
        @else
        <div class="input-group input-spinner">
            <input type="button" value="-" class="button-minus btn btn-sm"
                data-field="quantity" />
            <input type="number" step="1" max="10" value="1" name="quantity"
                class="quantity-field form-control-sm form-input" />
            <input type="button" value="+" class="button-plus btn btn-sm"
                data-field="quantity" />

        </div>
    @endif

    </div>
    <div class="mt-3 row justify-content-start g-2 align-items-center">
        <div class="col-lg-4 col-md-5 col-6 d-grid">
            <!-- button -->
            <!-- btn -->
            <button type="button" class="btn btn-primary product_btn" data-id="{{ $product_detail->id }}">
                <i class="feather-icon icon-shopping-bag me-2"></i>
                Add to list
            </button>
        </div>
        <div class="col-md-4 col-5">
            <!-- btn -->
            {{-- <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare"><i
                    class="bi bi-arrow-left-right"></i></a> --}}
            {{-- <a class="btn btn-light" href="#!" data-bs-toggle="tooltip"
                data-bs-html="true" aria-label="Wishlist"><i
                    class="feather-icon icon-heart"></i></a> --}}
            <a href="javascript:void(0)" class="btn-action add_favourite btn btn-light" data-bs-toggle="tooltip" data-bs-html="true"
                title="Saved items" data-id="{{ $product_detail->id }}">
                {{-- <i class="far fa-heart"></i> --}}
                <svg style="width: 1.2rem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"></path>
                </svg>
            </a>
        </div>
    </div>
    <hr class="my-6" />
    <div>
        <table class="table table-borderless mb-0">
            <tbody>
                <tr>
                    <td>Code:</td>
                    <td>{{ $product_detail->sku }}</td>
                </tr>
                @if($vendor_name != 'Home Services')
                <tr>
                    <td>Availability:</td>
                    <td>{{ $product_detail->available_qty > 0 ? 'In Stock' : 'Not In Stock'
                        }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td>Type:</td>
                    <td>
                        @if($vendor_name === 'Home Services')
                            @if($product_detail->categories)
                                <button class="btn btn-success btn-sm">{{$product_detail->categories ?  $product_detail->categories->name : ''}}</button>
                            @endif
                        @else
                                @foreach ($product_detail->categories as $category)
                                    <button class="btn btn-success btn-sm">{{ $category->name }}</button>
                                @endforeach
                        @endif

                        {{--  @foreach ($product_detail->categories as $category)
                        <button class="btn btn-success btn-sm">{{ $category->name
                            }}</button>
                        @endforeach  --}}
                    </td>

                </tr>
                @if($vendor_name != 'Home Services')
                <tr>
                    <td>Shipping:</td>
                    <td>
                        <small>
                            01 day shipping.
                            <span class="text-muted">( Free pickup today)</span>
                        </small>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


{{-- @section('js') --}}
    <script>
        $(document).ready(function() {
            // Initialize Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Toggle favorite functionality
            $(document).on('click', '.add_favourite', function() {
                $(this).toggleClass('active');
                const icon = $(this).find('i');

                if ($(this).hasClass('active')) {
                    icon.removeClass('far').addClass('fas');
                } else {
                    icon.removeClass('fas').addClass('far');
                }
            });
        });
    </script>
    <script>
$(document).ready(function() {
    // Initialize Owl Carousel
    var productCarousel = $("#productModal").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
        autoplay: false,
        margin: 10
    });

    // Refresh carousel when modal is shown
    $('#popupModal').on('shown.bs.modal', function () {
        productCarousel.trigger('refresh.owl.carousel');
    });

    // Thumbnail click
    $('#productModalThumbnails img').on('click', function() {
        let index = $(this).parent().parent().index();
        productCarousel.trigger('to.owl.carousel', [index, 300, true]);
    });
});
</script>

{{-- @endsection --}}
