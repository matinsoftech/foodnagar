@extends('livewire.website.layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="mt-4">
                <div class="container_sec">
                    <!-- row -->
                    <div class="row w-100 mx-auto">
                        <!-- col -->
                        <div class="col-12">
                            <!-- breadcrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Bakery Biscuits</a></li> --}}

                                    <li class="breadcrumb-item active" aria-current="page">{{ $product_detail->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <section class="mt-8">
                <div class="container_sec">
                    <div class="row w-100 justify-content-center mx-auto">
                        <div class="row col-lg-9">
                            <div class="col-md-5 col-xl-5">
                                <!-- img slide -->
                                <div class="product owl-carousel owl-theme">
                                    @foreach ($images as $key => $image)
                                        <div>
                                            <div class="zoom" data-hash="{{ $key }}"
                                                style="background-image: url({{ $image }})">
                                                <img src="{{ $image }}" alt=""
                                                    class="object-fit-cover img-fluid" style="aspect-ratio: 1/1" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- product tools -->
                                <div class="product-tools">
                                    <div class="thumbnails row w-100 g-2" id="productThumbnails">
                                        @foreach ($images as $key => $image)
                                            <div class="item col-3">
                                                <div class="thumbnails-img">
                                                    <a href="#{{ $key }}"> <img src="{{ $image }}"
                                                            alt="" class="img-fluid thumbnail-item"
                                                            data-index="{{ $key }}" /></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-xl-7">
                                <div class="ps-lg-10 mt-6 mt-md-0">
                                    <!-- content -->
                                    {{-- <a href="#!" class="mb-4 d-block">
                                        @if ($vendor_name === 'Home Services')
                                            @if ($product_detail->categories)
                                                <button
                                                    class="btn btn-success btn-sm">{{ $product_detail->categories ? $product_detail->categories->name : '' }}</button>
                                            @endif
                                        @else
                                            @foreach ($product_detail->categories as $category)
                                                <button class="btn btn-success btn-sm">{{ $category->name }}</button>
                                            @endforeach
                                        @endif
                                    </a> --}}
                                    <!-- heading -->
                                    <h1 class="mb-1">{{ $product_detail->name }}</h1>
                                    <div class="mb-4">
                                        <!-- rating -->
                                        <!-- rating -->
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
                                        @if ($product_detail->discount_price == null || $product_detail->discount_price <= 0)
                                            <span
                                                class="fw-bold text-dark">{{ currencyFormat($product_detail->price) }}</span>
                                        @else
                                            <span
                                                class="fw-bold text-dark">{{ currencyFormat($product_detail->discount_price) }}</span>
                                            <span
                                                class="text-decoration-line-through text-muted">{{ currencyFormat($product_detail->price) }}</span>
                                            <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}%
                                                    Off</small></span>
                                        @endif
                                    </div>
                                    <!-- hr -->
                                    <hr class="my-6" />
                                    @if ($product_detail->categories->isNotEmpty())
                                    <p>
                                        @foreach ($product_detail->categories as $category)
                                            {{$category->name . ', '}}
                                            @if ($product_detail->sub_categories)
                                                @foreach ($product_detail->sub_categories as $sub_category)
                                                {{$sub_category->name . ', '}}
                                                @if ($product_detail->sub_sub_categories)
                                                @foreach ($product_detail->sub_sub_categories as $sub_sub_category)
                                                        {{$sub_sub_category->name}}
                                                    @endforeach
                                                @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </p>
                                    @endif
                                    @if ($product_detail->options)
                                        <div class="mb-5">
                                            @foreach ($product_detail->options as $option)
                                                <button type="button"
                                                    class="btn btn-outline-secondary">{{ $option->name }}</button>
                                            @endforeach

                                        </div>
                                    @endif
                                    {{-- <div>
                                        <!-- input -->
                                        @if (isset($product_detail->duration))
                                            @if ($product_detail->duration != 'fixed')
                                                <div class="input-group input-spinner">
                                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                                        data-field="quantity" />
                                                    <input type="number" step="1" max="10" value="1"
                                                        name="quantity" class="quantity-field form-control-sm form-input" />
                                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                                        data-field="quantity" />
                                                    <span
                                                        class="p-2">{{ isset($product_detail->duration) ? $product_detail->duration : '' }}</span>
                                                </div>
                                            @endif
                                        @else
                                            <div class="input-group input-spinner">
                                                <input type="button" value="-" class="button-minus btn btn-sm"
                                                    data-field="quantity" />
                                                <input type="number" step="1" max="10" value="1"
                                                    name="quantity" class="quantity-field form-control-sm form-input" />
                                                <input type="button" value="+" class="button-plus btn btn-sm"
                                                    data-field="quantity" />

                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3 d-flex justify-content-start gap-3 align-items-center">
                                        <div class="">
                                            <!-- button -->
                                            <!-- btn -->
                                            <button type="button" class="btn btn-primary product_btn"
                                                data-id="{{ $product_detail->id }}" style="width: max-content;">
                                                <i class="feather-icon icon-shopping-bag me-2"></i>
                                                Add to List
                                            </button>
                                        </div>
                                        <div class="">
                                            <!-- btn -->
                                            <a href="#!" class="btn-action add_favourite btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Saved items"
                                                data-id={{ $product_detail->id }}>
                                                <svg style="width: 1.2rem" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div> --}}
                                    <div class="mt-3 d-flex justify-content-start gap-3 align-items-center">
                                        {{--<div class="">
                                            <!-- button -->
                                            <!-- btn -->

                                            <!--
                                            Vendor type Id's are:
                                            1: Parcel,
                                            2: Food,
                                            3: Grocery,
                                            4: Pharmacy,
                                            5: Service,
                                            6: Taxi,
                                            7: Service,
                                            8: Commerce,
                                            9: Classified,
                                            10: Grocery,
                                            11: Appointment Booking
                                            -->
                                            @php
                                                $bookable = [5,6,7,11];
                                            @endphp
                                            <a href="{{ url('calander') }}" class="btn btn-primary product_btn"style="width: max-content;">
                                                @if (in_array($product_detail->vendor_type_id, $bookable ))
                                                    Book Now
                                                @else
                                                    Buy Now
                                                @endif
                                            </a>
                                        </div>--}}
                                        <button type="button" class="btn btn-primary product_btn"
                                            data-id="{{ $product_detail->id }}" style="width: max-content;">
                                            <i class="feather-icon icon-shopping-bag me-2"></i>
                                            Add to Cart
                                        </button>
                                        <a href="{{ url('subscribe-product') }}" class="btn btn-primary"
                                            data-id="{{ $product_detail->id }}" style="width: max-content;">
                                            <i class="fa-solid fa-basket-shopping me-2"></i>
                                            Subscribe
                                        </a>
                                        <div class="">
                                            <!-- btn -->
                                            <a href="#!" class="btn-action add_favourite btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-html="true" title="Saved items"
                                                data-id={{ $product_detail->id }}>
                                                <svg style="width: 1.2rem" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- hr -->
                                    <hr class="my-6" />
                                    <div>
                                        <!-- table -->
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Code:</td>
                                                    <td>{{ $product_detail->sku }}</td>
                                                </tr>
                                                @if ($vendor_name != 'Home Services')
                                                    <tr>
                                                        <td>Availability:</td>
                                                        <td>{{ $product_detail->available_qty > 0 ? 'In Stock' : 'Not In Stock' }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>Type:</td>
                                                    <td>
                                                        @if ($vendor_name === 'Home Services')
                                                            @if ($product_detail->categories)
                                                                <button
                                                                    class="btn btn-success btn-sm">{{ $product_detail->categories ? $product_detail->categories->name : '' }}</button>
                                                            @endif
                                                        @else
                                                            @foreach ($product_detail->categories as $category)
                                                                <button
                                                                    class="btn btn-success btn-sm">{{ $category->name }}</button>
                                                            @endforeach
                                                        @endif

                                                        {{--  @foreach ($product_detail->categories as $category)
                                                    <button class="btn btn-success btn-sm">{{ $category->name
                                                        }}</button>
                                                    @endforeach  --}}
                                                    </td>

                                                </tr>
                                                @if ($vendor_name != 'Home Services')
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
                                    <div class="mt-8">
                                        <!-- dropdown -->

                                        <ul class="border rounded p-2 d-flex list-unstyled gap-3 align-items-center m-0"
                                            style="width: max-content">
                                            <span class="fw-bold">Share: </span>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                                                    target="_blank">
                                                    <i class="bi bi-facebook me-2"></i>
                                                    <p class="d-none d-md-block mb-0">
                                                        Facebook
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text=Check%20this%20out!"
                                                    target="_blank">
                                                    <i class="bi bi-twitter me-2"></i>
                                                    <p class="d-none d-md-block mb-0">
                                                        Twitter
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="https://www.instagram.com/"
                                                    target="_blank">
                                                    <i class="bi bi-instagram me-2"></i>
                                                    <p class="d-none d-md-block mb-0">
                                                        Instagram
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <!-- payment attributes -->
                            <div class="d-flex flex-column justify-content-center gap-5 mb-5 mt-5 mt-xl-0">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('css/assets/images/products/delivery_info.png') }}"
                                        alt="Delivery Info" style="width: 20px;">
                                    Free Delivery accross all countries
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('css/assets/images/products/safe_payment.png') }}"
                                        alt="Safe Payment" style="width: 20px;">
                                    Safe Payment
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('css/assets/images/products/return_policy.png') }}"
                                        alt="Return Policy" style="width: 20px;">
                                    7 day return policy
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('css/assets/images/products/authentic_product.png') }}"
                                        alt="Authentic Product" style="width: 20px;">
                                    100% Authentic Products
                                </div>
                            </div>
                            <!-- seller info -->
                            @if (isset($product_detail->vendor))
                                <div
                                    class="d-flex flex-column justify-content-center gap-5 mb-5 p-3 justify-content-between border rounded">
                                    <img src="{{ $product_detail->vendor->logo ?? '' }}" alt="Store Image"
                                        class="rounded-circle mx-auto" style="width: 4rem;height: 4rem">
                                    <h3 class="text-center">{{ $product_detail->vendor->name }}</h3>
                                    <div class="d-flex align-items-center justify-items-center">
                                        <div
                                            class="col-6 align-items-center d-flex flex-column justify-content-center gap-2">
                                            <img src="{{ asset('css/assets/images/icons/review.svg') }}" alt="Reviews"
                                                style="width: 2rem">
                                            <span>{{ $product_detail->reviews_count }} reviews</span>
                                        </div>
                                        <div
                                            class="col-6 align-items-center d-flex flex-column justify-content-center gap-2">
                                            <img src="{{ asset('css/assets/images/icons/delivery.svg') }}" alt="Delivery"
                                                style="width: 2rem">
                                            <span>{{ $total_products }} Products</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('agent-profile', ['id' => $product_detail->vendor->id]) }}">

                                        <button class="btn text-center d-block w-100"
                                            style="background-color: #db3030; color: white;">
                                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            Store
                                        </button>
                                    </a>
                                    <a href="{{ route('message.startchat', ['vendorId' => $product_detail->vendor_id]) }}">
                                     <button class="btn text-center d-block w-100"
                                        style="background-color: #db3030; color: white;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512" fill="#fff" width="14px">
                                            <path
                                                d="M64 0C28.7 0 0 28.7 0 64L0 352c0 35.3 28.7 64 64 64l96 0 0 80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416 448 416c35.3 0 64-28.7 64-64l0-288c0-35.3-28.7-64-64-64L64 0z" />
                                        </svg>
                                        Chat with Vendor
                                     </button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
            </section>
            <section class="mt-lg-14 mt-8">
                <div class="container_sec">
                    <div class="row w-100 justify-content-center mx-auto">
                        <div class="col-md-12">
                            <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                                <!-- nav item -->
                                <li class="nav-item" role="presentation">
                                    <!-- btn -->
                                    <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                        data-bs-target="#product-tab-pane" type="button" role="tab"
                                        aria-controls="product-tab-pane" aria-selected="true">
                                        Product Details
                                    </button>
                                </li>
                                <!-- nav item -->
                                <li class="nav-item" role="presentation">
                                    <!-- btn -->
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-tab-pane" type="button" role="tab"
                                        aria-controls="details-tab-pane" aria-selected="false">
                                        Information
                                    </button>
                                </li>
                                <!-- nav item -->
                                <li class="nav-item" role="presentation">
                                    <!-- btn -->
                                    <button class="nav-link" id="commment-tab" data-bs-toggle="tab"
                                        data-bs-target="#comment-tab-pane" type="button" role="tab"
                                        aria-controls="comment-tab-pane" aria-selected="false">
                                        Comments
                                    </button>
                                </li>
                                <!-- nav item -->
                                <li class="nav-item" role="presentation">
                                    <!-- btn -->
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                        aria-controls="reviews-tab-pane" aria-selected="false">
                                        Reviews
                                    </button>
                                </li>
                                <!-- nav item -->
                                <li class="nav-item" role="presentation">
                                    <!-- btn -->
                                    <button class="nav-link" id="Info-tab" data-bs-toggle="tab"
                                        data-bs-target="#sellerInfo-tab-pane" type="button" role="tab"
                                        aria-controls="sellerInfo-tab-pane" aria-selected="false">
                                        Seller Info
                                    </button>
                                </li>
                                @if ($product_detail->faq_visible == 1)
                                    <li class="nav-item" role="presentation">
                                        <!-- btn -->
                                        <button class="nav-link" id="Info-tab" data-bs-toggle="tab"
                                            data-bs-target="#faq-tab-pane" type="button" role="tab"
                                            aria-controls="faq-tab-pane" aria-selected="false">
                                            Questions & Answers (Faqs)
                                        </button>
                                    </li>
                                @endif

                            </ul>
                            <!-- tab content -->
                            <div class="tab-content" id="myTabContent">
                                <!-- tab pane -->
                                <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                                    aria-labelledby="product-tab" tabindex="0">
                                    <div class="my-8">
                                        {!! $product_detail->description !!}
                                    </div>
                                </div>
                                <!-- tab pane -->
                                <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                    aria-labelledby="details-tab" tabindex="0">
                                    <div class="my-8">
                                        <div class="row w-100">
                                            <div class="col-12">
                                                <h4 class="mb-4">Details</h4>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <table class="table table-striped">
                                                    <!-- table -->
                                                    <tbody>
                                                        <tr>
                                                            <th>Weight</th>
                                                            <td>{{ $product_detail->available_qty }}{{ $product_detail->unit }}
                                                            </td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <th>Ingredient Type</th>
                                                        <td>Vegetarian</td>
                                                    </tr> --}}
                                                        @if ($product_detail && $product_detail->brand)
                                                            <tr>
                                                                <th>Brand</th>
                                                                <td>{{ $product_detail->brand->name }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <th>Item Package Quantity</th>
                                                            <td>{{ $product_detail->capacity }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <th>Form</th>
                                                        <td>Larry the Bird</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Manufacturer</th>
                                                        <td>Dmart</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Net Quantity</th>
                                                        <td>340.0 Gram</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product Dimensions</th>
                                                        <td>9.6 x 7.49 x 18.49 cm</td>
                                                    </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <table class="table table-striped">
                                                    <!-- table -->
                                                    <tbody>
                                                        <tr>
                                                            <th>ASIN</th>
                                                            <td>{{ $product_detail->sku }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <th>Best Sellers Rank</th>
                                                        <td>#2 in Fruits</td>
                                                    </tr> --}}
                                                        <tr>
                                                            <th>Date First Available</th>
                                                            <td>{{ $product_detail->created_at->format('d-M-Y') }}</td>

                                                        </tr>
                                                        <tr>
                                                            <th>Item Weight</th>
                                                            <td>{{ $product_detail->available_qty }}{{ $product_detail->unit }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Generic Name</th>
                                                            <td>{{ $product_detail->name }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- tab pane Comments start-->
                                <div class="tab-pane fade" id="comment-tab-pane" role="tabpanel"
                                    aria-labelledby="comment-tab" tabindex="0">
                                    <section id="commentSection" class="commets_sec py-5">
                                        <div class="wrap container_sec">
                                            <!-- Add comment start -->
                                            <div class="comment-section">
                                                <textarea class="mb-2 comment_text" row="2" id="commentInput" placeholder="Write a comment..."></textarea>
                                                <div id="commentActions" class="mb-4 actions hidden">
                                                    <button class="btn bg-danger text-white"
                                                        id="cancelBtn">Cancel</button>
                                                    <button class="btn bg-primary text-white comment_now"
                                                        data-id="{{ $product_detail->id }}" id="commentBtn"
                                                        disabled>Comment</button>
                                                </div>
                                            </div>
                                            <!-- Add comment start -->


                                            @foreach ($comments as $comment)
                                                <div class="comment d-flex gap-3">
                                                    <figure
                                                        class="m-0 user_image rounded-circle overflow-hidden flex-shrink-0"
                                                        style="width: 4rem;height: 4rem;">
                                                        <img class="object-fit-cover w-100"
                                                            src="https://randomuser.me/api/portraits/men/50.jpg"
                                                            alt="User Image">
                                                    </figure>
                                                    <div class="comment-details">
                                                        <!-- Comment -->
                                                        <div class="p-3 rounded" style="background-color: #f2f4f7;">
                                                            <div class="user_name fw-bold">{{ $comment->user->name ?? "N/A" }}
                                                            </div>
                                                            <p class="m-0" style="max-width: 70ch;">
                                                                {{ $comment->message }}
                                                            </p>
                                                        </div>
                                                        <!--  -->
                                                        <!--Sub comment Start-->
                                                        <!--  -->
                                                        @if ($comment->replies)
                                                            <div class="replies_{{ $comment->id }} hidden"
                                                                id="sub_comment">

                                                                @foreach ($comment->replies as $reply)
                                                                    <div class="comment d-flex gap-3 mt-3 flex-wrap">
                                                                        <figure
                                                                            class="m-0 user_image rounded-circle overflow-hidden flex-shrink-0"
                                                                            style="width: 4rem;height: 4rem;">
                                                                            <img class="object-fit-cover w-100"
                                                                                src="https://randomuser.me/api/portraits/men/50.jpg"
                                                                                alt="User Image">
                                                                        </figure>
                                                                        <div class="comment-details">
                                                                            <div class="p-3 rounded"
                                                                                style="background-color: #f2f4f7;">
                                                                                <div class="user_name fw-bold">
                                                                                    {{ $reply->user->name ?? "N/A"}}
                                                                                </div>
                                                                                <p class="m-0"
                                                                                    style="max-width: 70ch;">
                                                                                    {{ $reply->message ?? "N/A"}}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        @endif
                                                        <!--  -->
                                                        <!--Sub comment End-->
                                                        <!--  -->

                                                        <!-- Toggle User Reply field start -->
                                                        <button class="reply-toggle-btn border-0 bg-white me-3"
                                                            data-comment_id="{{ $comment->id }}">
                                                            Reply
                                                        </button>
                                                        <!-- Toggle User Reply field start -->

                                                        <button class="comment_reply_toggle mt-2 border bg-white border-0"
                                                            data-comment_id="{{ $comment->id }}">
                                                            <svg style="width: 1rem;" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                            {{ $comment->replies->count() }} Replies
                                                        </button>
                                                        <!-- Submit User Reply -->
                                                        <div
                                                            class="reply mt-3 hidden comment_reply_{{ $comment->id }} mb-4">
                                                            <textarea class="p-2 pb-0 w-100 rounded user_reply_{{ $comment->id }}" placeholder="Reply.." name=""
                                                                id=""></textarea>
                                                            <button class="reply_submit btn btn-primary"
                                                                data-product_id="{{ $product_detail->id }}"
                                                                data-comment_id="{{ $comment->id }}">Reply</button>
                                                            <button class="reply_cancel btn btn-danger">Cancel</button>
                                                        </div>
                                                        <!-- Submit User Reply End-->
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </section>
                                </div>
                                <!-- tab pane Comments start-->
                                <!-- tab pane Reviews Start -->
                                <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                    aria-labelledby="reviews-tab" tabindex="0">
                                    <div class="my-8">
                                        <!-- row -->
                                        <div class="row w-100">
                                            <div class="col-md-4">
                                                <div class="me-lg-12 mb-6 mb-md-0">
                                                    <div class="mb-5">
                                                        <!-- title -->
                                                        <h4 class="mb-3">Customer reviews</h4>
                                                        <span>
                                                            <!-- rating -->
                                                            <small class="text-warning">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-half"></i>
                                                            </small>
                                                            <span class="ms-3">{{ $productReviews->avg('rating') }} out
                                                                of 5</span>
                                                            <small class="ms-3">{{ $productReviews->count() }} global
                                                                ratings</small>
                                                        </span>
                                                    </div>
                                                    <div class="mb-8">
                                                        <!-- progress -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span
                                                                    class="d-inline-block align-middle text-muted">5</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar" style="width: 60%"
                                                                        aria-valuenow="60" aria-valuemin="0"
                                                                        aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">53%</span>
                                                        </div>
                                                        <!-- progress -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span
                                                                    class="d-inline-block align-middle text-muted">4</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar" style="width: 50%"
                                                                        aria-valuenow="50" aria-valuemin="0"
                                                                        aria-valuemax="50"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">22%</span>
                                                        </div>
                                                        <!-- progress -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span
                                                                    class="d-inline-block align-middle text-muted">3</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar" style="width: 35%"
                                                                        aria-valuenow="35" aria-valuemin="0"
                                                                        aria-valuemax="35"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">14%</span>
                                                        </div>
                                                        <!-- progress -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span
                                                                    class="d-inline-block align-middle text-muted">2</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar" style="width: 22%"
                                                                        aria-valuenow="22" aria-valuemin="0"
                                                                        aria-valuemax="22"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">5%</span>
                                                        </div>
                                                        <!-- progress -->
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span
                                                                    class="d-inline-block align-middle text-muted">1</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px">
                                                                    <div class="progress-bar bg-warning"
                                                                        role="progressbar" style="width: 14%"
                                                                        aria-valuenow="14" aria-valuemin="0"
                                                                        aria-valuemax="14"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">7%</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-grid">
                                                        <h4>Review this product</h4>
                                                        <p class="mb-0">Share your thoughts with other customers.</p>
                                                        <a href="#"
                                                            class="btn btn-outline-gray-400 mt-4 text-muted">Write
                                                            the
                                                            Review</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- col -->
                                            <div class="col-md-8">
                                                <div class="mb-10">
                                                    <div class="d-flex justify-content-between align-items-center mb-8">
                                                        <div>
                                                            <!-- heading -->
                                                            <h4>Reviews</h4>
                                                        </div>
                                                        <div>
                                                            <select class="form-select">
                                                                <option selected>Top Reviews</option>
                                                                <option value="Most Recent">Most Recent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @foreach ($productReviews as $review)
                                                        <div class="d-flex border-bottom pb-6 mb-6">
                                                            <!-- img -->
                                                            <!-- img -->
                                                            <img src="{{ asset('css/assets/images/avatar/avatar-10.jpg') }}"
                                                                alt="" class="rounded-circle avatar-lg" />
                                                            <div class="ms-5">
                                                                <h6 class="mb-1">{{ $review->user->name }}</h6>
                                                                <!-- select option -->
                                                                <!-- content -->
                                                                <p class="small">
                                                                    <span
                                                                        class="text-muted">{{ $review->created_at }}</span>
                                                                    <span class="text-primary ms-3 fw-bold">Verified
                                                                        Purchase</span>
                                                                </p>
                                                                <!-- rating -->
                                                                <div class="mb-2">
                                                                    @if ($review->rating == 5)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                    @elseif($review->rating == 4)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                    @elseif($review->rating == 3)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                    @elseif($review->rating == 2)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                    @else
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        <i class="bi bi-star text-warning"></i>
                                                                    @endif




                                                                    {{-- <span class="ms-3 text-dark fw-bold">Need to recheck the
                                                                weight
                                                                at delivery point</span> --}}
                                                                </div>
                                                                <!-- text-->
                                                                <p>
                                                                    {{ $review->review }}
                                                                </p>
                                                                <!-- icon -->
                                                                <div class="d-flex justify-content-end mt-4">
                                                                    <a href="#" class="text-muted">
                                                                        <i class="feather-icon icon-thumbs-up me-1"></i>
                                                                        Helpful
                                                                    </a>
                                                                    <a href="#" class="text-muted ms-4">
                                                                        <i class="feather-icon icon-flag me-2"></i>
                                                                        Report abuse
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                    <!-- img -->
                                                    <img src="../assets/images/avatar/avatar-12.jpg" alt=""
                                                        class="rounded-circle avatar-lg" />
                                                    <div class="ms-5">
                                                        <h6 class="mb-1">Robert Thomas</h6>
                                                        <!-- content -->
                                                        <p class="small">
                                                            <span class="text-muted">29 December 2022</span>
                                                            <span class="text-primary ms-3 fw-bold">Verified
                                                                Purchase</span>
                                                        </p>
                                                        <!-- rating -->
                                                        <div class="mb-2">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <span class="ms-3 text-dark fw-bold">Need to recheck the
                                                                weight
                                                                at delivery point</span>
                                                        </div>

                                                        <p>
                                                            Product quality is good. But, weight seemed less than 1kg.
                                                            Since
                                                            it is being sent in open package, there is a possibility of
                                                            pilferage in between.
                                                            FreshCart sends the veggies and fruits through sealed
                                                            plastic
                                                            covers and Barcode on the weight etc. .
                                                        </p>

                                                        <!-- icon -->
                                                        <div class="d-flex justify-content-end mt-4">
                                                            <a href="#" class="text-muted">
                                                                <i class="feather-icon icon-thumbs-up me-1"></i>
                                                                Helpful
                                                            </a>
                                                            <a href="#" class="text-muted ms-4">
                                                                <i class="feather-icon icon-flag me-2"></i>
                                                                Report abuse
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    {{-- <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                    <!-- img -->
                                                    <img src="../assets/images/avatar/avatar-9.jpg" alt=""
                                                        class="rounded-circle avatar-lg" />
                                                    <div class="ms-5">
                                                        <h6 class="mb-1">Barbara Tay</h6>
                                                        <!-- content -->
                                                        <p class="small">
                                                            <span class="text-muted">28 December 2022</span>
                                                            <span class="text-danger ms-3 fw-bold">Unverified
                                                                Purchase</span>
                                                        </p>
                                                        <!-- rating -->
                                                        <div class="mb-2">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <span class="ms-3 text-dark fw-bold">Need to recheck the
                                                                weight
                                                                at delivery point</span>
                                                        </div>

                                                        <p>Everytime i ordered from fresh i got greenish yellow bananas
                                                            just
                                                            like i wanted so go for it , its happens very rare that u
                                                            get
                                                            over riped ones.</p>

                                                        <!-- icon -->
                                                        <div class="d-flex justify-content-end mt-4">
                                                            <a href="#" class="text-muted">
                                                                <i class="feather-icon icon-thumbs-up me-1"></i>
                                                                Helpful
                                                            </a>
                                                            <a href="#" class="text-muted ms-4">
                                                                <i class="feather-icon icon-flag me-2"></i>
                                                                Report abuse
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    {{-- <div class="d-flex border-bottom pb-6 mb-6 pt-4">
                                                    <!-- img -->
                                                    <img src="../assets/images/avatar/avatar-8.jpg" alt=""
                                                        class="rounded-circle avatar-lg" />
                                                    <div class="ms-5 flex-grow-1">
                                                        <h6 class="mb-1">Sandra Langevin</h6>
                                                        <!-- content -->
                                                        <p class="small">
                                                            <span class="text-muted">8 December 2022</span>
                                                            <span class="text-danger ms-3 fw-bold">Unverified
                                                                Purchase</span>
                                                        </p>
                                                        <!-- rating -->
                                                        <div class="mb-2">
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star text-warning"></i>
                                                            <span class="ms-3 text-dark fw-bold">Great product</span>
                                                        </div>

                                                        <p>Great product & package. Delivery can be expedited.</p>

                                                        <div class="d-flex justify-content-end mt-4">
                                                            <a href="#" class="text-muted">
                                                                <i class="feather-icon icon-thumbs-up me-1"></i>
                                                                Helpful
                                                            </a>
                                                            <a href="#" class="text-muted ms-4">
                                                                <i class="feather-icon icon-flag me-2"></i>
                                                                Report abuse
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                    {{-- <div>
                                                    <a href="#" class="btn btn-outline-gray-400 text-muted">Read
                                                        More
                                                        Reviews</a>
                                                </div>
                                            </div> --}}
                                                    {{-- <div>
                                                <!-- rating -->
                                                <h3 class="mb-5">Create Review</h3>
                                                <div class="border-bottom py-4 mb-4">
                                                    <h4 class="mb-3">Overall rating</h4>
                                                    <div class="rater"></div>
                                                </div>
                                                <div class="border-bottom py-4 mb-4">
                                                    <h4 class="mb-0">Rate Features</h4>
                                                    <div class="my-5">
                                                        <h5>Flavor</h5>
                                                        <div class="rater"></div>
                                                    </div>
                                                    <div class="my-5">
                                                        <h5>Value for money</h5>
                                                        <div class="rater"></div>
                                                    </div>
                                                    <div class="my-5">
                                                        <h5>Scent</h5>
                                                        <div class="rater"></div>
                                                    </div>
                                                </div>
                                                <!-- form control -->
                                                <div class="border-bottom py-4 mb-4">
                                                    <h5>Add a headline</h5>
                                                    <input type="text" class="form-control"
                                                        placeholder="What’s most important to know" />
                                                </div>
                                                <div class="border-bottom py-4 mb-4">
                                                    <h5>Add a photo or video</h5>
                                                    <p>Shoppers find images and videos more helpful than text alone.</p>

                                                    <div id="my-dropzone"
                                                        class="dropzone mt-4 border-dashed rounded-2 min-h-0"></div>
                                                </div>
                                                <div class="py-4 mb-4">
                                                    <!-- heading -->
                                                    <h5>Add a written review</h5>
                                                    <textarea class="form-control" rows="3"
                                                        placeholder="What did you like or dislike? What did you use this product for?"></textarea>
                                                </div>
                                                <!-- button -->
                                                <div class="d-flex justify-content-end">
                                                    <a href="#" class="btn btn-primary">Submit Review</a>
                                                </div>
                                            </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tab pane review end --}}
                                    <!-- tab pane -->
                                    <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel"
                                        aria-labelledby="faq-tab" tabindex="0">
                                        <div class="my-8">
                                            @foreach ($productFaqs as $faq)
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                    <div class="p-3 rounded" style="background-color: #f2f4f7;">
                                                        <div class="user_name fw-bold">{{ $faq->question }}</div>
                                                        <p class="m-0" style="max-width: 70ch;">
                                                            {{ $faq->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            @include('livewire.website.modules.ecommerce.section.few_products')

            <!-- similar products section -->

            <section class="my-lg-14 my-8 mb-14">
                <div class="container_sec">
                    <div class="row w-100">
                        <div class="col-12 mb-6 d-flex justify-content-between">
                            <h3 class="mb-0">Similar Products</h3>

                            <a href="#">View All</a>
                        </div>
                    </div>

                    <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
                        @foreach ($similarProducts as $product)
                            <div class="col">
                                <div class="card card-product">
                                    <div class="card-body">
                                        <div class="text-center position-relative">
                                            <div class="position-absolute top-0 start-0">
                                                <span class="badge bg-danger">{{ $vendor_name }}</span>
                                            </div>
                                            @if ($vendor_name === 'Home Services')
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
                                                    <svg style="width: 1.2rem" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="size-6">
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
                                            @if ($vendor_name === 'Home Services')
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
                                                        <line x1="12" y1="5" x2="12"
                                                            y2="19"></line>
                                                        <line x1="5" y1="12" x2="19"
                                                            y2="12"></line>
                                                    </svg>
                                                    Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Latest Products End-->
                    </div>
                </div>
            </section>
    </main>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.comment_now', function() {
                let message = $('.comment_text').val();
                let product_id = $(this).data('id');
                $.ajax({
                    url: '{{ route('comment.store') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        message: message,
                        product_id: product_id,
                    },
                    success: function(response) {
                        $('.message_now').val('');
                        if (response.status == true) {
                            $('#commentSection').html(response.view);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    }
                });
            });

            $(document).on('click', '.reply_submit', function() {
                let comment_id = $(this).data('comment_id');
                let message = $('.user_reply_' + comment_id).val();
                let product_id = $(this).data('product_id');
                $.ajax({
                    url: '{{ route('comment.store') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        message: message,
                        thread_id: comment_id,
                        product_id: product_id
                    },
                    success: function(response) {
                        $('.user_reply_' + comment_id).val('');
                        if (response.status == true) {
                            $('#commentSection').html(response.view);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    }
                });
            });

            $(document).on('click', '.reply-toggle-btn', function() {
                let comment_id = $(this).data('comment_id');
                $('.comment_reply_' + comment_id).toggleClass('hidden');
            });

            $(document).on('click', '.comment_reply_toggle', function() {
                $('.replies_' + $(this).data('comment_id')).toggleClass('hidden');
            });

            $(document).on('focus', '.comment_text', function() {
                $('#commentActions').removeClass('hidden');
            });

            $(document).on('input', '.comment_text', function() {
                const hasText = $(this).val().trim().length > 0;
                const $commentBtn = $(
                    '#commentBtn'); // Replace with the actual button selector if different
                if (hasText) {
                    $commentBtn.prop('disabled', false).addClass('enabled');
                } else {
                    $commentBtn.prop('disabled', true).removeClass('enabled');
                }
            });
        });
    </script>
@endsection
