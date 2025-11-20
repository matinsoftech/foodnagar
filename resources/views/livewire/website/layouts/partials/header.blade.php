<div class="py-5">
    <div class="container">
        <div class="row w-100 align-items-center gx-lg-2 gx-0">
            <div class="col-xxl-3 col-lg-3 col-md-6 col-5">
                <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
                    <img src="{{ appLogo() }}" style="max-width: 8rem;width: 100%" alt="website brand logo" />
                </a>
                <div class="d-flex justify-content-between w-100 d-lg-none">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ appLogo() }}" style="height:2rem;" alt="" />
                    </a>
                </div>
            </div>
            <div class="col-xxl-8 col-lg-8 d-none d-lg-block">
                <form class="position-relative" action="{{ route('search') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input id="search" name="search" class="searchProduct form-control rounded" type="search"
                            placeholder="Search anything" />
                        <span class="input-group-append">
                            <button class="btn border border-start-0 ms-n10 rounded-0 rounded-end header-search-btn"
                                type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <span>Search</span>
                            </button>
                        </span>
                    </div>
                    <ul id="search-results" class="list-group position-absolute w-100 mt-2"
                        style="z-index: 1000; display: none;">
                        <li class="list-group-item">Suggestion 1</li>
                        <li class="list-group-item">Suggestion 2</li>
                        <li class="list-group-item">Suggestion 3</li>
                    </ul>
                </form>
            </div>
            <div class="col-lg-1 col-xxl-1 text-end col-md-6 col-7">
                <div class="d-none d-lg-block mr-2 text-nowrap">

                    <div class="flex-shrink-0 bg-success text-white rounded d-flex justify-content-between align-items-center gap-1"
                        style="padding-left: 0.4rem">
                        <div class="lh-1">
                            @if (!Auth::check())
                                <a href="#" data-bs-toggle="modal" data-bs-target="#userModal">
                                    <p class="text-transform-uppercase fw-bold fs-5 mb-0 text-white text-start">Add</p>
                                    <p class="mb-0 text-white">Listing</p>
                                </a>
                            @else
                                <a href="{{ url('user-add-listing') }}">
                                    <p class="text-transform-uppercase fw-bold fs-5 mb-0 text-white text-start">Add</p>
                                    <p class="mb-0 text-white">Listing</p>
                                </a>
                            @endauth
                    </div>
                    <div class="gap-1 mb-3 mb-lg-0 register_btn  rounded bg-success flex-shrink-0">
                        <figure class="m-0 p-1 rounded bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="black" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15">
                                </path>
                            </svg>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="list-inline d-lg-none d-block">
                <div class="list-inline-item me-5">
                    <a href="https://kartcomfort.com/wishlist " class="text-muted position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                            style="background-color:#662f88">
                            5
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </div>
                <div class="list-inline-item me-5">

                    <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                </div>
                <div class="list-inline-item me-5 me-lg-0">
                    <a class="text-muted position-relative" href="https://kartcomfort.com/cart ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                            style="background-color:#662f88">
                            1
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </div>
                <div class="list-inline-item d-inline-block d-lg-none">
                    <!-- Button -->
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#navbar-default" aria-controls="navbar-default"
                        aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                            fill="currentColor" class="bi bi-text-indent-left" style="color: #662f88;"
                            viewBox="0 0 16 16">
                            <path
                                d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<nav class="navbar navbar-expand-lg navbar-default m-auto" aria-label="Offcanvas navbar large">
