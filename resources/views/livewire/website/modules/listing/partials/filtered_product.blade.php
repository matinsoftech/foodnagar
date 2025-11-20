@foreach ($products as $product)
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-5 product-item">
        <div class="product-card card position-relative">
            <div class="product-media">
                <div class="product-img">
                    <img src="{{ $product->getFirstMediaUrl('default') }}" height="200" alt="product">
                </div>
                <div class="cross-vertical-badge product-badge">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Recommend</span>
                </div>
                <div class="product-type">
                    <span class="flat-badge booking">booking</span>
                </div>
                <ul class="product-action">
                    <li class="view"><i class="fas fa-eye"></i><span>264</span></li>
                    <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li>
                </ul>
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
            {{-- <div class="product-content">
                <ol class="breadcrumb product-category">
                    <li><i class="fas fa-tags"></i></li>
                    <li class="breadcrumb-item {{ strtolower($product->ad_type) }}"><a
                            href="#">{{ $product->ad_type }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->vendor_types->name }}
                    </li>
                </ol>
                <h5 class="product-title">
                    <a href="{{ route('products_view', $product->id) }}">{{ $product->name }}</a>
                </h5>
                <div class="product-meta">
                    <span><i class="fas fa-map-marker-alt"></i>{{ $product->address }}</span>
                    <span><i class="fas fa-clock"></i>{{ $product->created_at->format('F j, Y') }}</span>
                </div>
                <div class="product-info">
                    <h5 class="product-price">{{ $product->price }}<span>/{{ $product->unit }}</span></h5>
                    <div class="product-btn">
                        <a href="#!" title="Compare" class="fas fa-compress Compare" data-id={{ $product->id }}></a>
                        <button type="button" title="Wishlist" class="far fa-heart add_favourite" data-id={{ $product->id }}></button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endforeach


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const layoutLinks = document.querySelectorAll('.filter-layout');
        const productItems = document.querySelectorAll('.product-item');

        // Retrieve saved layout from localStorage
        const savedLayout = localStorage.getItem('productLayout');

        if (savedLayout) {
            activateLayout(savedLayout);
            updateProductLayout(savedLayout);
        }

        layoutLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Remove active class from all links
                layoutLinks.forEach(l => l.classList.remove('active'));

                // Activate the clicked link
                activateLayout(link.getAttribute('data-layout'));

                // Save the layout to localStorage
                localStorage.setItem('productLayout', link.getAttribute('data-layout'));

                // Update the hidden input value
                document.getElementById('layout-input').value = link.getAttribute(
                'data-layout');

                // Submit the form to trigger page reload
                document.getElementById('layout-form').submit();
            });
        });

        function activateLayout(layout) {
            layoutLinks.forEach(l => l.classList.remove('active'));
            document.querySelector(`[data-layout="${layout}"]`).classList.add('active');
        }

        function updateProductLayout(layout) {
            productItems.forEach(item => {
                item.classList.remove('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-4');
                if (layout === '1') {
                    item.classList.add('col-12');
                } else if (layout === '2') {
                    item.classList.add('col-sm-6', 'col-md-6');
                } else if (layout === '3') {
                    item.classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-4');
                }
            });
        }
    });
</script>
