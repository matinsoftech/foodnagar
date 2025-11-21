<section style="background-color: rgb(248 248 248); padding-bottom: 6rem;">

    <div class="container py-5">
        <h4 class="text-center mb-3 mb-lg-2 mb-md-2" style="color: #662f88; font-weight: 600;">
            PRODUCT </h4>
        <h1 class="text-center mb-3 mb-lg-5" style="color: #000; font-weight: bolder ; ">
            Product Categories
        </h1>

        <div class="row">
            <!-- Filter Section -->
            {{-- <div class="col-md-3">
                <h4
                    style="color: #fff; background-color:#662f88;padding:10px; border-top-left-radius:10px; border-top-right-radius:10px;">
                    Filter Products
                </h4>
                <form id="filterForm" class="category-list">
                    <!-- Categories Filter -->
                    <div class="mb-3">
                        <h5>Categories</h5>
                        @foreach ($categories['shops'] as $cat)
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox"
                                    value="{{ $cat->id }}" id="category-{{ $cat->id }}">
                                <label class="form-check-label" for="category-{{ $cat->id }}">
                                    {{ $cat->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Product Search -->
                    <div class="mb-3">
                        <h5>Search</h5>
                        <input type="text" class="form-control" id="productSearch" placeholder="Search for products">
                    </div>
                </form>
            </div> --}}

            <div class="col-lg-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary  py-3">
                        <h5 class="mb-0 text-white"><i class="bi bi-funnel me-2"></i>Filter Products</h5>
                    </div>
                    <div class="card-body">
                        <form id="filterForm">
                            <!-- Categories Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3 text-secondary"><i class="bi bi-tags me-2"></i>Categories</h6>
                                <div class="list-group list-group-flush">
                                    @foreach ($categories['shops'] as $cat)
                                        <label class="list-group-item list-group-item-action d-flex align-items-center">
                                            <input class="form-check-input category-filter me-2" type="checkbox"
                                                value="{{ $cat->id }}" id="category-{{ $cat->id }}">
                                            <span class="flex-grow-1">{{ $cat->name }}</span>
                                            <span class="badge bg-primary rounded-pill d-none">15</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Product Search -->
                            <div class="mb-3 d-none">
                                <h6 class="mb-3 text-secondary"><i class="bi bi-search me-2"></i>Search</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control border-end-0" id="productSearch"
                                        placeholder="Search products...">
                                    <span class="input-group-text bg-white">
                                        <i class="bi bi-search text-secondary"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="col-md-9">
                <div id="category-content-tools" class="category-pane active">
                    <div class="card-group row shop_cat_clear_products" id="productList">
                        @foreach ($ecommerces as $product)
                            <div class="col-md-4 mb-4 product-card"
                                data-category="{{ implode(',', $product->categories->pluck('id')->toArray()) }}">
                                <div class="card card-product">
                                    <div class="card-body">
                                        <div class="text-center position-relative">
                                            <div class="position-absolute top-0 start-0">
                                                <span class="badge bg-danger">Sale</span>
                                            </div>
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ $product->getFirstMediaUrl('default') }}" alt=""
                                                    class="mb-3 img-fluid" style="height: 174.8px;" />
                                            </a>
                                            <div class="card-product-action">
                                                <a href="javascript:void(0)" class="btn-action quickViewModal"
                                                    data-id={{ $product->id }}>
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="Quick View"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn-action add_favourite"
                                                    data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"
                                                    data-id={{ $product->id }}>
                                                    <i class="bi bi-heart"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn-action Compare"
                                                    data-bs-toggle="tooltip" data-bs-html="true" title="Compare"
                                                    data-id={{ $product->id }}>
                                                    <i class="bi bi-arrow-left-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="{{ route('product_details', $product->id) }}"
                                                class="text-inherit text-decoration-none line-clamp-1">{{ $product->name }}</a>
                                        </h2>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <span class="text-dark">${{ $product->discount_price }}</span>
                                                <span
                                                    class="text-decoration-line-through text-muted">
                                                    {{-- ${{ $product->price }} --}}
                                                    <x-product-price :product="$product" />

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="{{ url('e-commerce/products') }}" class="btn page-color-button">
                    View All Products <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modal for variation -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal content here -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const productList = document.getElementById('productList');
        const productSearch = document.getElementById('productSearch');

        filterForm.addEventListener('change', function() {
            filterProducts();
        });

        productSearch.addEventListener('input', function() {
            filterProducts();
        });

        function filterProducts() {
            const selectedCategories = [...document.querySelectorAll('.category-filter:checked')].map(cb => cb
                .value);
            const searchQuery = productSearch.value.toLowerCase();

            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const productCategories = product.getAttribute('data-category').split(',');
                const productName = product.querySelector('h2').textContent.toLowerCase();

                const categoryMatch = selectedCategories.length === 0 || selectedCategories.some(
                    category => productCategories.includes(category));
                const searchMatch = productName.includes(searchQuery);

                if (categoryMatch && searchMatch) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    });
</script>
