<section>
    <div class="container py-5">
        <h1 class="text-center mb-3 mb-lg-4" style="color: #000; font-weight: 700 ;">
            Featured Services
        </h1>

        <div class="">
            <!-- Nav tabs -->
            <ul class="nav nav-tab justify-content-center mb-md-5 mb-3 mb-lg-5 col border-0 gap-2" id="serviceCategoryTab"
                role="tablist">
                @foreach ($categories['services'] as $cat)
                    <li class="nav-item me-2" role="presentation">
                        <a class="nav-link show PageColor-Rounded service_cat" data-id="{{ $cat->id }}"
                            href="javascript:void(0)" role="tab" aria-controls="home"
                            aria-selected="false">{{ $cat->name }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="doctor" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-group row service_cat_clear_products">
                        @foreach ($services as $service)
                            <div class="col-md-4 col-lg-3 mb-md-3 mb-2">
                                <div class="card p-3 pb-0">
                                    <a href="{{ route('product_details', $service->id) }}">
                                        <img src="{{ $service->getFirstMediaUrl('default') }}" class="card-img-top"
                                            alt="..." style="height: 174.8px;">
                                    </a>
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between align-item-center m-auto">
                                            <span>
                                                @foreach ($service->categories as $category)
                                                    <div class="text-small mb-1">
                                                        <a href="{{ route('product_details', $service->id) }}"
                                                            class="text-decoration-none text-muted">
                                                            <small>{{ $category->name }}</small>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </span>
                                            <span class="rounded-circle add_favourite" data-id="{{ $service->id }}">
                                                <i class="fa-regular fa-heart icon-Bg-color"></i>
                                            </span>
                                        </div>
                                        <h2 class="fs-6">
                                            <a href="{{ route('product_details', $service->id) }}"
                                                class="text-inherit text-decoration-none line-clamp-1">
                                                {{ $service->name }}
                                            </a>
                                        </h2>
                                        <div class="d-flex justify-content-between m-auto align-middle">
                                            <div class="d-flex align-items-center gap-1">
                                                @if ($service->vendor->getFirstMediaUrl('documents') == '')
                                                    <img src="{{ appLogo() }}" alt=""
                                                        class="col-1 rounded-circle1"
                                                        style="width: 30px; height: 30px;" />
                                                @else
                                                    <img src="{{ $service->vendor->getFirstMediaUrl('documents') }}"
                                                        alt="" class="col-1 rounded-circle1"
                                                        style="width: 30px; height: 30px;" />
                                                @endif
                                                <h2 class="fs-6 mb-0">
                                                    <a href="{{ route('product_details', $service->id) }}"
                                                        class="text-inherit text-decoration-none line-clamp-1">
                                                        {{ $service->vendor->name }}
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="card-text" style="font-size: 16px; color: #908b8b;">
                                            <div class="text-small mb-1">
                                                <a href="{{ route('product_details', $service->id) }}"
                                                    class="text-decoration-none text-muted">
                                                    <small>{!! Str::limit($service->description, 110) !!}</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <span class="text-dark">Rs.
                                                {{ $service->discount_price ? $service->discount_price : $service->price }}</span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn"
                                                data-id="{{ $service->id }}">
                                                Book Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="{{ url('services/products') }}" class="btn page-color-button">
                    View <i class="fa-solid fa-arrow-right-long"></i> All Services
                </a>
            </div>
        </div>
    </div>
</section>

@section('js')
    <script>
        $(document).ready(function() {
            // Handle tab selection
            $('#serviceCategoryTab .service_cat').on('click', function() {
                $('#serviceCategoryTab .service_cat').removeClass('active');
                $(this).addClass('active');

                // Fetch data based on category ID
                const categoryId = $(this).data('id');

                // Update content dynamically (AJAX example)
                $.ajax({
                    url: `/get-services/${categoryId}`,
                    method: 'GET',
                    success: function(response) {
                        $('.service_cat_clear_products').html(response);
                    },
                    error: function() {
                        alert('Failed to load data.');
                    }
                });
            });
        });
    </script>
@endsection
