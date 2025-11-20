<style>
    .footer-pagection nav {
        width: 100%;
    }
</style>

<div class="col-lg-8 col-xl-9">

    <div class="row">
        <div class="col-lg-12">
            <div class="header-filter">
                <div class="filter-show">
                    <label class="filter-label">Show :</label>
                    <select id="filter-show" class="custom-select filter-select">
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                    </select>
                </div>
                <div class="filter-short">
                    <label class="filter-label">Sort by :</label>
                    <select id="filter-sort" class="custom-select filter-select">
                        <option value="default" selected>Default</option>
                        <option value="trending">Trending</option>
                        <option value="featured">Featured</option>
                        <option value="recommend">Recommend</option>
                    </select>
                </div>
                <div class="filter-action">
                    <form id="layout-form" method="GET" action="{{ route('view.all.listing') }}">
                        @csrf
                        <input type="hidden" name="layout" id="layout-input">
                        <a href="#" data-layout="3" class="filter-layout active" title="Three Column">
                            <i class="fas fa-th"></i>
                        </a>
                        <a href="#" data-layout="2" class="filter-layout" title="Two Column">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <a href="#" data-layout="1" class="filter-layout" title="One Column">
                            <i class="fas fa-th-list"></i>
                        </a>
                    </form>
                </div>

            </div>


        </div>
    </div>
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="ad-feature-slider owl-carousel owl-theme " >
                @foreach ($products as $product)
                    <div class="feature-card">
                        <a href="{{ route('products_view', $product->id) }}" class="feature-img">
                            <img src="{{ $product->getFirstMediaUrl('default') }}" height="500" alt="feature">
                        </a>
                        <div class="cross-inline-badge feature-badge">
                            <span>featured</span>
                            <i class="fas fa-book-open"></i>
                        </div>
                        <button type="button" class="feature-wish">
                            <i class="fas fa-heart"></i>
                        </button>
                        <div class="feature-content">
                            <ol class="breadcrumb feature-category">
                                <li><span class="flat-badge rent">{{ $product->ad_type ?? "N/A"}}</span></li>
                                <!--<li class="breadcrumb-item"><a href="#">automobile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">private car</li>-->
                            </ol>
                            <h3 class="feature-title">
                                <a href="{{ route('products_view', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="feature-meta">
                                <span
                                    class="feature-price">{{ $product->price }}<small>/{{ $product->unit }}</small></span>
                                <span class="feature-time"><i
                                        class="fas fa-clock"></i>{{ $product->created_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Add more slides as needed -->
            </div>
        </div>
    </div> --}}
    <div class="row" id="products-container">
        @include('livewire.website.modules.listing.partials.filtered_product')


    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="footer-pagection w-100 d-flex justify-content-between">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function applyFilters() {
            let show = $('#filter-show').val();
            let sort = $('#filter-sort').val();
            let layout = $('.filter-layout.active').data('layout');

            $.ajax({
                url: '/view-all-listing',
                method: 'GET',
                data: {
                    show: show,
                    sort: sort,
                    layout: layout,
                },
                success: function(response) {
                    $('#products-container').html(response);
                },
                error: function(xhr) {
                    console.error('Failed to apply filters:', xhr);
                }
            });
        }

        // Event listeners
        $('#filter-show, #filter-sort').on('change', applyFilters);
        $('.filter-layout').on('click', function(e) {
            e.preventDefault();
            $('.filter-layout').removeClass('active');
            $(this).addClass('active');
            applyFilters();
        });
    });
</script>
