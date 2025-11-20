@extends('livewire.website.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <style>
        .agent-profile-categories li a {
            display: block;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
        }

        .agent-profile-categories li a:hover,
        .agent-profile-categories li a.active {
            background-color: #f8f9fa;
            color: #dc3545 !important;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <!--  SINGLE BANNER PART START -->
    <section class="single-banner dashboard-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>{{ $vendor_detail->name }}</h2>
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $vendor_detail->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  SINGLE BANNER PART END -->

    <!-- DASHBOARD HEADER PART START -->
    <section class="dash-header-part">
        <div class="container">
            <div class="dash-header-card">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="dash-header-left">
                            <div class="dash-avatar">
                                <a href="#"><img src="{{ $vendor_detail->logo }}" alt="avatar"></a>
                            </div>
                            <div class="dash-intro">
                                <h4><a href="#">{{ $vendor_detail->name }}</a></h4>
                                <h5>{{ $vendor_detail->vendor_type->name }}</h5>
                                <ul class="dash-meta ps-0">
                                    <li>
                                        <i class="fas fa-phone-alt"></i>
                                        <span>{{ $vendor_detail->phone }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $vendor_detail->email }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $vendor_detail->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="dash-header-right">
                            <div class="dash-focus dash-list">
                                <h2>{{ $vendor_detail['products']->count() }}</h2>
                                <p>total uploads</p>
                            </div>
                            <div class="dash-focus dash-rev">
                                <h2>{{ $vendor_detail->reviews_count }}</h2>
                                <p>total review</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-header-alert alert fade show">
                            <p>From your account dashboard. you can easily check & view your recent orders, manage your
                                shipping and billing addresses and Edit your password and account details.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DASHBOARD HEADER PART END -->

    <!--  MY ADS PART START -->
    <section class="myads-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-filter">
                        <div class="filter-show">
                            <label class="filter-label">Show :</label>
                            <select class="custom-select filter-select">
                                <option value="1">12</option>
                                <option value="2">24</option>
                                <option value="3">36</option>
                            </select>
                        </div>
                        <div class="filter-short">
                            <label class="filter-label">Sort by :</label>
                            <select class="custom-select filter-select">
                                <option selected>Latest</option>
                                <option value="1">Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="categories_list">
                        <ul class="p-0 agent-profile-categories">
                            <li class="bg-danger text-white border rounded-top">
                                <i class="fa-solid fa-certificate"></i>
                                Marketplace
                            </li>
                            @foreach ($vendor_products as $product)
                                @if ($product->categories)
                                    @foreach ($product->categories as $category)
                                        <li>
                                            <!-- <i class="fa-solid fa-hammer"></i> -->
                                            <a
                                                href="{{ route('agent-profile-filter', ['id' => $vendor_detail->id, 'categoryId' => $category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <a href="#">
                                            No categories available
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9 mt-sm-3">
                    <div class="row">
                        @foreach ($vendor_products as $product)
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-4">
                                <div class="product-card m-0">
                                    <div class="product-media">
                                        <div class="product-img">
                                            <img src="{{ $product->photo }}" alt="product" style="height: 150px;">
                                        </div>
                                        <div class="cross-vertical-badge product-badge">
                                            <i class="fas fa-fire"></i>
                                            <span>top niche</span>
                                        </div>
                                        <div class="product-type">
                                            <span class="flat-badge sale">sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <ol class="breadcrumb product-category">
                                            @if ($product->categories)
                                                @foreach ($product->categories as $category)
                                                    <li><i class="fas fa-tags"></i></li>
                                                    <li class="breadcrumb-item"><a href="#">
                                                            {{ $category->name }}
                                                @endforeach
                                            @endif
                                            </a></li>
                                            <!-- <li class="breadcrumb-item active" aria-current="page">mobile</li> -->
                                        </ol>
                                        <h6 class="product-title mt-2">
                                            <a href="{{ route('products_view', $product->id) }}"
                                                class="line-clamp-1">{{ $product->name }}</a>
                                        </h6>
                                        <div class="product-meta">
                                            @if ($product->address)
                                                <span><i class="fas fa-map-marker-alt"></i>{{ $product->address }}</span>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-price">{{ currencyFormat($product->price) }}</h6>
                                            <div class="product-btn">
                                                <!-- <a href="#" title="Compare"><i
                                                        class="bi bi-arrow-left-right"></i></a> -->
                                                <button type="button" title="Save" data-id={{ $product->id }}
                                                    style="width: 30px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-14">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9 mt-sm-3" id="products-container">
                    @include('livewire.website.modules.listing.partials.agent_products', [
                        'vendor_products' => $vendor_products,])
                </div> --}}
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="categories_list">
                        <ul class="p-0 agent-profile-categories">
                            <li class="bg-danger text-white border rounded-top">
                                <i class="fa-solid fa-certificate"></i>
                                Marketplace
                            </li>
                            @foreach ($vendor_products as $product)
                                @if ($product->categories)
                                    @foreach ($product->categories as $category)
                                        <li>
                                            <a href="#" class="category-filter"
                                                data-vendor-id="{{ $vendor_detail->id }}"
                                                data-category-id="{{ $category->id }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <a href="#">
                                            No categories available
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9 mt-sm-3" id="products-container">
                    @include('livewire.website.modules.listing.partials.agent_products', [
                        'vendor_products' => $vendor_products,
                    ])
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-pagection">
                        <p class="page-info">Showing {{ $vendor_products->firstItem() }} to
                            {{ $vendor_products->lastItem() }} of {{ $vendor_products->total() }} results</p>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{ $vendor_products->previousPageUrl() }}">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                </a>
                            </li>

                            @foreach ($vendor_products->getUrlRange(1, $vendor_products->lastPage()) as $page => $url)
                                <li class="page-item {{ $vendor_products->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($vendor_products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $vendor_products->nextPageUrl() }}">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  MY ADS PART END -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.category-filter').on('click', function(e) {
                e.preventDefault();

                const vendorId = "{{ $vendor_detail->id }}";
                const categoryId = $(this).data('category-id');

                // Add loading indicator
                $('#products-container').html(
                    '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-3x"></i></div>');

                // Update active state
                $('.category-filter').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: "{{ route('agent-profile', ['id' => $vendor_detail->id]) }}",
                    type: 'GET',
                    data: {
                        category_id: categoryId === 'all' ? null : categoryId
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#products-container').html(response.html);
                    },
                    error: function(xhr) {
                        $('#products-container').html(
                            '<div class="alert alert-danger">Error loading products</div>');
                    }
                });
            });
        });
    </script>
@endsection
