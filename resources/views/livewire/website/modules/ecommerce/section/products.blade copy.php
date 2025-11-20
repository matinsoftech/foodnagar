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
            gap: 1rem;
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

        .add_favourite.active {
            color: #ff6600;
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
        <!-- section-->
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="#!">Shop</a></li> --}}
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <div class="mt-8 mb-lg-14 mb-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row gx-10">
                    <!-- col -->
                    <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                        <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1"
                            id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                            <div class="offcanvas-header d-lg-none">
                                <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body ps-lg-2 pt-lg-0">
                                <div class="mb-8">
                                    <!-- title -->
                                    <h5 class="mb-3">Categories</h5>
                                    <!-- nav -->
                                    <ul class="nav nav-category" id="categoryCollapseMenu">
                                        @foreach ($categories as $category)
                                            <li class="nav-item border-bottom w-100">
                                                <a href="javascript::void(0)" class="nav-link collapsed category_item" data-category_id="{{$category->id}}"
                                                    data-bs-toggle="collapse" aria-expanded="false"
                                                    aria-controls="categoryFlush{{ $category->id }}" >
                                                    {{ $category->name }}

                                                </a>

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if($stores)
                                <div class="mb-8">
                                    <h5 class="mb-3">Stores</h5>
                                    <div class="my-4">
                                        <!-- input -->
                                        <input type="search" class="form-control" placeholder="Search by store" />
                                    </div>
                                    <!-- form check -->
                                    @foreach ($stores as $store)
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input vendor-checkbox" type="checkbox" value="{{ $store->id }}" id="label_{{$store->id}}"
                                                />
                                            <label class="form-check-label" for="label_{{$store->id}}">{{$store->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                                {{--  <div class="mb-8">
                                    <!-- price -->
                                    <h5 class="mb-3">Price</h5>
                                    <div>
                                        <!-- range -->
                                        <div id="priceRange" class="mb-3"></div>
                                        <small class="text-muted">Price:</small>
                                        <span id="priceRange-value" class="small"></span>
                                    </div>
                                </div>  --}}
                                <!-- rating -->
                                <div class="mb-8">
                                    <h5 class="mb-3">Rating</h5>
                                    <div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ratingFive" />
                                            <label class="form-check-label" for="ratingFive">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ratingFour"  />
                                            <label class="form-check-label" for="ratingFour">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ratingThree" />
                                            <label class="form-check-label" for="ratingThree">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ratingTwo" />
                                            <label class="form-check-label" for="ratingTwo">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="ratingOne" />
                                            <label class="form-check-label" for="ratingOne">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </aside>
                    <section class="col-lg-9 col-md-12">

                        <!-- list icon -->
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-lg-0">
                                {{--  <p class="mb-0">
                                    <span class="text-dark">24</span>
                                    Products found
                                </p>  --}}
                            </div>

                            <!-- icon -->
                            <div class="d-md-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div id="layout-selector">
                                        <a href="#" class="layout-link me-3 active" data-layout="list"><i
                                                class="bi bi-list-ul"></i></a>
                                        <a href="#" class="layout-link me-3 text-muted" data-layout="grid-2"><i
                                                class="bi bi-grid"></i></a>
                                        <a href="#" class="layout-link me-3 text-muted" data-layout="grid-3"><i
                                                class="bi bi-grid-3x3-gap"></i></a>
                                    </div>

                                    <div class="ms-2 d-lg-none">
                                        <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas"
                                            href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-filter me-2">
                                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                            </svg>
                                            Filters
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex mt-2 mt-lg-0">
                                    <div class="me-2 flex-grow-1">
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
                        </div>
                        <!-- All  Products Start-->
                        <div class="loader" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <!-- row -->
                        @include('livewire.website.modules.ecommerce.section.all_products')

                        <div class="row mt-8">
                            <div class="col">
                                <!-- nav -->
                                @if (count($all_products) > 0)
                                <nav>
                                    {{ $all_products->links('vendor.pagination.default') }}
                                </nav>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
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

        $('.vendor-checkbox').on('change', function () {
            // Get all selected vendor IDs
            $('.loader').show();
            let selectedVendors = [];
            $('.vendor-checkbox:checked').each(function () {
                selectedVendors.push($(this).val());
            });

            // Send AJAX request to filter products
            $.ajax({
                url: "{{ route('vendor_wise_products') }}",
                type: "post",
                data: {
                    vendors: selectedVendors,
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


        // items per row
        document.addEventListener('DOMContentLoaded', function () {
            // Select all layout links
            const layoutLinks = document.querySelectorAll('.layout-link');

            layoutLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Remove active class from all links
                    layoutLinks.forEach(el => el.classList.remove('active', 'text-muted'));

                    // Add active class to the clicked link
                    this.classList.add('active');

                    // Get the selected layout
                    const layout = this.getAttribute('data-layout');

                    // Update product container class
                    const productContainer = document.getElementById('product-container');
                    productContainer.className = layout;
                });
            });

            // Initialize the active state
            document.querySelector('.layout-link.active').classList.add('active');
        });
        // items per row ends


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
@endsection
