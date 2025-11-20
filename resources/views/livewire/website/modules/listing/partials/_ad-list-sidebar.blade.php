<div class="col-lg-4 col-xl-3">
    <div class="row">

        <div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">Filter by Type</h6>
                <form class="product-widget-form" method="GET" action="{{ route('view.all.listing') }}">
                    <ul class="product-widget-list product-widget-scroll" style="height: 100%;">
                        @foreach ($distinct_ad_types as $type)
                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" name="types[]" id="type-{{ $loop->index }}"
                                        value="{{ $type }}">
                                </div>
                                <label class="product-widget-label" for="type-{{ $loop->index }}">
                                    <span class="product-widget-text">{{ $type }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <button type="submit" class="product-widget-btn">
                        <i class="fas fa-broom"></i>
                        <span>Apply Filter</span>
                    </button>
                </form>
            </div>
        </div>



        <div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">Filter by Price</h6>
                <form class="product-widget-form" id="price-filter-form">
                    <div class="product-widget-group">
                        <input type="text" id="min-price" placeholder="min - 0">
                        <input type="text" id="max-price" placeholder="max - 1B">
                    </div>
                    <button type="submit" class="product-widget-btn">
                        <i class="fas fa-search"></i>
                        <span>search</span>
                    </button>
                </form>
            </div>
        </div>


        <div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">filter by category</h6>
                <form class="product-widget-form">
                    <form method="GET" action="{{ route('view.all.listing') }}" class="product-widget-form">
                        <div class="product-widget-search">
                            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
                        </div>
                        <ul class="product-widget-list product-widget-scroll">
                            @foreach ($categories as $category)
                                <li class="product-widget-dropitem">
                                    <button type="submit" name="category_id" value="{{ $category->id }}"
                                        class="product-widget-link">
                                        <i class="fas fa-tags"></i>
                                        {{-- {{ $category->name }} ({{ $category->products_count }}) --}}
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                    {{-- <ul class="product-widget-list product-widget-scroll">
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                electronics (234)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">mixer (56)</a></li>
                                <li><a href="#">freez (78)</a></li>
                                <li><a href="#">LED tv (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                automobiles (767)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">private car (56)</a></li>
                                <li><a href="#">motorbike (78)</a></li>
                                <li><a href="#">truck (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                properties (456)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">free land (56)</a></li>
                                <li><a href="#">apartment (78)</a></li>
                                <li><a href="#">shop (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                fashion (356)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">jeans (56)</a></li>
                                <li><a href="#">t-shirt (78)</a></li>
                                <li><a href="#">jacket (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                gadgets (768)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">computer (56)</a></li>
                                <li><a href="#">mobile (78)</a></li>
                                <li><a href="#">drone (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                furnitures (977)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">chair (56)</a></li>
                                <li><a href="#">sofa (78)</a></li>
                                <li><a href="#">table (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                hospitality (124)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">jeans (56)</a></li>
                                <li><a href="#">t-shirt (78)</a></li>
                                <li><a href="#">jacket (78)</a></li>
                            </ul>
                        </li>
                        <li class="product-widget-dropitem">
                            <button type="button" class="product-widget-link">
                                <i class="fas fa-tags"></i>
                                agriculture (565)
                            </button>
                            <ul class="product-widget-dropdown">
                                <li><a href="#">jeans (56)</a></li>
                                <li><a href="#">t-shirt (78)</a></li>
                                <li><a href="#">jacket (78)</a></li>
                            </ul>
                        </li>
                    </ul> --}}
                    <a href="{{ route('view.all.listing') }}" class="product-widget-btn clear-filter">
                        <i class="fas fa-broom"></i> Clear Filter
                    </a>
                    <!--<button type="submit" class="product-widget-btn">
                        <i class="fas fa-broom"></i>
                        <span>Clear Filter</span>
                    </button>-->
                </form>
            </div>
        </div>







        <div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">Filter by Cities</h6>
                <form class="product-widget-form" method="GET" action="{{ route('view.all.listing') }}">
                    <div class="product-widget-search">
                        <input type="text" id="citySearch" placeholder="Search cities" oninput="filterCities()">
                    </div>
                    <ul id="cityList" class="product-widget-list product-widget-scroll" style="height: 100%;">
                        @foreach ($distinct_cities as $city)
                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" name="cities[]" id="city-{{ $loop->index }}"
                                        value="{{ $city }}" @if (in_array($city, request()->input('cities', []))) checked @endif>
                                </div>
                                <label class="product-widget-label" for="city-{{ $loop->index }}">
                                    <span class="product-widget-text">{{ $city }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>

                    <button type="submit" class="product-widget-btn">
                        <i class="fas fa-broom"></i>
                        <span>Apply Filter</span>
                    </button>
                </form>
            </div>
        </div>

        <!--<div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">Filter by popularity</h6>
                <form class="product-widget-form">
                    <div class="product-widget-search">
                        <input type="text" placeholder="Search">
                    </div>
                    <ul class="product-widget-list product-widget-scroll">
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek9">
                            </div>
                            <label class="product-widget-label" for="chcek9">
                                <span class="product-widget-text">laptop</span>
                                <span class="product-widget-number">(68)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek10">
                            </div>
                            <label class="product-widget-label" for="chcek10">
                                <span class="product-widget-text">camera</span>
                                <span class="product-widget-number">(78)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek11">
                            </div>
                            <label class="product-widget-label" for="chcek11">
                                <span class="product-widget-text">television</span>
                                <span class="product-widget-number">(34)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek12">
                            </div>
                            <label class="product-widget-label" for="chcek12">
                                <span class="product-widget-text">by cycle</span>
                                <span class="product-widget-number">(43)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek13">
                            </div>
                            <label class="product-widget-label" for="chcek13">
                                <span class="product-widget-text">bike</span>
                                <span class="product-widget-number">(57)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek14">
                            </div>
                            <label class="product-widget-label" for="chcek14">
                                <span class="product-widget-text">private car</span>
                                <span class="product-widget-number">(67)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek15">
                            </div>
                            <label class="product-widget-label" for="chcek15">
                                <span class="product-widget-text">air condition</span>
                                <span class="product-widget-number">(98)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek16">
                            </div>
                            <label class="product-widget-label" for="chcek16">
                                <span class="product-widget-text">apartment</span>
                                <span class="product-widget-number">(45)</span>
                            </label>
                        </li>
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input type="checkbox" id="chcek17">
                            </div>
                            <label class="product-widget-label" for="chcek17">
                                <span class="product-widget-text">watch</span>
                                <span class="product-widget-number">(76)</span>
                            </label>
                        </li>
                    </ul>
                    <button type="submit" class="product-widget-btn">
                        <i class="fas fa-broom"></i>
                        <span>Clear Filter</span>
                    </button>
                </form>
            </div>
        </div>-->

        <div class="col-md-6 col-lg-12">
            <div class="product-widget">
                <h6 class="product-widget-title">Filter by Rating</h6>
                <form method="GET" action="{{ route('view.all.listing') }}" class="product-widget-form">
                    <ul class="product-widget-list">
                        @for ($i = 5; $i >= 1; $i--)
                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" id="rating-{{ $i }}" name="ratings[]"
                                        value="{{ $i }}"
                                        {{ in_array($i, request('ratings', [])) ? 'checked' : '' }}>
                                </div>
                                <label class="product-widget-label" for="rating-{{ $i }}">
                                    <span class="product-widget-star">
                                        @for ($j = 1; $j <= 5; $j++)
                                            <i class="fas {{ $j <= $i ? 'fa-star' : 'fa-star-o' }}"></i>
                                        @endfor
                                    </span>
                                </label>
                            </li>
                        @endfor
                    </ul>
                    <button type="submit" class="product-widget-btn mb-2">
                        <i class="fas fa-filter"></i> Apply Filter
                    </button>
                    <a href="{{ route('view.all.listing') }}" class="product-widget-btn clear-filter">
                        <i class="fas fa-broom"></i> Clear Filter
                    </a>
                </form>
            </div>
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
        $('#price-filter-form').on('submit', function(e) {
            e.preventDefault();
            let minPrice = $('#min-price').val();
            let maxPrice = $('#max-price').val();

            $.ajax({
                url: '/view-all-listing',
                method: 'GET',
                data: {
                    min_price: minPrice,
                    max_price: maxPrice,
                },
                success: function(response) {
                    if (typeof response === 'string') {
                        $('#products-container').html(response);
                    } else if (Array.isArray(response)) {
                        let typeList = '';
                        response.forEach(function(type) {
                            typeList += `
                            <li class="product-widget-item">
                                <div class="product-widget-checkbox">
                                    <input type="checkbox" id="type-${type.id}" data-type="${type.name}">
                                </div>
                                <label class="product-widget-label" for="type-${type.id}">
                                    <span class="product-widget-type ${type.name.toLowerCase()}">${type.name}</span>
                                    <span class="product-widget-number">(${type.count})</span>
                                </label>
                            </li>
                        `;
                        });
                        $('#type-filter-form .product-widget-list').html(typeList);
                    }
                },
                error: function(xhr) {
                    console.error('Failed to apply filters:', xhr);
                }
            });
        });

        $('#type-filter-form').on('change', '.product-widget-checkbox input', function() {
            let selectedTypes = [];
            $('#type-filter-form .product-widget-checkbox input:checked').each(function() {
                selectedTypes.push($(this).data('type'));
            });

            $.ajax({
                url: '/view-all-listing',
                method: 'GET',
                data: {
                    types: selectedTypes
                },
                success: function(response) {

                    renderProducts(response);
                    console.log(response);
                },
                error: function(xhr) {
                    console.error('Error applying type filter:', xhr);
                }
            });
        });

        function renderProducts(products) {
            let html = '';

            if (products.length) {
                products.forEach(function(product) {
                    html += `
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-5">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img src="${product.image_url}" alt="${product.name}" height="200">
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge ${product.ad_type.toLowerCase()}">${product.ad_type}</span>
                                </div>
                            </div>
                            <div class="product-content">
                                <h5 class="product-title">${product.name}</h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i> ${product.location}</span>
                                    <span><i class="fas fa-clock"></i> ${product.created_at}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">${product.price}</h5>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                html = '<p>No products found matching the filters.</p>';
            }
            $('#products-container').html(html);
        }

        function filterCities() {
            const input = document.getElementById('citySearch').value.toLowerCase();
            const list = document.getElementById('cityList');
            const items = list.getElementsByTagName('li');

            for (let i = 0; i < items.length; i++) {
                const city = items[i].textContent || items[i].innerText;
                items[i].style.display = city.toLowerCase().includes(input) ? '' : 'none';
            }
        }
    });
</script>
