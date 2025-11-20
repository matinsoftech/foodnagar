@extends('livewire.website.layouts.app')

@section('content')
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
                                <li class="breadcrumb-item"><a href="{{ url('e-commerce') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('vendor-list') }}">Stores</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $vendor->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12 col-lg-3 col-md-4 mb-4 mb-md-0">
                        <div class="d-flex flex-column">
                            <div>
                                <!-- img -->
                                <!-- img -->
                                <img src="{{ $vendor->logo }}" alt=""
                                    class="rounded-circle icon-shape icon-xxl" />
                            </div>
                            <!-- heading -->
                            <div class="mt-4">
                                <h1 class="mb-1 h4">{{ $vendor->name }}</h1>
                                <div class="small text-muted">
                                    <span>Everyday store prices</span>
                                </div>

                                <div>
                                    <span>
                                        <a href="tel:+1234567890">
                                            <small>
                                                <i class="fa-solid fa-phone me-1"></i>
                                                {{ $vendor->phone }}
                                            </small>
                                        </a>
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <a href="tel:+{{ $vendor->phone }}">
                                            <small>
                                                <i class="fa-solid fa-location-dot me-1"></i>
                                                {{ $vendor->address }}
                                            </small>
                                        </a>
                                    </span>
                                </div>

                                <div>
                                    <span>
                                        <small><a href="#!">100% satisfaction guarantee</a></small>
                                    </span>
                                </div>
                                <!-- rating -->
                                <div class="mt-2">
                                    <!-- rating -->
                                    <small class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </small>
                                    <span class="ms-2">5.0</span>
                                    <!-- text -->
                                    <span class="text-muted ms-1">(3,400 reviews)</span>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <!-- nav -->
                        <div>
                            <ul class="nav flex-column nav-links">
                                @foreach($categories as $category)
                                <!-- nav item -->
                                <li class="nav-item">
                                    <a href="{{ url('category-products/'.$category->id) }}" class="nav-link">{{ $category->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr />
                    </div>
                    <div class="col-12 col-lg-9 col-md-8">
                        <div class="mb-8 bg-light d-lg-flex justify-content-lg-between rounded">
                            <div class="align-self-center p-8">
                                <div class="mb-3">
                                    <h5 class="mb-0 fw-bold">{{ $vendor->name }}</h5>
                                    <p class="mb-0 text-muted">Whatever the occasion, weve got you covered.</p>
                                </div>
                                <div class="position-relative">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Search E-Grocery Super Market" />
                                    <span class="position-absolute end-0 top-0 mt-2 me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="py-4">
                                <!-- img -->
                                <img src="{{ asset('css/assets/images/svg-graphics/store-graphics.svg') }}" alt=""
                                    class="img-fluid" />
                            </div>
                        </div>

                        <div class="d-md-flex justify-content-between mb-3 align-items-center">
                            <div>
                                <p class="mb-3 mb-md-0">{{ $products->count() }} Products found</p>
                            </div>
                            <div class="d-flex justify-content-md-between align-items-center">
                                <div class="me-2">
                                    <!-- select option -->
                                    <select class="form-select">
                                        <option selected>Show: 50</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                                <div>
                                    <!-- select option -->
                                    <select class="form-select">
                                        <option selected>Sort by: Featured</option>
                                        <option value="Low to High">Price: Low to High</option>
                                        <option value="High to Low">Price: High to Low</option>
                                        <option value="Release Date">Release Date</option>
                                        <option value="Avg. Rating">Avg. Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- row -->

                        <!-- All  Products Start-->
                        <!-- row -->
                        <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                            @foreach($products as $product)
                            <div class="col">
                                <!-- card -->
                                <div class="card card-product">
                                    <div class="card-body">
                                        <div class="text-center position-relative">
                                            <!-- badge -->
                                            <div class="position-absolute top-0 start-0">
                                                <span class="badge bg-danger">Sale</span>
                                            </div>
                                            <a href="#!">
                                                <!-- img -->
                                                <img src="{{ $product->getFirstMediaUrl('default') }}"
                                                    alt="{{ $product->name }}" class="mb-3 img-fluid" style="height: 174.8px;" />
                                            </a>
                                            <!-- btn action -->
                                            <div class="card-product-action">
                                                <a href="#!" class="btn-action" data-bs-toggle="modal"
                                                    data-bs-target="#quickViewModal">
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"></i>
                                                </a>
                                                <a href="#!" class="btn-action" data-bs-toggle="tooltip"
                                                    data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                                <a href="#!" class="btn-action" data-bs-toggle="tooltip"
                                                    data-bs-html="true" title="Compare"><i
                                                        class="bi bi-arrow-left-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-small mb-1">
                                            <a href="#" class="text-decoration-none text-muted line-clamp-1">
                                                <small> 
                                                @foreach($product->categories as $category)
                                                    @if(!$loop->last)
                                                    {{ $category->name }}  ,
                                                    @else
                                                    {{ $category->name }}
                                                    @endif
                                                @endforeach
                                                </small>
                                            </a>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="#!" class="text-inherit text-decoration-none line-clamp-1">
                                                @foreach($product->sub_categories as $category)
                                                    @if(!$loop->last)
                                                    {{ $category->name }}  ,
                                                    @else
                                                    {{ $category->name }}
                                                    @endif
                                                @endforeach
                                            </a>
                                            {{ $product->name }}
                                        </h2>
                                        <div>
                                            <!-- rating -->
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <!-- text -->
                                            <span class="text-muted small">4.5(149)</span>
                                        </div>
                                        <!-- price -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <span class="text-dark">Rs. {{ $product->price - $product->discount_price }}</span>
                                                <span class="text-decoration-line-through text-muted">Rs. {{ $product->price  }}</span>
                                            </div>
                                            <div>
                                                <!-- btn -->
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn" data-id="{{ $product->id }}">
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
                        </div>
                        <!-- All Products End-->

                        <!-- pagination -->
                        <div class="row mt-8">
                            <div class="col">
                                <!-- nav -->
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link mx-1" href="#" aria-label="Previous">
                                                <i class="feather-icon icon-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link mx-1 active" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link mx-1" href="#">2</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link mx-1" href="#">...</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link mx-1" href="#">12</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link mx-1" href="#" aria-label="Next">
                                                <i class="feather-icon icon-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
