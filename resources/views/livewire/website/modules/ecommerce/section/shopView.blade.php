@extends('livewire.website.layouts.app')
@section('css')
<style>
    #product-container {
        display: grid;
        gap: 1rem;
    }

    .layout-link i {
        color: rgba(92, 108, 117, 0.75);
        /* Default color for inactive icons */
        transition: color 0.3s ease;
    }

    .layout-link.active i {
        color: #662f88;
        /* Active icon color */
    }


    .grid-2 {
        grid-template-columns: repeat(3, 1fr);
    }

    .grid-3 {
        grid-template-columns: repeat(4, 1fr);
    }

    .list {
        grid-template-columns: 1fr;
    }

    .list .card-body {
        display: flex;
    }

    .list .search-single-list {
        flex-direction: column;
        align-items: start !important;
    }

    .list .w-33 {
        width: 33%;
    }

    .list .col .w-67 {
        width: 67%;
    }

    @media (max-width: 767px) {
        .list .w-33 {
            width: 50%;
        }

        .list .col .w-67 {
            width: 50%;
        }
    }

    @media (max-width: 425px) {
        .list .card-body {
            display: block;
        }

        .list .w-33, .list .col .w-67 {
            width: 100%;
        }
    }
</style>
@endsection

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
                                <li class="breadcrumb-item"><a href="{{ url('vendors') }}">Stores</a></li>
                                <li class="breadcrumb-item active" aria-current="page">E-Grocery Super Market</li>
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
                                <img src="{{ asset('css/assets/images/stores-logo/stores-logo-1.svg') }}" alt=""
                                    class="rounded-circle icon-shape icon-xxl" />
                            </div>
                            <!-- heading -->
                            <div class="mt-4">
                                <h1 class="mb-1 h4">E-Grocery Super Market</h1>
                                <div class="small text-muted">
                                    <span>Everyday store prices</span>
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
                        <ul class="nav flex-column nav-pills nav-pills-dark">
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <i class="feather-icon icon-shopping-bag me-2"></i>
                                    Shop
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-gift me-2"></i>
                                    Deals
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-map-pin me-2"></i>
                                    Buy It Again
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-star me-2"></i>
                                    Reviews
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-book me-2"></i>
                                    Recipes
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-phone-call me-2"></i>
                                    Contact
                                </a>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="feather-icon icon-clipboard me-2"></i>
                                    Policy
                                </a>
                            </li>
                        </ul>
                        <hr />
                        <div>
                            <ul class="nav flex-column nav-links">
                                <h4>Category</h4>
                                @foreach ($categories as $category)
                                    <!-- nav item -->
                                    <li class="nav-item">
                                        <a href="#!" class="nav-link category-hover category_item"
                                            data-category_id="{{ $category->id }}">
                                            {{ $category->name }}
                                        </a>

                                        @if ($category->sub_categories->count() > 0)
                                            <ul class="dropdown-menu">
                                                @foreach ($category->sub_categories as $subcategory)
                                                    <li>
                                                        <a class="dropdown-item subcategory_item" href="#!"
                                                            data-subcategory_id="{{ $subcategory->id }}">{{ $subcategory->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>


                        </div>
                    </div>
                    <div class="col-12 col-lg-9 col-md-8">
                        <div class="mb-8 bg-light d-lg-flex justify-content-lg-between rounded">
                            <div class="align-self-center p-8">
                                <div class="mb-3">
                                    <h5 class="mb-0 fw-bold">E-Grocery Super Market</h5>
                                    <p class="mb-0 text-muted">Whatever the occasion, weve got you covered.</p>
                                </div>
                                <div class="position-relative">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Search E-Grocery Super Market" />
                                    <span class="position-absolute end-0 top-0 mt-2 me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
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
                                {{--  <p class="mb-3 mb-md-0">24 Products found</p>  --}}
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
                                    <select class="form-select" name="sort_by" id="sort_by">
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
                        <div class="loader" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                            @include('livewire.website.modules.ecommerce.section.all_products')

                        <!-- All Products End-->

                        <!-- row -->
                        <div class="row mt-8">
                            <div class="col">
                                <!-- nav -->
                                <nav>
                                    {{ $all_products->links('vendor.pagination.default') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js')
    <script>
        //fetch product by category
        $('.category_item').on('click', function(e) {
            var category_id = $(this).data('category_id');
            $('.loader').show();
            $.ajax({
                url: "{{ route('ecommerce.category_products') }}",
                type: 'post',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    $('.loader').hide();
                    if (response.status == true && response.products.length > 0) {
                        $('.clear_products').empty(); // Clear the current products
                        $('.clear_products').html(response.products); // Populate new products
                    } else {
                        $('.clear_products').empty(); // Clear existing products
                        $('.clear_products').html(
                        '<p>No products found for this Category.</p>'); // Show a placeholder
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product data:', error);
                    $('.clear_products').html(
                        '<p>Error fetching product data. Please try again later.</p>');
                    $('.loader').hide();
                }
            });
        });

        //fetch product by category
        $('.subcategory_item').on('click', function(e) {
            $('.loader').show();
            var subcategory_id = $(this).data('subcategory_id');
            $.ajax({
                url: "{{ route('ecommerce.subcategory_products') }}",
                type: 'post',
                data: {
                    subcategory_id: subcategory_id,
                },
                success: function(response) {
                    $('.loader').hide();
                    if (response.status == true && response.products.length > 0) {
                        $('.clear_products').empty(); // Clear the current products
                        $('.clear_products').html(response.products); // Populate new products
                    } else {
                        $('.clear_products').empty(); // Clear existing products
                        $('.clear_products').html(
                        '<p>No products found for this subcategory.</p>'); // Show a placeholder
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product data:', error);
                    $('.clear_products').html(
                        '<p>Error fetching product data. Please try again later.</p>');
                    $('.loader').hide();
                }
            });
        });

        $('#sort_by').on('change', function(e) {
            var sort_by = $(this).val();

            $('.loader').show();
            $.ajax({
                url: "{{ route('ecommerce.sort_by_products') }}",
                type: 'post',
                data: {
                    sort_by: sort_by
                },
                success: function(response) {
                    $('.loader').hide();
                    if (response.status == true && response.products.length > 0) {
                        $('.clear_products').empty(); // Clear the current products
                        $('.clear_products').html(response.products); // Populate new products
                    } else {
                        $('.clear_products').empty(); // Clear existing products
                        $('.clear_products').html(
                        '<p>No products found for this Category.</p>'); // Show a placeholder
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product data:', error);
                    $('.clear_products').html(
                        '<p>Error fetching product data. Please try again later.</p>');
                    $('.loader').hide();
                }
            });
        });

        $(document).on('click', '.quickViewModal', function(e) {
            var product_id = $(this).data('id');
            $.ajax({
                url: "{{ route('ecommerce.product_detail') }}",
                type: 'post',
                data: {
                    id: product_id
                },
                success: function(response) {
                    if (response.html) {
                        $('#cart_modal #modal-images').html(response.images);
                        $('#cart_modal #modal-data').html(response.html);
                        // Show the modal
                        $('#cart_modal').modal('show');

                    } else {
                        alert('Failed to load product details.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product data:', error);
                }
            });
        });
    </script>
@endsection
