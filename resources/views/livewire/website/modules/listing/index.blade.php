@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <style>
        .navbar {
            z-index: 3;
        }

        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }
    </style>
@endsection
@section('content')
    <main>
        <!-- BANNER PART START -->
        <section class="banner-part">
            <div class="container">
                <div class="banner-content">
                    <h1>Connecting Builders, Suppliers, and Innovators.</h1>
                    <p>The Marketplace that Builds Together.
                        <br>Uniting the Construction World.
                    </p>
                    <a href="{{ route('view.all.listing') }}" class="btn btn-outline" style="z-index:5;">
                        <i class="fas fa-eye"></i>
                        <span>Show all ads</span>
                    </a>
                </div>
            </div>
        </section>
        <!-- BANNER PART END -->

        <!-- SUGGEST PART START -->
        <section class="suggest-part">
            <div class="container">
                <div class="suggest-slider listing-categories owl-carousel owl-theme">
                    @foreach ($categories as $category)
                        <a href="{{ route('view.all.listing') }}" class="suggest-card">
                            <img src="{{ $category->getFirstMediaUrl('default') }}" alt="car">
                            <h6 class="line-clamp-1">{{ $category->name }}</h6>
                            <!--<p>(4,521) ads</p>-->
                        </a>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- SUGGEST PART END -->

        <!-- RECOMEND PART START -->
        <section class="section recomend-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-center-heading">
                            <h2>Our Featured <span>Listings</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="listing-recomend-slider owl-carousel owl-theme">
                            @foreach ($products as $product)
                                <div class="product-card card">
                                    <a href="{{ route('products_view', $product->id) }}"
                                        class="text-inherit text-decoration-none line-clamp-1">
                                        <div class="product-media">
                                            <div class="product-img">
                                                <img src="{{ $product->getFirstMediaUrl('default') }}" alt="product"
                                                    height="200">
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
                                            @if ($product->address != null)
                                                <ol class="breadcrumb product-category">
                                                    <li><i class="fas fa-map-marker-alt"></i></li>
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        {{ $product->address }}</li>
                                                </ol>
                                            @else
                                            @endif
                                            <h2 class="fs-6">
                                                <a href="{{ route('products_view', $product->id) }}"
                                                    class="text-inherit text-decoration-none line-clamp-1">
                                                    {{ $product->name }}
                                                </a>
                                            </h2>
                                            {{-- <div class="product-meta">
                                            <span><i class="fas fa-map-marker-alt"></i>{{ $product->address }}</span>
                                            <span><i
                                                    class="fas fa-clock"></i>{{ $product->created_at->format('F j, Y') }}</span>
                                        </div> --}}
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="text-dark">
                                                        {{ currencyFormat($product->discount_price ? $product->discount_price : $product->price) }}<span>/{{ $product->unit }}</span>
                                                    </span>
                                                </div>
                                                <div>
                                                    <button type="button" title="Wishlist"
                                                        class="add_favourite product-btn" data-id={{ $product->id }}
                                                        style="width: 30px; border: unset; background: unset; border-left: 1px solid #e8e8e8; margin-left: 8px; padding-left: 12px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="center-50">
                            <a href="{{ route('view.all.listing') }}" class="btn btn-inline">
                                <i class="fas fa-eye"></i>
                                <span>VIEW ALL LISTINGS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- RECOMEND PART START -->

        <!-- POPULAR PART START -->
        <section class="section recomend-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-center-heading">
                            <h2>Our Popular <span>Listings</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($popular_products as $product)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 px-2">
                            <div class="">
                                <a href="{{ route('products_view', $product->id) }}"
                                    class="text-inherit text-decoration-none line-clamp-1">
                                    <div class="product-card card m-0 position-relative">
                                        <div class="product-media">
                                            <div class="product-img">
                                                <img src="{{ $product->getFirstMediaUrl('default') }}" alt="product"
                                                    height="200">
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
                                            @if ($product->address != null)
                                                <ol class="breadcrumb product-category">
                                                    <li><i class="fas fa-map-marker-alt"></i></li>
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        {{ $product->address }}</li>
                                                </ol>
                                            @else
                                            @endif
                                            <h2 class="fs-6">
                                                <a href="{{ route('products_view', $product->id) }}"
                                                    class="text-inherit text-decoration-none line-clamp-1">
                                                    {{ $product->name }}
                                                </a>
                                            </h2>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="text-dark">
                                                        {{ currencyFormat($product->discount_price ? $product->discount_price : $product->price) }}<span>/{{ $product->unit }}</span>
                                                    </span>
                                                </div>
                                                <div>
                                                    <button type="button" title="Wishlist"
                                                        class="add_favourite product-btn" data-id={{ $product->id }}
                                                        style="width: 30px; border: unset; background: unset; border-left: 1px solid #e8e8e8; margin-left: 8px; padding-left: 12px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
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
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="center-50">
                            <a href="{{ route('view.all.listing') }}" class="btn btn-inline">
                                <i class="fas fa-eye"></i>
                                <span>VIEW ALL LISTINGS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- NICHE PART END -->
        <!-- CITY PART START -->
        <section class="section city-part mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-center-heading">
                            <h2>Top Cities by <span>Ads</span></h2>
                        </div>
                    </div>
                </div>
                <div class="listing-cities-slider owl-carousel owl-theme">
                    @php
                        $unique_cities = $products->pluck('address')->filter()->unique();
                    @endphp

                    {{-- @foreach ($unique_cities as $city)
                        <div class="">
                            <a class="city-card_a" href="{{ route('view.all.listing', ['cities[]' => $city]) }}">
                                <div class="city-card grid item animated zoomIn">
                                    <div class="card p-5">
                                        <p class="card-title">{{ $city }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach --}}

                    <div class="">
                        <a class="city-card_a" href="#">
                            <div class="city-card grid item animated zoomIn">
                                <div class="card p-5">
                                    <p class="card-title">Biratnagar</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="">
                        <a class="city-card_a" href="#">
                            <div class="city-card grid item animated zoomIn">
                                <div class="card p-5">
                                    <p class="card-title">Biratnagar</p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="center-20">
                            <a href="#" class="btn btn-inline">
                                <i class="fas fa-eye"></i>
                                <span>VIEW ALL CITIES</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <!-- CITY PART END -->
    </main>
@endsection

<!-- Add this in the <head> section -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--<script>
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
</script>-->

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
        });
    </script>
@endif
