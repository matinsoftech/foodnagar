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
            flex-direction: column;
            align-content: center;
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
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="#!">Shop</a></li> --}}
                                {{--  <li class="breadcrumb-item active" aria-current="page">Snacks & Munchies</li>  --}}
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
                                                <a href="#categoryFlush{{ $category->id }}" class="nav-link collapsed category_item" data-category_id="{{ $category->id }}"
                                                    data-bs-toggle="collapse" aria-expanded="false"
                                                    aria-controls="categoryFlush{{ $category->id }}">
                                                    {{ $category->name }}
                                                    @if ($category->sub_categories->count() > 0)
                                                        <i class="feather-icon icon-chevron-right"></i>
                                                    @endif
                                                </a>
                                                @if ($category->sub_categories->count() > 0)
                                                    <!-- accordion collapse -->
                                                    <div id="categoryFlush{{ $category->id }}"
                                                        class="accordion-collapse collapse"
                                                        data-bs-parent="#categoryCollapseMenu">
                                                        <div>
                                                            <!-- nav -->
                                                            <ul class="nav flex-column ms-3">
                                                                @foreach ($category->sub_categories as $subcategory)
                                                                    <!-- nav item -->
                                                                    <li class="nav-item">
                                                                        <a href="#!" class="nav-link subcategory_item"
                                                                            data-subcategory_id="{{ $subcategory->id }}">
                                                                            {{ $subcategory->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="mb-8">
                                    <label for="brand_id" class="form-label">Brands</label>
                                    <select name="brand_id" id="brand_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-8">
                                    <label for="delivery_zone_id" class="form-label">Cities</label>
                                    <select name="delivery_zone_id" id="delivery_zone_id" class="form-select">
                                        <option value="">All</option>
                                        @foreach ($delivery_zones as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-8">
                                    {{-- <h5 class="mb-3">Stores</h5>
                                    <div class="my-4">
                                        <!-- input -->
                                        <input type="search" class="form-control" placeholder="Search by store" />
                                    </div> --}}
                                    <!-- form check -->
                                    {{-- <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="eGrocery"
                                            checked />
                                        <label class="form-check-label" for="eGrocery">E-Grocery</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="DealShare" />
                                        <label class="form-check-label" for="DealShare">DealShare</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="Dmart" />
                                        <label class="form-check-label" for="Dmart">DMart</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="Blinkit" />
                                        <label class="form-check-label" for="Blinkit">Blinkit</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="BigBasket" />
                                        <label class="form-check-label" for="BigBasket">BigBasket</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="StoreFront" />
                                        <label class="form-check-label" for="StoreFront">StoreFront</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="Spencers" />
                                        <label class="form-check-label" for="Spencers">Spencers</label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="onlineGrocery" />
                                        <label class="form-check-label" for="onlineGrocery">Online Grocery</label>
                                    </div> --}}
                                </div>
                                <div class="mb-8">
                                    <div class="product-widget">

                                        <h6 class="product-widget-title">Filter by Price</h6>
                        
                                        <form class="product-widget-form">
                        
                                            <div class="product-widget-group">
                        
                                                <input type="text" placeholder="min - 00">
                        
                                                <input type="text" placeholder="max - 1B">
                        
                                            </div>
                        
                                            <button type="submit" class="product-widget-btn">
                        
                                                <i class="fas fa-search"></i>
                        
                                                <span>search</span>
                        
                                            </button>
                        
                                        </form>
                        
                                    </div>
                                    <!-- price -->
                                    {{-- <h5 class="mb-3">Price</h5>
                                    <div>
                                        <!-- range -->
                                        <div id="priceRange" class="mb-3"></div>
                                        <small class="text-muted">Price:</small>
                                        <span id="priceRange-value" class="small"></span>
                                    </div> --}}
                                </div>

                                <div class="mb-8">
                                    <h5 class="mb-3">Product Type</h5>
                                    <div>
                                        <form action="#">
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input product_type" type="radio" name="product_type" value="1"
                                                checked />
                                            <label class="form-check-label" for="productType1">Digital</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input product_type" type="radio" name="product_type" value="0" />
                                            <label class="form-check-label" for="productType2">Physical</label>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- rating -->
                                <div class="mb-8">
                                    <h5 class="mb-3">Rating</h5>
                                    <div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input rating-checkbox" type="checkbox" value="5"
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
                                            <input class="form-check-input rating-checkbox" type="checkbox" value="4"
                                                id="ratingFour" checked />
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
                                            <input class="form-check-input rating-checkbox" type="checkbox" value="3"
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
                                            <input class="form-check-input rating-checkbox" type="checkbox" value="2"
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
                                            <input class="form-check-input rating-checkbox" type="checkbox" value="1"
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
                                {{-- <div class="mb-8 position-relative">
                                    <!-- Banner Design -->
                                    <!-- Banner Content -->
                                    <div class="position-absolute p-5 py-8">
                                        <h3 class="mb-0">Fresh Fruits</h3>
                                        <p>Get Upto 25% Off</p>
                                        <a href="#" class="btn btn-dark">
                                            Shop Now
                                            <i class="feather-icon icon-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                    <!-- Banner Content -->
                                    <!-- Banner Image -->
                                    <!-- img -->
                                    <img src="../assets/images/banner/assortment-citrus-fruits.png" alt=""
                                        class="img-fluid rounded" />
                                    <!-- Banner Image -->
                                </div> --}}
                            </div>
                        </div>
                    </aside>
                    <section class="col-lg-9 col-md-12">
                        <!-- card -->
                        {{-- <div class="card mb-4 bg-light border-0">
                            <!-- card body -->
                            <div class="card-body p-9">
                                <h2 class="mb-0 fs-1">Products</h2>
                            </div>
                        </div> --}}
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
                                            <option selected value="">Sort by: Featured</option>
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
                                <nav>
                                    {{ $all_products->links('vendor.pagination.default') }}
                                </nav>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <input type="hidden" id="category_id" />
    <input type="hidden" id="sub_category_id" />
@endsection

@section('js')
    <script>

        function filter_products(){

            let category_id = $('#category_id').val();
            let sub_category_id = $('#sub_category_id').val();
            let brand_id = $('#brand_id').val();
            let min_price = $('#min_price').val();
            let max_price = $('#max_price').val();
            let sort_by = $('#sort_by').val();
            let ratings = [];
            $('.rating-checkbox:checked').each(function() {
                ratings.push($(this).val()); // Extract rating from checkbox id
            });
            let delivery_zone_id = $('#delivery_zone_id').val();
            let product_type = $('input[name="product_type"]:checked').val();

            $('.loader').show();
            $.ajax({
                url: "{{ route('ecommerce.filter_products') }}",
                type: 'post',
                data: {
                    category_id: category_id,
                    sub_category_id: sub_category_id,
                    brand_id: brand_id,
                    min_price: min_price,
                    max_price: max_price,
                    sort_by: sort_by,
                    ratings: ratings,
                    delivery_zone_id: delivery_zone_id,
                    product_type: product_type
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

        }

        $('#delivery_zone_id').on('change',function(){
            filter_products();
        });

        $(document).on('change', '.rating-checkbox', function() {
            filter_products(); // Trigger the filter_products function on change
        });

        $('#brand_id').on('change', function(e) {
            filter_products();
        });

        //fetch product by category
        $('.category_item').on('click', function(e) {
            $('#category_id').val($(this).data('category_id'));
            filter_products();
            // var category_id = $(this).data('category_id');
            // $('.loader').show();
            // $.ajax({
            //     url: "{{ route('ecommerce.category_products') }}",
            //     type: 'post',
            //     data: {
            //         category_id: category_id
            //     },
            //     success: function(response) {
            //         $('.loader').hide();
            //         if (response.status == true && response.products.length > 0) {
            //             $('.clear_products').empty(); // Clear the current products
            //             $('.clear_products').html(response.products); // Populate new products
            //         } else {
            //             $('.clear_products').empty(); // Clear existing products
            //             $('.clear_products').html(
            //                 '<p>No products found for this Category.</p>'); // Show a placeholder
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error fetching product data:', error);
            //         $('.clear_products').html(
            //             '<p>Error fetching product data. Please try again later.</p>');
            //         $('.loader').hide();
            //     }
            // });
        });

        //fetch product by category
        $('.subcategory_item').on('click', function(e) {
            $('#sub_category_id').val($(this).data('subcategory_id'));
            filter_products();
            // $('.loader').show();
            // var subcategory_id = $(this).data('subcategory_id');
            // $.ajax({
            //     url: "{{ route('ecommerce.subcategory_products') }}",
            //     type: 'post',
            //     data: {
            //         subcategory_id: subcategory_id,
            //     },
            //     success: function(response) {
            //         $('.loader').hide();
            //         if (response.status == true && response.products.length > 0) {
            //             $('.clear_products').empty(); // Clear the current products
            //             $('.clear_products').html(response.products); // Populate new products
            //         } else {
            //             $('.clear_products').empty(); // Clear existing products
            //             $('.clear_products').html(
            //                 '<p>No products found for this subcategory.</p>'); // Show a placeholder
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error fetching product data:', error);
            //         $('.clear_products').html(
            //             '<p>Error fetching product data. Please try again later.</p>');
            //         $('.loader').hide();
            //     }
            // });
        });

        $('#sort_by').on('change', function(e) {
            // var sort_by = $(this).val();
            filter_products();

            // $('.loader').show();
            // $.ajax({
            //     url: "{{ route('ecommerce.sort_by_products') }}",
            //     type: 'post',
            //     data: {
            //         sort_by: sort_by
            //     },
            //     success: function(response) {
            //         $('.loader').hide();
            //         if (response.status == true && response.products.length > 0) {
            //             $('.clear_products').empty(); // Clear the current products
            //             $('.clear_products').html(response.products); // Populate new products
            //         } else {
            //             $('.clear_products').empty(); // Clear existing products
            //             $('.clear_products').html(
            //                 '<p>No products found for this Category.</p>'); // Show a placeholder
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('Error fetching product data:', error);
            //         $('.clear_products').html(
            //             '<p>Error fetching product data. Please try again later.</p>');
            //         $('.loader').hide();
            //     }
            // });
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
        document.addEventListener('DOMContentLoaded', function() {
            // Select all layout links
            const layoutLinks = document.querySelectorAll('.layout-link');

            layoutLinks.forEach(link => {
                link.addEventListener('click', function(e) {
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
    </script>
@endsection