<div class="container">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default"
        aria-labelledby="navbar-defaultLabel">
        <div class="offcanvas-header pb-1">
            <a href="{{ url('/') }}"><img src="assets/images/logo/freshcart-logo.svg"
                    alt="eCommerce HTML Template" /></a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body justify-content-between align-items-center pe-4">
            <div>
                <div class="d-block d-lg-none mb-4">
                    <form action="#">
                        <div class="input-group">
                            <input class="form-control rounded" type="search"
                                placeholder="Search for products" />
                            <span class="input-group-append">
                                <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65">
                                        </line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-gray-400 text-muted w-100"
                            data-bs-toggle="modal" data-bs-target="#locationModal">
                            <i class="feather-icon icon-map-pin me-2"></i>
                            Pick Location
                        </button>
                    </div>
                </div>
                <div class="d-block d-lg-none mb-4">
                    <button type="button" class="btn header-location-btn" data-bs-toggle="modal"
                        data-bs-target="#locationModal">
                        <i class="feather-icon icon-map-pin me-2"></i>
                        Location
                    </button>
                </div>
                <div class="dropdown d-none d-lg-block">
                    <button type="button" class="btn header-location-btn" data-bs-toggle="modal"
                        data-bs-target="#locationModal">
                        <i class="feather-icon icon-map-pin me-2"></i>
                        Location
                    </button>
                </div>
            </div>
            <div>
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link" href="{{ url('about') }}">About</a>
                    </li>
                    <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link" href="{{ url('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link" href="{{ url('blog-list') }}">Blogs</a>
                    </li>
                    @if ($check_module_type == 'multi')
                        <li class="nav-item dropdown w-100 w-lg-auto">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Modules</a>
                            <ul class="dropdown-menu">
                                @foreach ($vendortypes as $vendortype)
                                    <li>
                                        <a class="dropdown-item" href="{{ $vendortype->base_url }}">
                                            {{ $vendortype->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Vendor Panel</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('admin/login') }}">Vendor
                                    Signin</a></li>
                            <li><a class="dropdown-item" href="{{ url('admin/register/vendor') }}">Vendor
                                    Signup</a></li>
                        </ul>
                    </li>
                    {{-- @if (Auth::check())
                                <li class="nav-item w-100 w-lg-auto {{ Auth::check() ? 'd-block' : 'd-none' }}">
                                    <a class="nav-link">Welcome
                                        {{ Auth::check() ? auth()->user()->name : '' }}</a>
                                </li>
                            @endif --}}

                </ul>
            </div>
            <div class="list-inline d-flex align-items-center">
                <div class="list-inline-item me-5 dropdown">
                    <a href="{{ route('wishlist') }}" class="text-muted position-relative" id="wishlistDropdown"
                        role="button" data-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                            id="wishlist_count" style="background-color:#662f88">
                            0
                        </span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="wishlistDropdown">
                                <li>
                                    <span class="dropdown-item text-muted">No items in your Wishlist</span>
                                </li>
                            </ul> 
                </div>


                @if (!Auth::check())
                    <div class="list-inline-item me-4">
                        <a href="#!" class="text-muted " data-bs-toggle="modal"
                            data-bs-target="#userModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="nav-item dropdown w-100 w-lg-auto me-4">
                        <a class="nav-link dropdown-toggle user-nav-dropdown d-flex align-items-center"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="navbar-tool-text">
                                <small>
                                    Hello,
                                    <span class="user-name">
                                        {{ explode(' ', Auth::user()->name)[0] }}
                                    </span>
                                </small> <br>
                                Dashboard
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ url('account-orders') }}">Orders</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('account-settings') }}">Settings</a>
                            </li>
                            <li class="{{ Auth::check() ? 'd-block' : 'd-none' }}">
                                <form action="{{ route('web_logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
                @if (!Auth::check())
                    <div class="list-inline-item me-4 me-lg-0 dropdown">
                        <a class="text-muted position-relative cart-link" href="{{ url('login') }}"
                            role="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            onclick="redirectToLogin(event)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-shopping-bag">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                id="cart-count" style="background-color:#662f88">
                                0
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right __w-20rem cart-dropdown py-0"
                            aria-labelledby="cartDropdown">
                            <div class="widget widget-cart px-3 pt-2 pb-3">
                                <div class="widget-cart-top rounded">
                                    <h6 class="m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.03986 2.29234C2.85209 2.22644 2.64582 2.23782 2.46644 2.324C2.28707 2.41017 2.14927 2.56407 2.08336 2.75184C2.01745 2.93962 2.02884 3.14588 2.11501 3.32526C2.20119 3.50464 2.35509 3.64244 2.54286 3.70834L2.80386 3.79934C3.47186 4.03434 3.91086 4.18934 4.23386 4.34834C4.53686 4.49734 4.66986 4.61834 4.75786 4.74634C4.84786 4.87834 4.91786 5.06034 4.95786 5.42334C4.99786 5.80334 4.99986 6.29834 4.99986 7.03834V9.64034C4.99986 12.5823 5.06286 13.5523 5.92986 14.4663C6.79586 15.3803 8.18986 15.3803 10.9799 15.3803H16.2819C17.8429 15.3803 18.6239 15.3803 19.1749 14.9303C19.7269 14.4803 19.8849 13.7163 20.1999 12.1883L20.6999 9.76334C21.0469 8.02334 21.2199 7.15434 20.7759 6.57734C20.3319 6.00034 18.8159 6.00034 17.1309 6.00034H6.49186C6.4876 5.75386 6.47326 5.50765 6.44886 5.26234C6.39486 4.76534 6.27886 4.31234 5.99686 3.90034C5.71286 3.48434 5.33486 3.21834 4.89386 3.00134C4.48186 2.79934 3.95786 2.61534 3.34186 2.39834L3.03986 2.29234ZM12.9999 8.25034C13.1988 8.25034 13.3895 8.32936 13.5302 8.47001C13.6708 8.61067 13.7499 8.80143 13.7499 9.00034V10.2503H14.9999C15.1988 10.2503 15.3895 10.3294 15.5302 10.47C15.6708 10.6107 15.7499 10.8014 15.7499 11.0003C15.7499 11.1993 15.6708 11.39 15.5302 11.5307C15.3895 11.6713 15.1988 11.7503 14.9999 11.7503H13.7499V13.0003C13.7499 13.1993 13.6708 13.39 13.5302 13.5307C13.3895 13.6713 13.1988 13.7503 12.9999 13.7503C12.8009 13.7503 12.6102 13.6713 12.4695 13.5307C12.3289 13.39 12.2499 13.1993 12.2499 13.0003V11.7503H10.9999C10.8009 11.7503 10.6102 11.6713 10.4695 11.5307C10.3289 11.39 10.2499 11.1993 10.2499 11.0003C10.2499 10.8014 10.3289 10.6107 10.4695 10.47C10.6102 10.3294 10.8009 10.2503 10.9999 10.2503H12.2499V9.00034C12.2499 8.80143 12.3289 8.61067 12.4695 8.47001C12.6102 8.32936 12.8009 8.25034 12.9999 8.25034Z"
                                                fill="#1455AC"></path>
                                        </svg>
                                        <span class="text-capitalize">
                                            Shopping cart
                                        </span>
                                    </h6>
                                </div>
                                <div class="widget-cart-item">
                                    <div class="text-center text-capitalize">
                                        <img class="mb-3 mw-100"
                                            src="{{ asset('images/website/empty-cart.svg') }}" alt="Cart">
                                        <p class="text-capitalize">Your Cart is Empty!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="list-inline-item me-4 me-lg-0 dropdown">
                        <a class="text-muted position-relative cart-link" href="{{ url('cart') }}"
                            role="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            onclick="redirectToCart(event)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-shopping-bag">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                id="cart-count" style="background-color:#662f88">
                                0
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right __w-20rem cart-dropdown py-0"
                            aria-labelledby="cartDropdown">
                            <div class="widget widget-cart px-3 pt-2 pb-3">
                                <div class="widget-cart-top rounded">
                                    <h6 class="m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.03986 2.29234C2.85209 2.22644 2.64582 2.23782 2.46644 2.324C2.28707 2.41017 2.14927 2.56407 2.08336 2.75184C2.01745 2.93962 2.02884 3.14588 2.11501 3.32526C2.20119 3.50464 2.35509 3.64244 2.54286 3.70834L2.80386 3.79934C3.47186 4.03434 3.91086 4.18934 4.23386 4.34834C4.53686 4.49734 4.66986 4.61834 4.75786 4.74634C4.84786 4.87834 4.91786 5.06034 4.95786 5.42334C4.99786 5.80334 4.99986 6.29834 4.99986 7.03834V9.64034C4.99986 12.5823 5.06286 13.5523 5.92986 14.4663C6.79586 15.3803 8.18986 15.3803 10.9799 15.3803H16.2819C17.8429 15.3803 18.6239 15.3803 19.1749 14.9303C19.7269 14.4803 19.8849 13.7163 20.1999 12.1883L20.6999 9.76334C21.0469 8.02334 21.2199 7.15434 20.7759 6.57734C20.3319 6.00034 18.8159 6.00034 17.1309 6.00034H6.49186C6.4876 5.75386 6.47326 5.50765 6.44886 5.26234C6.39486 4.76534 6.27886 4.31234 5.99686 3.90034C5.71286 3.48434 5.33486 3.21834 4.89386 3.00134C4.48186 2.79934 3.95786 2.61534 3.34186 2.39834L3.03986 2.29234ZM12.9999 8.25034C13.1988 8.25034 13.3895 8.32936 13.5302 8.47001C13.6708 8.61067 13.7499 8.80143 13.7499 9.00034V10.2503H14.9999C15.1988 10.2503 15.3895 10.3294 15.5302 10.47C15.6708 10.6107 15.7499 10.8014 15.7499 11.0003C15.7499 11.1993 15.6708 11.39 15.5302 11.5307C15.3895 11.6713 15.1988 11.7503 14.9999 11.7503H13.7499V13.0003C13.7499 13.1993 13.6708 13.39 13.5302 13.5307C13.3895 13.6713 13.1988 13.7503 12.9999 13.7503C12.8009 13.7503 12.6102 13.6713 12.4695 13.5307C12.3289 13.39 12.2499 13.1993 12.2499 13.0003V11.7503H10.9999C10.8009 11.7503 10.6102 11.6713 10.4695 11.5307C10.3289 11.39 10.2499 11.1993 10.2499 11.0003C10.2499 10.8014 10.3289 10.6107 10.4695 10.47C10.6102 10.3294 10.8009 10.2503 10.9999 10.2503H12.2499V9.00034C12.2499 8.80143 12.3289 8.61067 12.4695 8.47001C12.6102 8.32936 12.8009 8.25034 12.9999 8.25034Z"
                                                fill="#1455AC"></path>
                                        </svg>
                                        <span class="text-capitalize">
                                            Shopping cart
                                        </span>
                                    </h6>
                                </div>
                                <div class="simplebar-content" style="padding: 0px;">
                                    <div class="widget-cart-item">
                                        <div class="text-center text-capitalize">
                                            <img class="mb-3 mw-100"
                                                src="{{ asset('images/website/empty-cart.svg') }}"
                                                alt="Cart">
                                            <p class="text-capitalize">Your Cart is Empty!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

        </div>

    </div>
</div>
</div>
</nav>
