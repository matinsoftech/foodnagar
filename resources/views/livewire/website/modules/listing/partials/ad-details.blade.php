@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .ad-details-slider .item img {
            text-align: center;
            border-radius: 10px;
        }

        .ad-thumb-slider .items img {
            text-align: center;
            border-radius: 10px;
        }

        .carousel-item-details {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .ad-details-slider {
            position: relative;
        }

        .ad-details-slider .owl-nav {
            display: block;
        }

        .ad-details-slider:hover~.owl-nav {
            display: none !important;
        }

        .ad-details-slider .owl-nav button.owl-next,
        .ad-details-slider .owl-nav button.owl-prev {
            width: 30px !important;
            height: 30px !important;
            border-radius: 30px;
            background-color: #fff !important;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .ad-details-slider .owl-nav button.owl-next {
            right: 0 !important;
        }

        .ad-details-slider .owl-nav button.owl-prev {
            left: 0 !important;
        }

        .ad-details-feature {
            position: relative;
        }

        .ad-details-feature .owl-nav {
            display: block;
        }

        .ad-details-slider:hover~.owl-nav {
            display: none !important;
        }

        .ad-details-feature .owl-nav button.owl-next,
        .ad-details-feature .owl-nav button.owl-prev {
            width: 30px !important;
            height: 30px !important;
            border-radius: 30px;
            background-color: #fff !important;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .ad-details-feature .owl-nav button.owl-next {
            right: 0 !important;
        }

        .ad-details-feature .owl-nav button.owl-prev {
            left: 0 !important;
        }

        .bookkmaarrkk-btn {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            text-align: center;
            font-size: 14px;
            margin-right: 8px;
            color: var(--white);
        }

        .bookkmaarrkk-form button {
            text-decoration: none;
        }

        .bookkmaarrkk-form span {
            color: var(--text);
            text-transform: capitalize;
        }

        .share-container {
            position: relative;
            display: inline-block;
        }

        .share-trigger {
            display: flex;
            align-items: center;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .share-options {
            display: none;
            /* Hidden by default */
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .share-container:hover .share-options {
            display: flex;
            /* Show on hover */
            gap: 10px;
        }

        .share-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-decoration: none;
            color: #fff;
            font-size: 18px;
        }

        .share-link:hover {
            opacity: 0.8;
        }

        .bg-primary-fb {
            background-color: #3b5998;
            /* Facebook blue */
        }

        .bg-success-wp {
            background-color: #25D366;
            /* WhatsApp green */
        }

        .bg-info-x {
            background-color: #1DA1F2;
            /* Twitter blue */
        }

        .bg-warning-email {
            background-color: #4285F4;
            /* Email yellow */
        }
    </style>
@endsection

@section('content')
    <main>
        <!--  SINGLE BANNER PART START -->
        {{-- <section class="single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>{{ $product->name }}</h2>
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('listing') }}">{{ $product->vendor_types->name }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- SINGLE BANNER PART END -->
        <!-- AD DETAILS PART START -->
        <section class="inner-section ad-details-part">
            <div class="container">
                <div class="row w-100 m-0">
                    <div class="col-lg-8">
                        <!-- AD DETAILS CARD -->
                        <div class="common-card">
                            <ol class="breadcrumb ad-details-breadcrumb">
                                <li><span class="flat-badge sale">{{ $product->ad_type }}</span></li>
                                <!--<li class="breadcrumb-item"><a href="#">Property</a></li>
                                                                                                                                                                                                                                <li class="breadcrumb-item active" aria-current="page">house</li>-->
                            </ol>
                            <h5 class="ad-details-address">{{ $product->address }}</h5>
                            <h3 class="ad-details-title">{{ $product->name }}</h3>
                            <div class="ad-details-meta">
                                @auth
                                    @if ($isBookmarked)
                                        <form action="{{ route('user-listing-bookmark-delete', $favouriteId) }}"
                                            class="d-flex bookkmaarrkk-form mb-1" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="fas fa-bookmark bg-danger bookkmaarrkk-btn"></i>
                                                <span>Unsave</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('user-listing-bookmark') }}" method="POST"
                                            class="d-flex bookkmaarrkk-form mb-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="fas fa-bookmark bg-secondary bookkmaarrkk-btn"></i>
                                                <span>Save</span>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-link p-0">
                                        <i class="fas fa-bookmark bg-secondary"></i>
                                        <span>Login to Save</span>
                                    </a>
                                @endauth
                                <a class="view mb-1">
                                    <i class="fas fa-eye"></i>
                                    <span>(<strong>{{ $total_listing_view }}</strong>) preview</span>
                                </a>
                                <a href="#review" class="rating mb-1">
                                    <i class="fas fa-star"></i>
                                    <span><strong>{{ $reviewCount }}</strong> review</span>
                                </a>
                                <div class="share-container mb-1">

                                    <div class="share-options">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                                            target="_blank" class="share-link">
                                            <i class="fab fa-facebook bg-primary-fb m-0"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode('Check out this product: ' . Request::url()) }}"
                                            target="_blank" class="share-link">
                                            <i class="fab fa-whatsapp bg-success-wp m-0"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode('Check out this product!') }}"
                                            target="_blank" class="share-link">
                                            <i class="fab fa-twitter bg-info-x m-0"></i>
                                        </a>
                                        <a href="mailto:?subject=Check out this product&body={{ urlencode('Check out this product: ' . Request::url()) }}"
                                            class="share-link">
                                            <i class="fas fa-envelope bg-warning-email m-0"></i>
                                        </a>
                                    </div>
                                    <a href="#" class="share-trigger share">
                                        <i class="fas fa-share-nodes bg-secondary"></i>
                                        <span>Share</span>
                                    </a>
                                </div>

                            </div>



                            <div class="ad-details-slider-group">
                                <div class="ad-details-slider owl-carousel owl-themes mb-4">
                                    <div class="item card" data-hash="slide1"><img
                                            src="{{ $product->getFirstMediaUrl('default') }}" alt="details"
                                            class="Radius-Container">
                                    </div>
                                    {{-- <div class="item card" data-hash="slide2"><img
                                            src="{{ asset('css/assets/images/listing/product/02.jpg') }}" alt="details">
                                    </div>
                                    <div class="item card" data-hash="slide3"><img
                                            src="{{ asset('css/assets/images/listing/product/03.jpg') }}" alt="details">
                                    </div>
                                    <div class="item" data-hash="slide4"><img
                                            src="{{ asset('css/assets/images/listing/product/04.jpg') }}" alt="details">
                                    </div> --}}
                                </div>
                                <div class="cross-vertical-badge ad-details-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                            </div>
                            <div class="ad-thumb-slider owl-carousel navigation">
                                <div class="items  px-2">
                                    <a href="#slide1"><img src="{{ $product->getFirstMediaUrl('default') }}"
                                            alt="details">
                                    </a>
                                </div>
                                {{-- <div class="items px-2">
                                    <a href="#slide2"><img src="{{ asset('css/assets/images/listing/product/02.jpg') }}"
                                            alt="details">
                                    </a>
                                </div>
                                <div class="items  px-2">
                                    <a href="#slide3"><img src="{{ asset('css/assets/images/listing/product/03.jpg') }}"
                                            alt="details">
                                    </a>
                                </div>
                                <div class="items px-2">
                                    <a href="#slide1"><img src="{{ asset('css/assets/images/listing/product/04.jpg') }}"
                                            alt="details">
                                    </a>
                                </div> --}}
                            </div>
                            <!--<div class="ad-details-action">
                                                                                                                                <button type="button" class="wish"><i class="fas fa-heart"></i>bookmark</button>
                                                                                                                                <button type="button"><i class="fas fa-exclamation-triangle"></i>report</button>
                                                                                                                                <button type="button" data-toggle="modal" data-target="#ad-share">
                                                                                                                                    <i class="fas fa-share-alt"></i>
                                                                                                                                    share
                                                                                                                                </button>
                                                                                                                            </div>-->
                        </div>

                        <!--ADs details tabs and pills-->
                        <section class="mt-lg-14 mt-8">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                                            <!-- nav item -->
                                            <li class="nav-item" role="presentation">
                                                <!-- btn -->
                                                <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                                    data-bs-target="#product-tab-pane" type="button" role="tab"
                                                    aria-controls="product-tab-pane" aria-selected="true">
                                                    Details
                                                </button>
                                            </li>
                                            <!-- nav item -->
                                            {{-- <li class="nav-item" role="presentation">
                                                <!-- btn -->
                                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                                    aria-controls="details-tab-pane" aria-selected="false">
                                                    Information
                                                </button>
                                            </li> --}}
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
                                            {{-- @if ($product->faq_visible == 1)
                                            <li class="nav-item" role="presentation">
                                                <!-- btn -->
                                                <button class="nav-link" id=Info-tab" data-bs-toggle="tab"
                                                    data-bs-target="#faq-tab-pane" type="button" role="tab"
                                                    aria-controls="faq-tab-pane" aria-selected="false">
                                                    Questions & Answers (Faqs)
                                                </button>
                                            </li>
                                            @endif --}}

                                        </ul>
                                        <!-- tab content -->
                                        <div class="tab-content" id="myTabContent">
                                            <!-- tab pane -->
                                            <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                                                aria-labelledby="product-tab" tabindex="0">
                                                <div class="my-8">
                                                    {!! $product->description !!}
                                                </div>
                                            </div>
                                            <!-- tab pane -->
                                            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                                aria-labelledby="details-tab" tabindex="0">
                                                <div class="my-8">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h4 class="mb-4">Details</h4>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <table class="table table-striped">
                                                                <!-- table -->
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Weight</th>
                                                                        <td>{{ $product->available_qty }}{{ $product->unit }}
                                                                        </td>
                                                                    </tr>
                                                                    {{-- <tr>
                                                                        <th>Ingredient Type</th>
                                                                        <td>Vegetarian</td>
                                                                    </tr> --}}
                                                                    @if ($product && $product->brand)
                                                                        <tr>
                                                                            <th>Brand</th>
                                                                            <td>{{ $product->brand->name }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th>Item Package Quantity</th>
                                                                        <td>{{ $product->capacity }}</td>
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
                                                                        <td>{{ $product->sku }}</td>
                                                                    </tr>
                                                                    {{-- <tr>
                                                                        <th>Best Sellers Rank</th>
                                                                        <td>#2 in Fruits</td>
                                                                    </tr> --}}
                                                                    <tr>
                                                                        <th>Date First Available</th>
                                                                        <td>{{ $product->created_at->format('d-M-Y') }}
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <th>Item Weight</th>
                                                                        <td>{{ $product->available_qty }}{{ $product->unit }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Generic Name</th>
                                                                        <td>{{ $product->name }}</td>
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
                                                    <div class="wrap container">
                                                        <!-- Add comment start -->
                                                        <div class="comment-section">
                                                            <textarea class="mb-2 comment_text" row="2" id="commentInput" placeholder="Write a comment..."></textarea>
                                                            <div id="commentActions" class="mb-4 actions hidden">
                                                                <button class="btn bg-danger text-white"
                                                                    id="cancelBtn">Cancel</button>
                                                                <button class="btn bg-primary text-white comment_now"
                                                                    data-id="{{ $product->id }}" id="commentBtn"
                                                                    disabled>Comment</button>
                                                            </div>
                                                        </div>
                                                        <!-- Add comment start -->


                                                        {{-- @foreach ($comments as $comment)
                                                        <div class="comment d-flex gap-3">
                                                            <figure class="m-0 user_image rounded-circle overflow-hidden flex-shrink-0"
                                                                style="width: 4rem;height: 4rem;">
                                                                <img class="object-fit-cover w-100"
                                                                    src="https://randomuser.me/api/portraits/men/50.jpg"
                                                                    alt="User Image">
                                                            </figure>
                                                            <div class="comment-details">
                                                                <!-- Comment -->
                                                                <div class="p-3 rounded" style="background-color: #f2f4f7;">
                                                                    <div class="user_name fw-bold">{{ $comment->user->name }}</div>
                                                                    <p class="m-0" style="max-width: 70ch;">
                                                                        {{ $comment->message }}
                                                                    </p>
                                                                </div>
                                                                <!--  -->
                                                                <!--Sub comment Start-->
                                                                <!--  -->
                                                                @if ($comment->replies)
                                                                <div class="replies_{{ $comment->id }} hidden" id="sub_comment">
                
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
                                                                            <div class="p-3 rounded" style="background-color: #f2f4f7;">
                                                                                <div class="user_name fw-bold"> {{ $reply->user->name }}
                                                                                </div>
                                                                                <p class="m-0" style="max-width: 70ch;">
                                                                                    {{ $reply->message }}
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
                                                                <div class="reply mt-3 hidden comment_reply_{{ $comment->id }}">
                                                                    <textarea
                                                                        class="p-2 pb-0 w-100 rounded user_reply_{{ $comment->id }}"
                                                                        placeholder="Reply.." name="" id=""></textarea>
                                                                    <button class="reply_submit btn btn-primary"
                                                                        data-product_id="{{ $product->id }}"
                                                                        data-comment_id="{{ $comment->id }}">Reply</button>
                                                                    <button class="reply_cancel btn btn-danger">Cancel</button>
                                                                </div>
                                                                <!-- Submit User Reply End-->
                                                            </div>
                                                        </div>
                                                        @endforeach --}}


                                                    </div>
                                                </section>
                                            </div>
                                            <!-- tab pane Comments start-->
                                            <!-- tab pane Reviews Start -->
                                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                                aria-labelledby="reviews-tab" tabindex="0">
                                                <div class="my-8">
                                                    <!-- row -->
                                                    <div class="ad-details-review">
                                                        @if ($reviews->isNotEmpty())
                                                            <ul class="review-list">
                                                                @foreach ($reviews as $review)
                                                                    <li class="review-item ">
                                                                        <div class="review-user">
                                                                            <div class="review-head">
                                                                                <div class="review-profile">
                                                                                    {{-- <a href="#" class="review-avatar">
                                                                                        <img src="images/avatar/03.jpg') }}" alt="review">
                                                                                    </a> --}}
                                                                                    <div class="review-meta">
                                                                                        <h6>
                                                                                            <a
                                                                                                href="#">{{ $review->name }}</a><br>
                                                                                            <span>{{ \Carbon\Carbon::parse($review->created_at)->format('F d, Y') }}</span>
                                                                                        </h6>
                                                                                        <ul class="d-flex p-0">
                                                                                            @for ($i = 0; $i < 5; $i++)
                                                                                                <li><i
                                                                                                        class="fas fa-star {{ $i < $review->rating ? 'active' : '' }}"></i>
                                                                                                </li>
                                                                                            @endfor
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="review-desc">
                                                                                {{ $review->description }}</p>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p>No reviews available.</p>
                                                        @endif
                                                        <div class="d-grid">
                                                            <h4>Review this product</h4>
                                                            <p class="mb-0">Share your thoughts with other customers.</p>
                                                            <button type="button" class="btn btn-primary mt-3"
                                                                data-bs-toggle="modal" data-bs-target="#reviewModal">
                                                                Leave a Review
                                                            </button>
                                                        </div>



                                                    </div>
                                                </div>
                                                {{-- Tab pane review end --}}

                                                <!-- tab pane -->
                                                <div class="tab-pane fade" id="faq-tab-pane" role="tabpanel"
                                                    aria-labelledby="faq-tab" tabindex="0">
                                                    <div class="my-8">

                                                        {{-- @foreach ($productFaqs as $faq)
                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            <div class="p-3 rounded" style="background-color: #f2f4f7;">
                                                                <div class="user_name fw-bold">{{ $faq->question }}</div>
                                                                <p class="m-0" style="max-width: 70ch;">
                                                                    {{ $faq->answer }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach --}}

                                                    </div>
                                                </div>



                                            </div>

                                            <div class="tab-pane fade" id="sellerInfo-tab-pane" role="tabpanel"
                                                aria-labelledby="Info-tab" tabindex="0">
                                                <div class="my-8">
                                                    <div class="common-card">
                                                        <div class="ad-details-author">
                                                            @if ($isVendorProduct)
                                                                <!-- Vendor's details -->
                                                                <div class="author-meta">
                                                                    <h4>
                                                                        <a
                                                                            href="{{ route('agent_profile', $product->vendor->id ?? '#') }}">
                                                                            {{ $product->vendor->name ?? 'Vendor not found' }}
                                                                        </a>
                                                                    </h4>
                                                                    <h5>joined:
                                                                        {{ $product->vendor ? $product->vendor->created_at->format('F j, Y') : 'N/A' }}
                                                                    </h5>
                                                                    <p>{!! $product->vendor->description ?? 'No description available' !!}</p>
                                                                </div>
                                                                <div class="author-widget">
                                                                    <a href="{{ route('agent_profile', $product->vendor->id) }}"
                                                                        title="Profile" class="fas fa-eye"></a>
                                                                    <a href="mailto:{{ $product->vendor->email ?? '' }}"
                                                                        title="{{ $product->vendor->email ?? '' }}"
                                                                        class="d-flex justify-content-center align-items-center"
                                                                        data-bs-toggle="tooltip">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </a>
                                                                    <a href="tel:{{ $product->vendor->phone ?? '' }}"
                                                                        type="button" title="Number"
                                                                        class="fas fa-phone" data-toggle="modal"
                                                                        data-target="#number"></a>
                                                                    <button type="button" title="Share"
                                                                        class="fas fa-share-alt" data-toggle="modal"
                                                                        data-target="#profile-share"></button>
                                                                </div>
                                                            @else
                                                                <!-- User's details from UserProductInfo model -->
                                                                <div class="author-meta">
                                                                    <h4><a
                                                                            href="#">{{ $author->user_name ?? 'User not found' }}</a>
                                                                    </h4>
                                                                    <h5>joined:
                                                                        {{ $author->created_at ? $author->created_at->format('F j, Y') : 'N/A' }}
                                                                    </h5>
                                                                    <p>{!! $author->description ?? 'No description available' !!}</p>
                                                                </div>
                                                                <div class="author-widget">
                                                                    {{-- <a href="{{ route('agent_profile', $product->vendor->id ?? '#') }}" title="Profile"
                                                                        class="fas fa-eye"></a> --}}
                                                                    <a href="mailto:{{ $author->user_email ?? '' }}"
                                                                        title="{{ $author->user_email ?? '' }}"
                                                                        class="d-flex justify-content-center align-items-center"
                                                                        data-bs-toggle="tooltip">
                                                                        <i class="fas fa-envelope"></i>
                                                                    </a>
                                                                    <a href="tel:{{ $author->user_phone ?? '' }}"
                                                                        type="button" title="Number"
                                                                        class="fas fa-phone" data-toggle="modal"
                                                                        data-target="#number"></a>
                                                                    <button type="button" title="Share"
                                                                        class="fas fa-share-alt" data-toggle="modal"
                                                                        data-target="#profile-share"></button>
                                                                </div>
                                                            @endif
                                                            <ul class="author-list p-0 px-5">
                                                                <li class="px-5">
                                                                    <h6>total ads</h6>
                                                                    <p>{{ $productCount }}</p>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--ADs details tabs and pills-->
                        <!-- SPECIFICATION CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">specification</h5>
                            </div>
                            <ul class="ad-details-specific">
                                <li>
                                    <h6>Price:</h6>
                                    <p>{{ $product->price }}</p>
                                </li>
                                <li>
                                    <h6>Seller Type:</h6>
                                    <p>personal</p>
                                </li>
                                <li>
                                    <h6>Published:</h6>
                                    <p>{{ $product->created_at->format('F j, Y') }}</p>
                                </li>
                                <li>
                                    <h6>Location:</h6>
                                    <p>{{ $product->address }}</p>
                                </li>
                                <li>
                                    <h6>Category:</h6>
                                    <p>{{ $product->vendor_types->name }}</p>
                                </li>
                                <li>
                                    <h6>Condition:</h6>
                                    <p>used</p>
                                </li>
                                <li>
                                    <h6>Price Type:</h6>
                                    <p>Negotiable</p>
                                </li>
                                <li>
                                    <h6>Ad Type:</h6>
                                    <p>{{ $product->ad_type }}</p>
                                </li>
                            </ul>
                        </div>
                        <!-- DESCRIPTION CARD -->




                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">Related Listing</h5>
                            </div>
                            <div class="row mx-0">
                                @foreach ($related_product as $productss)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3 px-2">
                                        <div class="product-card card m-0">
                                            <div class="">
                                                <a href="{{ route('products_view', $productss->id) }}"
                                                    class="text-inherit text-decoration-none line-clamp-1">
                                                    <div class="product-card card m-0 position-relative">
                                                        <div class="product-media">
                                                            <div class="product-img">
                                                                <img src="{{ $productss->getFirstMediaUrl('default') }}"
                                                                    alt="product" height="200">
                                                            </div>
                                                            <div class="cross-vertical-badge product-badge">
                                                                <i class="fas fa-clipboard-check"></i>
                                                                <span>recommend</span>
                                                            </div>
                                                            <div class="product-type">
                                                                <span class="flat-badge booking">booking</span>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            @if ($productss->address != null)
                                                                <ol class="breadcrumb product-category">
                                                                    <li><i class="fas fa-map-marker-alt"></i></li>
                                                                    <li class="breadcrumb-item active"
                                                                        aria-current="page">
                                                                        {{ $productss->address }}</li>
                                                                </ol>
                                                            @else
                                                            @endif
                                                            <h2 class="fs-6">
                                                                <a href="{{ route('products_view', $productss->id) }}"
                                                                    class="text-inherit text-decoration-none line-clamp-1">
                                                                    {{ $productss->name }}
                                                                </a>
                                                            </h2>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <span class="text-dark">
                                                                        {{ currencyFormat($productss->discount_price ? $productss->discount_price : $productss->price) }}<span>/{{ $productss->unit }}</span>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <button type="button" title="Wishlist"
                                                                        class="add_favourite product-btn"
                                                                        data-id={{ $productss->id }}
                                                                        style="width: 30px; border: unset; background: unset; border-left: 1px solid #e8e8e8; margin-left: 8px; padding-left: 12px;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="size-6">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z">
                                                                            </path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!--Enquiry Button-->
                        <div class="common-card">
                            <button type="button" class="btn border-primary w-100 mb-2 fs-5" data-toggle="modal"
                                data-target="#enquiryModal{{ $product->id }}" data-product-id="{{ $product->id }}">
                                Make an Enquiry
                            </button>
                        </div>
                        <!-- PRICE CARD -->
                        <div class="common-card price">
                            <h3 class="d-flex gap-3">{{ $product->price }}<span>/{{ $product->unit }}</span></h3>
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="common-card row mx-0">
                            <div
                                class="col-lg-6 col-md-6 col-sm-6 col-6 ps-0 d-flex justify-content-center align-items-center">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#uniqueModal1">
                                    <i class="fa-solid fa-phone me-2 fa-xl"></i> <br>
                                    View Phone
                                </button>
                            </div>
                            <div
                                class="col-lg-6 col-md-6 col-sm-6 col-6 pe-0 d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#uniqueModal2">
                                    <i class="fa-solid fa-envelope me-2 fa-xl"></i> <br>
                                    View Email
                                </button>
                            </div>
                        </div>
                        <!-- NUMBER CARD -->

                        <!-- LOCATION CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">Area Map</h5>
                            </div>
                            @if (!empty($product->address))
                                @php
                                    $mapAddress = urlencode($product->address);
                                @endphp
                                <iframe class="ad-details-map"
                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDumdDv9jxmpC0yaURPXnqkk4kssB8R3C4&q={{ $mapAddress }}"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <p>Address not available</p>
                            @endif
                        </div>
                        <!-- AUTHOR CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">author infos</h5>
                            </div>
                            <div class="ad-details-author">
                                {{-- <a href="#" class="author-img active">
                                    <img src="images/avatar/01.jpg') " alt="avatar">
                                </a> --}}
                                @if ($isVendorProduct)
                                    <div class="author-meta">
                                        <h4><a
                                                href="{{ route('agent_profile', $product->vendor->id ?? '#') }}">{{ $product->vendor->name ?? 'Vendor not found' }}</a>
                                        </h4>
                                        <h5>joined:
                                            {{ $product->vendor ? $product->vendor->created_at->format('F j, Y') : 'N/A' }}
                                        </h5>
                                        <p>{!! $product->vendor->description ?? 'No description available' !!}</p>
                                    </div>
                                    <div class="author-widget">
                                        <a href="{{ route('agent_profile', $product->vendor->id ?? '#') }}"
                                            title="Profile" class="fas fa-eye"></a>
                                        <a href="mailto:{{ $product->vendor->email ?? '' }}"
                                            title="{{ $product->vendor->email ?? '' }}"
                                            class="d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <!--<button type="button" title="Follow" class="follow fas fa-heart"></button>-->
                                        <a href="tel:{{ $product->vendor->phone ?? '' }}" type="button" title="Number"
                                            class="fas fa-phone" data-toggle="modal" data-target="#number"></a>
                                        {{-- <button type="button" title="Share" class="fas fa-share-alt" data-toggle="modal"
                                        data-target="#profile-share"></button> --}}
                                    </div>
                                @else
                                    <div class="author-meta">
                                        <h4><a href="#">{{ $author->user_name ?? 'User not found' }}</a>
                                        </h4>
                                        <h5>joined:
                                            {{ $author->created_at ? $author->created_at->format('F j, Y') : 'N/A' }}
                                        </h5>
                                        <p>{!! $author->description ?? 'No description available' !!}</p>
                                    </div>
                                    <div class="author-widget">
                                        {{-- <a href="{{ route('agent_profile', $product->vendor->id) }}" title="Profile" class="fas fa-eye"></a> --}}
                                        <a href="mailto:{{ $author->user_email ?? '' }}"
                                            title="{{ $author->user_email ?? '' }}"
                                            class="d-flex justify-content-center align-items-center"
                                            data-bs-toggle="tooltip">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <a href="tel:{{ $author->user_phone ?? '' }}" type="button" title="Number"
                                            class="fas fa-phone" data-toggle="modal" data-target="#number"></a>
                                        <button type="button" title="Share" class="fas fa-share-alt"
                                            data-toggle="modal" data-target="#profile-share"></button>
                                    </div>
                                @endif
                                <ul class="author-list p-0">
                                    <li>
                                        <h6>total ads</h6>
                                        <p>{{ $productCount }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- SAFETY CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">safety tips</h5>
                            </div>
                            <div class="ad-details-safety">
                                <p>Check the item before you buy</p>
                                <p>Pay only after collecting item</p>
                                <p>Beware of unrealistic offers</p>
                                <p>Meet seller at a safe location</p>
                                <p>Do not make an abrupt decision</p>
                                <p>Be honest with the ad you post</p>
                            </div>
                        </div>
                        <!-- FEATURE CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">featured ads</h5>
                            </div>
                            <div class="ad-details-feature owl-carousel owl-themes ">
                                @foreach ($products_all as $all_product)
                                    <div class="feature-card">
                                        <a href="{{ route('products_view', $all_product->id) }}" class="feature-img">
                                            <img src="{{ $all_product->getFirstMediaUrl('default') }}" height="200"
                                                alt="feature">
                                        </a>
                                        <div class="cross-inline-badge feature-badge">
                                            <span>featured</span>
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                        <button type="button" class="feature-wish">
                                            <i class="fas fa-bookmark "></i>
                                        </button>
                                        <div class="feature-content">
                                            <ol class="breadcrumb feature-category">
                                                <li><span class="flat-badge rent">Rent</span></li>
                                                <li class="breadcrumb-item"><a
                                                        href="#">{{ $all_product->vendor_types->name }}</a></li>
                                                <!--<li class="breadcrumb-item active" aria-current="page">private car</li>-->
                                            </ol>
                                            <h3 class="feature-title"><a
                                                    href="{{ route('products_view', $all_product->id) }}">{{ $all_product->name }}</a>
                                            </h3>
                                            <div class="feature-meta">
                                                <span
                                                    class="feature-price">{{ $all_product->price }}<small>/{{ $all_product->unit }}</small></span>
                                                <span class="feature-time"><i
                                                        class="fas fa-clock"></i>{{ $all_product->created_at->format('F j, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- AD DETAILS PART END -->

        {{-- <button type="button" class="btn border-primary w-100 mb-2 d-none" data-bs-toggle="modal"
                data-bs-target="#enquiryModal{{ $product->id }}">
                Make an Enquiry
            </button> --}}
        <!--Make an Enquiry Modal-->
        <div class="modal fade" id="enquiryModal{{ $product->id }}" tabindex="-1"
            aria-labelledby="enquiryModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="enquiryModalLabel{{ $product->id }}">Make an Enquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('product.enquiry.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="mb-3">
                                <label for="name{{ $product->id }}" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name{{ $product->id }}" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $product->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $product->id }}" name="email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="subject{{ $product->id }}" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject{{ $product->id }}"
                                    name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message{{ $product->id }}" class="form-label">Message</label>
                                <textarea class="form-control" id="message{{ $product->id }}" name="message" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--View Mobile Number Modal-->
        <div class="modal fade" id="uniqueModal1" tabindex="-1" aria-labelledby="uniqueModal1Label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered and larger modal -->
                <div class="modal-content shadow-lg border-0 rounded"> <!-- Added shadow and removed border -->
                    <div class="modal-header"> <!-- Success-colored header -->
                        <h5 class="modal-title" id="uniqueModal1Label">Vendor Contact</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @auth
                            @if ($isVendorProduct)
                                <p class="lead text-center">
                                    <strong>Phone:</strong> {{ $product->vendor->phone ?? '' }}
                                </p>
                            @else
                                <p class="lead text-center">
                                    <strong>Phone:</strong> {{ $product->user_phone ?? '' }}
                                </p>
                            @endif
                            <!-- Add more vendor details if needed -->
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                Please <a href="{{ route('login') }}" class="alert-link">log in</a> to access vendor contact
                                details.
                            </div>
                        @endauth
                    </div>
                    <div class="modal-footer bg-light"> <!-- Subtle background for the footer -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @auth
                            @if ($isVendorProduct)
                                <a href="tel:{{ $product->vendor->phone ?? '' }}" class="btn btn-success">
                                    Call Vendor
                                </a>
                            @else
                                <p class="lead text-center">
                                    <strong>Phone:</strong> {{ $product->user->user_email ?? '' }}
                                </p>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>


        <!-- View Email Address Modal -->
        <div class="modal fade" id="uniqueModal2" tabindex="-1" aria-labelledby="uniqueModal2Label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered and larger modal -->
                <div class="modal-content shadow-lg border-0 rounded"> <!-- Added shadow and removed border -->
                    <div class="modal-header"> <!-- Primary-colored header -->
                        <h5 class="modal-title" id="uniqueModal2Label">Vendor Information</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @auth
                            @if ($isVendorProduct)
                                <p class="lead text-center">
                                    <strong>Email:</strong> {{ $product->vendor->email ?? '' }}
                                </p>
                            @else
                                <p class="lead text-center">
                                    <strong>Email:</strong> {{ $product->email ?? '' }}
                                </p>
                            @endif
                            <!-- Add additional vendor info or styling as needed -->
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                Please <a href="{{ route('login') }}" class="alert-link">log in</a> to view vendor
                                information.
                            </div>
                        @endauth
                    </div>
                    <div class="modal-footer bg-light"> <!-- Subtle background for the footer -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @auth
                            <a href="mailto:{{ $product->vendor->email ?? '' }}" type="button"
                                class="btn btn-primary">Contact
                                Vendor</a>
                            <!-- Optional additional action -->
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalLabel">Rate and Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="review-form" action="{{ route('review.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star-1" value="1"><label
                                    for="star-1"></label>
                                <input type="radio" name="rating" id="star-2" value="2"><label
                                    for="star-2"></label>
                                <input type="radio" name="rating" id="star-3" value="3"><label
                                    for="star-3"></label>
                                <input type="radio" name="rating" id="star-4" value="4"><label
                                    for="star-4"></label>
                                <input type="radio" name="rating" id="star-5" value="5"><label
                                    for="star-5"></label>
                            </div>
                            <div class="review-form-grid">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control custom-select" name="quote" required>
                                        <option value="" disabled selected>Quote</option>
                                        <option value="delivery system">Delivery System</option>
                                        <option value="product quality">Product Quality</option>
                                        <option value="payment issue">Payment Issue</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description" placeholder="Describe"></textarea>
                            </div>
                            <button type="submit" class="btn btn-inline review-submit">
                                <i class="fas fa-tint"></i>
                                <span>Drop your review</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const enquiryButtons = document.querySelectorAll('[data-toggle="modal"]');

            enquiryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Close other modals if necessary
                    const openModal = document.querySelector('.modal.show');
                    if (openModal) {
                        bootstrap.Modal.getInstance(openModal).hide();
                    }

                    // Open the clicked modal
                    const targetModal = document.querySelector(this.getAttribute('data-target'));
                    const modalInstance = new bootstrap.Modal(targetModal);
                    modalInstance.show();
                });
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    confirmButtonText: 'Try Again'
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

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

    <script>
        $(document).on('click', '.bookmark-btn', function() {
            const button = $(this);
            const productId = button.data('product-id');
            const isBookmarked = button.data('bookmarked');

            $.ajax({
                url: isBookmarked ? '/user-listing-bookmark-delete' : '/user-listing-bookmark',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                },
                success: function(response) {
                    // Toggle UI based on response
                    button.data('bookmarked', !isBookmarked);
                    button.find('i').toggleClass('fas far');
                    button.find('span').text(!isBookmarked ? 'Unsave' : 'Save');
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    </script>
@endsection
