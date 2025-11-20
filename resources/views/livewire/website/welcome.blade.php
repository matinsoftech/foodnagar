<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <!-- Google fonts Start-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <style>
        /* Bootstrap Custom Variables */
        :root {
            --bs-primary: #282932;
            --bs-secondary: #f2efe6;
            --bs-warning: #fbce0f;
            --bs-orange: #f7b614;
            --bs-font-sans-serif: "DM Sans", sans-serif;
        }

        /* Custom CSS Variables for Brand Colors */
        :root {
            --primary-bg: #282932;
            --white: #fff;
            --secondary-bg: #f2efe6;
            --light-primary: #fbce0f;
            --tertiary-bg: #f7b614;
        }

        /* Bootstrap Custom Overrides - Minimal */
        .hero-sec {
            background-color: var(--primary-bg);
        }

        .sit-at-home-sec {
            background-color: var(--primary-bg);
        }

        .hot-pizza-sec {
            background-color: var(--tertiary-bg);
        }

        .our-application-sec {
            background-color: var(--secondary-bg);
        }

        .footer-bg {
            background-color: #2c2c34;
        }

        /* Minimal Custom CSS - Only where Bootstrap is insufficient */
        body {
            font-family: var(--bs-font-sans-serif);
        }




        /* Custom hover effects */
        .service-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .food-img:hover img {
            transform: scale(1.05);
        }

        /* Custom background images */
        .header-back-img {
            background-image: url("{{ asset('images/website/slider-glob.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }

        .hot-pizzza-back-img {
            background-image: url("{{ asset('images/website/waves_white-15.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }

        .footer-img {
            background-image: url("{{ asset('images/website/slider-glob.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }

        /* Custom testimonial styles */
        .testimonial {
            display: none;
            animation: fade 1s ease-in-out;
        }

        .testimonial.active {
            display: block;
        }

        .quote {
            font-size: 2.5rem;
            color: #f4b400;
            margin: 1.25rem 0;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            display: inline-block;
            border-radius: 50%;
            background-color: #bbb;
            cursor: pointer;
        }

        .dot.active {
            background-color: #f4b400;
        }

        @keyframes fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Custom call section styles */
        .call-icon {
            background: #c9c5c5;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: orange;
            flex-shrink: 0;
            position: absolute;
            border: 9px solid white;
            right: 65%;
            transform: translateX(-50%);
            transition: transform 0.3s ease;
        }

        .call-icon:hover {
            transform: translateX(-50%) scale(1.1);
        }

        /* Custom go to top button */
        .go_to_top {
            position: fixed;
            bottom: 25px;
            right: 2%;
            z-index: 1000;
            width: 65px;
            height: 65px;
            opacity: 0;
            display: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .go_to_top:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .go_to_top.whatsapp-btn {
            background-color: #198754;
            bottom: 100px;
            opacity: 1;
        }

        /* Accessibility and Performance */
        html {
            scroll-behavior: smooth;
        }

        /* Focus states for accessibility */
        .btn:focus,
        .navbar-toggler:focus,
        .go_to_top:focus,
        .go_to_top a:focus {
            outline: 2px solid #ff9800;
            outline-offset: 2px;
        }

        /* Mobile responsiveness for go to top button */
        @media (max-width: 768px) {
            .go_to_top {
                width: 55px;
                height: 55px;
                bottom: 20px;
                right: 15px;
            }

            .go_to_top.whatsapp-btn {
                bottom: 85px;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .food-img:hover img {
                transform: none;
            }

            .service-box:hover {
                transform: none;
            }
        }

        /* Print styles */
        @media print {

            .go_to_top,
            .whatsapp-btn {
                display: none !important;
            }
        }

        /* footer en */
    </style>
</head>

<body id="top">
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-bg);">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://food.matinsoftech.com/storage/logos/b8LQuPn2ZG9XTDwwXLsuQzScsQXxHhc0QHw7fiDD.png"
                    alt="Food Delivery Logo" class="img-fluid" style="max-height: 50px;">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#about-us">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#testimonial">Testimonials</a>
                    </li>
                </ul>

                <!-- Right Section - Hidden on mobile, shown on xl+ -->
                <div class="d-none d-xl-flex align-items-center gap-3">
                    <img src="{{ asset('images/website/App_Store_iOS-Badge-Logo.wine.png') }}"
                        alt="Download on App Store" class="img-fluid" style="max-height: 40px;">
                    <a href="https://play.google.com/store/apps/details?id=com.himalride.user&pcampaignid=web_share"
                        target="_blank" class="text-decoration-none">
                        <img src="{{ asset('images/website/app-2.png') }}" alt="Download on Google Play"
                            class="img-fluid" style="max-height: 40px;">
                    </a>
                    <a href="tel:+977-9705678786"
                        class="text-warning text-decoration-none d-flex align-items-center gap-2">
                        <i class="fa-solid fa-phone"></i>
                        <span class="d-xxl-inline">+977-9705678786</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero-sec py-5">
        <div class="header-back-img container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="text-center text-lg-start">
                        <h1 class="display-4 display-md-3 display-lg-2 fw-bold text-white mb-3">
                            Express<br>
                            <span class="text-warning">Food Delivery</span>
                        </h1>
                        <p class="lead fs-5 fs-md-4 text-white mb-4">
                            Craving your favorites? Get fresh meals from top restaurants delivered fast and hassle-free.
                        </p>
                        <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                            <a href="#" class="text-decoration-none">
                                <img src="{{ asset('images/website/App_Store_iOS-Badge-Logo.wine.png') }}"
                                    alt="Download on App Store" class="img-fluid" style="max-width: 142px;">
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.himalride.user&pcampaignid=web_share"
                                target="_blank" class="text-decoration-none">
                                <img src="{{ asset('images/website/app-2.png') }}" alt="Download on Google Play"
                                    class="img-fluid" style="max-width: 142px;">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-12 d-none d-md-block">
                    <div class="text-center">
                        <img src="{{ asset('images/website/slider-courier-mask.png') }}"
                            alt="Food Delivery Boy in a Scooter" class="img-fluid" />
                    </div>
                </div>
            </div>
            <!-- Service Categories -->
            <div class="row g-3 mt-5 justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="service-box bg-light rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                        <div class="bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/website/meat-fish.png') }}" alt="Meat Fish" class="img-fluid"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Meat Fish</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="service-box bg-light rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                        <div class="bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/website/drinks.png') }}" alt="Drinks" class="img-fluid"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Drinks</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="service-box bg-light rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                        <div class="bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/website/grocery.png') }}" alt="grocery" class="img-fluid"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Grocery</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="service-box bg-light rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                        <div class="bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/website/resturant.png') }}" alt="resturant" class="img-fluid"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Resturant</h5>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="service-box bg-light rounded-3 p-3 d-flex align-items-center gap-3 h-100">
                        <div class="bg-warning rounded-circle p-3 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('images/website/dhamaka.png') }}" alt="Dhamaka" class="img-fluid"
                                style="width: 50px; height: 50px;">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Dhamaka</h5>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- Recommendations Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold text-warning mb-5 fs-1 fs-md-2">Our Recommendations</h2>
            <div class="row g-4">
                <div class="col-xl-6 col-12">
                    <div class="row g-4">
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/mutton-thakali-set.jpg') }}"
                                        alt="Mutton Thakali Set - Traditional Nepali Food" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Mutton Thakali Set</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/chickenroast.jpg') }}"
                                        alt="Chicken Roast - Delicious Roasted Chicken" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Chicken Roast</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/mutton-biryani.jpg') }}"
                                        alt="Mutton Biryani - Spicy Rice Dish" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Mutton Biryani</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/chaumin.png') }}"
                                        alt="Chowmein - Chinese Noodles" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Chowmein</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12">
                    <div class="row g-4">
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/chickenmomo.webp') }}"
                                        alt="Chicken Momo - Nepali Dumplings" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Chicken Momo</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/chesse-pizza.jpg') }}"
                                        alt="Cheese Pizza - Italian Style Pizza" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Cheese Pizza</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/chicken-burger.jpg') }}"
                                        alt="Chicken Burger - Juicy Burger" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Burger</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-2">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-img-top overflow-hidden rounded-top">
                                    <img src="{{ asset('images/website/porksekuwa.jpeg') }}"
                                        alt="Pork Sekuwa - Grilled Pork" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">Pork Sekuwa</h5>
                                    <div class="mt-auto">
                                        <a href="#"
                                            class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                                            Order Now
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section -->
    <section class="sit-at-home-sec py-5" id="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="text-center">
                        <img src="{{ asset('images/website/sit-photo.png') }}" alt="Sit at Home - We Will Take Care"
                            class="img-fluid" style="max-height: 500px;">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="p-4 p-lg-5">
                        <h2 class="display-5 display-md-4 fw-bold text-white mb-4">
                            Sit at Home<br>
                            <span class="text-warning">We Will Take Care</span>
                        </h2>
                        <p class="lead fs-5 fs-md-4 text-white mb-4">
                            Good food, delivered right to your doorstep. Fresh, quick, and easy—so you can focus on what
                            matters.
                        </p>
                    </div>
                    <div class="row g-3 px-3">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="text-center">
                                <div class="text-warning mb-2">
                                    <i class="fa-solid fa-clock fs-1"></i>
                                </div>
                                <h6 class="text-white fw-bold">Fast Delivery</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="text-center">
                                <div class="text-warning mb-2">
                                    <i class="fa-solid fa-bowl-food fs-1"></i>
                                </div>
                                <h6 class="text-white fw-bold">Wide Selection</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="text-center">
                                <div class="text-warning mb-2">
                                    <i class="fa-solid fa-credit-card fs-1"></i>
                                </div>
                                <h6 class="text-white fw-bold">Easy Payments</h6>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="text-center">
                                <div class="text-warning mb-2">
                                    <i class="fa-solid fa-location-dot fs-1"></i>
                                </div>
                                <h6 class="text-white fw-bold">Real-Time Tracking</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="py-5" id="testimonial">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12 text-center">
                    <p class="text-warning fw-bold mb-2">Testimonials</p>
                    <h2 class="display-5 fw-bold mb-5">Why Our Clients Choose Us</h2>

                    <div class="testimonial active">
                        <div class="quote text-warning fs-1 mb-3">❝</div>
                        <h5 class="mb-4">The food always arrives on time and still warm. It's become my go-to app for
                            dinner after work.</h5>
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Sajan Shrestha"
                                class="rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Sajan Shrestha</h5>
                            <h6 class="fw-bold text-warning">Marketing Manager</h6>
                        </div>
                    </div>

                    <div class="testimonial">
                        <div class="quote text-warning fs-1 mb-3">❝</div>
                        <h5 class="mb-4">So easy to use and the delivery drivers are always polite. Love the variety
                            of restaurants available.</h5>
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/35.jpg" alt="Anita Gurung"
                                class="rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Anita Gurung</h5>
                            <h6 class="fw-bold text-warning">Software Engineer</h6>
                        </div>
                    </div>

                    <div class="testimonial">
                        <div class="quote text-warning fs-1 mb-3">❝</div>
                        <h5 class="mb-4">I was surprised how quickly my order arrived. Tracking made it stress-free.
                        </h5>
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/4.jpg" alt="Bikash Thapa"
                                class="rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Bikash Thapa</h5>
                            <h6 class="fw-bold text-warning">Finance Officer</h6>
                        </div>
                    </div>

                    <div class="mt-4">
                        <span class="dot active me-2" onclick="showSlide(0)"></span>
                        <span class="dot me-2" onclick="showSlide(1)"></span>
                        <span class="dot" onclick="showSlide(2)"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hot Pizza Section -->
    <section class="hot-pizza-sec py-5">
        <div class="hot-pizzza-back-img container">
            <div class="owl-carousel hp-owl-hero">
                <!-- Item 1 -->
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5 col-12">
                            <div class="p-4">
                                <h2 class="display-4 display-md-3 display-lg-2 fw-bold text-white mb-3">Always<br>
                                    <span class="text-dark">the Hottest<br>Pizza</span>
                                </h2>
                                <p class="lead fs-5 fs-md-4 text-dark mb-4">
                                    Freshly baked, straight from the oven — every pizza is made with hand-tossed dough,
                                    rich tomato sauce, premium toppings, and gooey cheese. Served piping hot to keep
                                    every
                                    bite as delicious as the first.
                                </p>
                                <button type="button" class="btn btn-light btn-lg rounded-pill px-4">
                                    Get Pizza
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="text-center">
                                <img src="{{ asset('images/website/pizza.png') }}" alt="Hot Pizza - Fresh from Oven"
                                    class="img-fluid" style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5 col-12">
                            <div class="p-4">
                                <h2 class="display-4 fw-bold text-white mb-3">Always<br>
                                    <span class="text-dark">the Freshest<br>Momos</span>
                                </h2>
                                <p class="lead text-dark mb-4">
                                    Our momos are filled with juicy vegetables and tender meats. Paired with spicy
                                    dipping sauce,
                                    each bite is a burst of authentic taste straight from the Himalayas.
                                </p>
                                <button type="button" class="btn btn-light btn-lg rounded-pill px-4">
                                    Get Momos
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="text-center">
                                <img src="https://png.pngtree.com/png-clipart/20250206/original/pngtree-traditional-newari-momos-on-white-background-png-image_20372781.png"
                                    alt="Hot Momos - Traditional Nepali Dumplings" class="img-fluid"
                                    style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5 col-12">
                            <div class="p-4">
                                <h2 class="display-4 fw-bold text-white mb-3">Always<br>
                                    <span class="text-dark">the Juiciest<br>Burgers</span>
                                </h2>
                                <p class="lead text-dark mb-4">
                                    Our burgers are made with fresh buns, tender patties, crunchy veggies, and secret
                                    sauces. Every bite is bursting with flavor, making it the ultimate comfort food
                                    you'll crave again and again.
                                </p>
                                <button type="button" class="btn btn-light btn-lg rounded-pill px-4">
                                    Get Burger
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="text-center">
                                <img src="https://png.pngtree.com/png-clipart/20240830/original/pngtree-burger-with-floating-ingredient-png-image_15881303.png"
                                    alt="Delicious Burger - Juicy and Fresh" class="img-fluid"
                                    style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /owl-carousel -->
        </div>
    </section>
    <!-- Application Section -->
    <section class="our-application-sec py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="p-4">
                        <h2 class="display-5 display-md-4 fw-bold text-dark mb-3">
                            Get More With <span class="text-warning">our<br>Application</span>
                        </h2>
                        <p class="lead fs-5 fs-md-4 text-dark mb-4">
                            Stay connected and enjoy a seamless shopping experience right at your fingertips. Our app is
                            designed to make your orders faster, safer, and more rewarding.
                        </p>
                    </div>

                    <div class="row g-3 px-4">
                        <div class="col-12 d-flex align-items-center gap-3">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <span class="text-white fw-bold">01</span>
                            </div>
                            <h5 class="fw-bold mb-0">Follow Delivery Status</h5>
                        </div>
                        <div class="col-12 d-flex align-items-center gap-3">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <span class="text-white fw-bold">02</span>
                            </div>
                            <h5 class="fw-bold mb-0">Easy Reorders</h5>
                        </div>
                        <div class="col-12 d-flex align-items-center gap-3">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <span class="text-white fw-bold">03</span>
                            </div>
                            <h5 class="fw-bold mb-0">Secure Payments</h5>
                        </div>
                        <div class="col-12 d-flex align-items-center gap-3">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; min-width: 50px;">
                                <span class="text-white fw-bold">04</span>
                            </div>
                            <h5 class="fw-bold mb-0">Exclusive Offers</h5>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-center justify-content-md-start mt-4">
                        <a href="#" class="text-decoration-none">
                            <img src="{{ asset('images/website/App_Store_iOS-Badge-Logo.wine.png') }}"
                                alt="Download on App Store" class="img-fluid" style="max-width: 142px;">
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.himalride.user&pcampaignid=web_share"
                            target="_blank" class="text-decoration-none">
                            <img src="{{ asset('images/website/app-2.png') }}" alt="Download on Google Play"
                                class="img-fluid" style="max-width: 142px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 d-none d-md-block">
                    <div class="text-center">
                        <img src="{{ asset('images/website/app_image.png') }}"
                            alt="Mobile App Interface - Download Our App" class="img-fluid"
                            style="max-height: 600px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer-bg">
        <div class="footer-img container">
            <!-- Call Section - Hidden on mobile, shown on lg+ -->
            <div class="d-none d-lg-block py-5">
                <div class="row align-items-center bg-warning rounded-3 overflow-hidden shadow">
                    <div class="col-md-6 p-0">
                        <img src="{{ asset('images/website/footer-banner.png') }}"
                            alt="Customer Support - Call Us Now" class="img-fluid w-100"
                            style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-6 p-4 position-relative">
                        <div class="call-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="text-center">
                            <small class="text-dark d-block mb-2">Call us to make order now</small>
                            <strong class="fs-4">
                                <a class="text-dark text-decoration-none" href="tel:+977-9705678786">
                                    +977-9705678786
                                </a>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo and Social Icons -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <a href="#" class="text-decoration-none">
                        <img src="https://food.matinsoftech.com/storage/logos/b8LQuPn2ZG9XTDwwXLsuQzScsQXxHhc0QHw7fiDD.png"
                            alt="Food Delivery Logo" class="img-fluid" style="max-height: 60px;">
                    </a>
                </div>
                <div class="d-flex justify-content-center gap-4 pb-4 border-bottom border-secondary">
                    <a href="#" class="text-warning fs-2">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" class="text-warning fs-2">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-warning fs-2">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="text-warning fs-2">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
                <div class="pt-3">
                    <p class="text-warning mb-0">
                        Matin Softech <span class="text-white">2025 All Rights Reserved.</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Floating Action Buttons -->
    <div class="go_to_top bg-warning rounded-circle d-flex flex-column align-items-center justify-content-center"
        id="goToTopBtn" role="button" tabindex="0" aria-label="Scroll to top">
        <a href="#top" class="text-decoration-none text-dark text-center" id="goToTopLink"
            aria-label="Scroll to top of page">
            <i class="fa-solid fa-rocket"></i>
            <p class="fw-bold mb-0 small">Go top</p>
        </a>
    </div>
    <div class="whatsapp-btn go_to_top bg-success rounded-circle d-flex align-items-center justify-content-center">
        <a href="https://wa.me/9827346441" class="text-decoration-none text-white">
            <i class="fa-brands fa-whatsapp fs-2"></i>
        </a>
    </div>
    <!--  -->
</body>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
</script>
<!--  -->
<!--Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"></script>
<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    // Bootstrap navbar handles mobile menu automatically
    // testimonials
    let index = 0;
    const testimonials = document.querySelectorAll(".testimonial");
    const dots = document.querySelectorAll(".dot");
    let testimonialInterval;

    function showSlide(n) {
        testimonials.forEach((t, i) => {
            t.classList.remove("active");
            dots[i].classList.remove("active");
        });
        testimonials[n].classList.add("active");
        dots[n].classList.add("active");
        index = n;
    }

    function autoSlide() {
        index = (index + 1) % testimonials.length;
        showSlide(index);
    }

    function startTestimonialSlider() {
        testimonialInterval = setInterval(autoSlide, 4000);
    }

    function stopTestimonialSlider() {
        clearInterval(testimonialInterval);
    }

    // Start testimonial slider
    startTestimonialSlider();

    // Pause on hover for better UX
    const testimonialSection = document.querySelector('.testimonial-section');
    if (testimonialSection) {
        testimonialSection.addEventListener('mouseenter', stopTestimonialSlider);
        testimonialSection.addEventListener('mouseleave', startTestimonialSlider);
    }
    // testimonials
    $('.hp-owl-hero').owlCarousel({
        items: 1, // one full row per slide
        loop: true, // infinite
        margin: 0,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3500, // slide interval
        autoplayHoverPause: true,
        smartSpeed: 600,
        responsive: {
            0: {
                items: 1,
                margin: 10
            },
            480: {
                items: 1,
                margin: 20
            },
            768: {
                items: 1,
                margin: 0
            },
            1024: {
                items: 1,
                margin: 0
            }
        }
    });

    // Add touch/swipe support for mobile
    $('.hp-owl-hero').on('touchstart', function() {
        $(this).trigger('stop.owl.autoplay');
    });

    $('.hp-owl-hero').on('touchend', function() {
        $(this).trigger('play.owl.autoplay');
    });

    // Bootstrap handles mobile menu interactions automatically

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Go to top button functionality
    const goToTopBtn = document.getElementById('goToTopBtn');
    const goToTopLink = document.getElementById('goToTopLink');

    // Check if elements exist
    if (goToTopBtn && goToTopLink) {
        // Show/hide button based on scroll position
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                if (window.pageYOffset > 300) {
                    goToTopBtn.style.display = 'flex';
                    goToTopBtn.style.opacity = '1';
                } else {
                    goToTopBtn.style.opacity = '0';
                    setTimeout(() => {
                        if (goToTopBtn.style.opacity === '0') {
                            goToTopBtn.style.display = 'none';
                        }
                    }, 300);
                }
            }, 10);
        });

        // Smooth scroll to top functionality
        goToTopLink.addEventListener('click', function(e) {
            e.preventDefault();

            // Check for reduced motion preference
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                // Instant scroll for users who prefer reduced motion
                window.scrollTo(0, 0);
            } else {
                // Smooth scroll
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        // Alternative method using jQuery for better compatibility
        $(goToTopLink).on('click', function(e) {
            e.preventDefault();
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                $('html, body').scrollTop(0);
            } else {
                $('html, body').animate({
                    scrollTop: 0
                }, 800, 'swing');
            }
        });

        // Keyboard support for accessibility
        goToTopBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                goToTopLink.click();
            }
        });
    }

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove('loading');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img').forEach(img => {
            img.classList.add('loading');
            imageObserver.observe(img);
        });
    }

    // Performance optimization: Debounce resize events
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            // Trigger any resize-dependent functions here
            if (window.innerWidth > 992) {
                const menu = document.getElementById('menu');
                if (menu) {
                    menu.classList.remove('show');
                }
            }
        }, 250);
    });
</script>

</html>
