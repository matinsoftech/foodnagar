@extends('livewire.website.layouts.app')

@section('css')
@endsection


@section('content')
    <!-- section-->
    <main>
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Store List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mt-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- heading -->
                        <div class="bg-light d-flex justify-content-between ps-md-10 ps-6 rounded">
                            <div class="d-flex align-items-center">
                                <h1 class="mb-0 fw-bold">Stores</h1>
                            </div>
                            <div class="py-6">
                                <!-- img -->
                                <!-- img -->
                                <img src="{{ asset('css/assets/images/svg-graphics/store-graphics.svg') }}" alt=""
                                    class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section -->
        <section class="mt-8 mb-lg-14 mb-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="mb-3">
                            <!-- text -->
                            <h6>
                                We have
                                <span class="text-primary">36</span>
                                vendors now
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-6 col-sm-12 px-2 pb-4 text-center">
                        <a href="#" class="others-store-card text-capitalize">
                            <div class="overflow-hidden other-store-banner">
                                <img src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg"
                                    class="w-100 h-100 object-cover" alt="store-banner-image">
                            </div>
                            <div class="name-area">
                                <div class="position-relative">
                                    <div class="overflow-hidden other-store-logo rounded-full">
                                        <img class="rounded-full"
                                            src="https://altic.com.np/storage/307/1DuOC-1733387353.jpg" alt="store-images">
                                    </div>
                                </div>
                                <div class="info pt-2">
                                    <h5>aa</h5>
                                    <div class="d-flex align-items-center">
                                        <h6 style="color:#ff6600">0.0</h6>
                                        <i class="tio-star text-star mx-1"></i>
                                        <small>Rating</small>
                                    </div>
                                </div>
                            </div>
                            <div class="info-area">
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Reviews</span>
                                </div>
                                <div class="info-item">
                                    <h6 style="color:#ff6600">0</h6>
                                    <span>Products</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
@endsection
