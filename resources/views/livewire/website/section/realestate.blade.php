<section class="padding-bottom: 6rem">
    <div class="container">
        <p class="text-center mb-3 mb-lg-3 mb-md-3" style="font-size: 1rem; color: #662f88; font-weight: 500;">
            FEATURED LISTING
        </p>
        <h1 class="text-center mb-3 mb-lg-4" style="color: #000; font-weight: 700 ;">
            Recommended Listing
        </h1>

        <div class="mb-3 mb-lg-4">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-content-center mb-md-5 mb-3 mb-lg-5 col border-0" id="realestateTab"
                role="tablist">
                @foreach ($categories['realestate'] as $cat)
                    <li class="nav-item me-2" role="presentation">
                        <a class="nav-link realestate_cat line-clamp-1 {{ $loop->first ? 'active' : '' }}"
                            id="tab-{{ $cat->id }}" data-id="{{ $cat->id }}" data-bs-toggle="tab"
                            href="#content-{{ $cat->id }}" role="tab"
                            aria-controls="content-{{ $cat->id }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" id="realestateTabContent">
                @foreach ($categories['realestate'] as $cat)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $cat->id }}"
                        role="tabpanel" aria-labelledby="tab-{{ $cat->id }}">
                        <div class="card-group row realstate_clear_products">
                            @foreach ($realestates as $realestate)
                                <div class="col-md-6 mb-md-4 col-lg-3 mb-3">
                                    <div class="card" style="position: relative;">
                                        <a href="{{ route('products_view', $realestate->id) }}">
                                            <img src="{{ $realestate->getFirstMediaUrl('default') }}"
                                                class="card-img-top" alt="..."
                                                style="height: 237.33px; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="fs-6">
                                                <a href="{{ route('products_view', $realestate->id) }}"
                                                    class="text-inherit text-decoration-none line-clamp-1">
                                                    {{ $realestate->name }}
                                                </a>
                                            </h5>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div>
                                                    <span class="text-dark">
                                                        {{-- {{ $realestate->discount_price ? $realestate->discount_price : $realestate->price }} --}}
                                                        {{ currencyFormat( $realestate->discount_price ? $realestate->discount_price : $realestate->price ) }}<span>/{{ $realestate->unit }}</span>
                                                    </span>
                                                    {{-- <span
                                                        class="text-decoration-line-through text-muted">${{ currencyFormat($realestate->price) }}
                                                    </span> --}}
                                                </div>
                                                <div>
                                                    <button type="button" title="Wishlist" class="add_favourite product-btn"
                                                        data-id={{ $realestate->id }} style="width: 30px; border: unset; background: unset; border-left: 1px solid #e8e8e8;">
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
                                            {{-- <div class="card-text d-flex gap-md-3">
                                                <span>
                                                    {!! Str::limit($realestate->description, 110) !!}
                                                </span>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="card-footer d-flex justify-content-between align-middle py-4">
                                            <div class="d-flex gap-1">
                                                @if ($realestate->vendor->getFirstMediaUrl('documents') == '')
                                                    <img src="{{ appLogo() }}" alt=""
                                                        class="col-1 rounded-circle1" />
                                                @else
                                                    <img src="{{ $realestate->vendor->getFirstMediaUrl('documents') }}"
                                                        alt="" class="col-1 rounded-circle1" />
                                                @endif
                                            </div>
                                            <span style="font-weight: 600; font-size: 22px;">
                                                Rs
                                                .{{ $realestate->discount_price ? $realestate->discount_price : $realestate->price }}
                                            </span>
                                        </div> --}}
                                        <div class="card-body d-flex gap-2" style="position: absolute;">
                                            <button class="card-button-Recomm1">Featured</button>
                                            <button class="card-button-Recomm">For sale</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('view.all.listing') }}" class="btn page-color-button">View
                    All Listing <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>

    </div>
</section>

@section('js')
    <script>
        $(document).ready(function() {
            $('.realestate_cat').on('click', function() {
                $('.realestate_cat').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection
