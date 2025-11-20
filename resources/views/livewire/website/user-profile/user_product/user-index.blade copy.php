@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <style>
        .adpost-card {
            padding: 0;
            background: unset;
        }

        .adpost-title {
            border-bottom: unset;
        }

        .adpost-title::before {
            display: none;
        }
    </style>
@endsection
@section('content')
    <main>
        <!-- section -->
        <section>
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                                aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>
                    @include('livewire.website.user-profile.account-sidebar')
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-0 p-lg-0">


                            <div class="adpost-title m-0 mt-4">
                                <h3>My Products</h3>
                            </div>
                            <div class="row">
                                @forelse($user_product as $product)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow">
                                            <div class="position-relative">
                                                @if ($product->getFirstMediaUrl('images'))
                                                    <img src="{{ $product->getFirstMediaUrl('images') }}"
                                                        alt="Product Image" class="card-img-top">
                                                @else
                                                    <img src="default-image.jpg" alt="No Image Available"
                                                        class="card-img-top">
                                                @endif
                                                <span
                                                    class="badge bg-danger text-white position-absolute top-0 end-0 m-2">Booking</span>
                                            </div>
                                            <div class="card-body">
                                                <!--<div class="d-flex justify-content-between mb-2">
                                                    <span class="badge bg-light text-dark border">Luxury</span>
                                                    <span class="badge bg-light text-dark border">Duplex House</span>
                                                </div>-->
                                                <h5 class="card-title mb-2"><a href="{{ route('products_view', $product->id) }}">{{ $product->name }}</a></h5>
                                                <p class="text-muted mb-2">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                    {{ $product->city->municipality_name ?? 'N/A' }}
                                                    <span class="mx-2">|</span>
                                                    <i class="bi bi-calendar-event"></i>
                                                    {{ $product->created_at->format('F d, Y') }}
                                                </p>
                                                <h6 class="text-primary mb-2">₹ {{ number_format($product->price, 2) }}</h6>
                                            </div>
                                            {{--<div class="card-footer bg-white border-top-0">
                                                <button class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-bookmark"></i>
                                                </button>
                                            </div>--}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-warning text-center">No products available.</div>
                                    </div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
