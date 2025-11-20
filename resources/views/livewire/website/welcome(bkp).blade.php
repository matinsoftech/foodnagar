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
        /* Utilities Classes and  Variables Start*/
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "DM Sans", sans-serif;
        }
        :root {
            font-size: 16px;
            --primary-bg: #282932;
            --white: #fff;
            --secondary-bg: #f2efe6;
            --light-primary: #fbce0f;
            --tertiary-bg: #f7b614;
            --txt-fs: 1rem;
            --text-lg-fs: 1.6rem;
            --main-head-fs: 4rem;
            --head-one-fs: 2.4rem;
            --head-two-fs: 2rem;
            --head-three-fs: 1.8rem;
            --section-padding-y: 4rem;
            --section-padding-x: 2rem;
            --head-margin-b: 1rem;
            --head-margin-t: 1rem;
        }
        .head_one_fs {
            font-size: var(--head-one-fs);
        }
        .padding-section-y {
            padding-block: var(--section-padding-y);
        }
        .cta-btn {
            background-color: var(--white);
            color: var(--primary-bg);
            border-radius: 100px;
            max-width: fit-content;
            padding: 10px 40px;
            font-size: var(--txt-fs);
            font-weight: 500;
        }
        .cta-btn:hover {
            background-color: var(--primary-bg);
            color: var(--white);
        }
        /* Utilities Classes and  Variables Start*/
        /*  */
        /* Hero Seciton Start */
        /*  */
        .hero-sec {
            background-color: var(--primary-bg);
        }
        .home-img img {
            width: 100%;
            object-fit: cover;
        }
        /*  */
        /* Hero Seciton End */
        /*  */
        header.navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--primary-bg);
            color: #fff;
            position: relative;
            border-bottom: 1px dashed gray;
        }
        /* Logo */
        .logo {
            font-size: 22px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo img {
            max-width: 270px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Menu */
        nav.menu {
            display: flex;
            gap: 20px;
            padding-top: 10px;
        }
        nav.menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            position: relative;
        }
        nav.menu a:hover,
        nav.menu a.active {
            color: #ff9800;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 180px;
            display: none;
            flex-direction: column;
            border-radius: 5px;
            overflow: hidden;
        }
        .dropdown-content a {
            padding: 10px 15px;
            color: black !important;
            display: block;
        }
        .dropdown-content a:hover {
            color: #ff9800;
        }
        .dropdown:hover .dropdown-content {
            display: flex;
        }
        .download_app img {
            max-width: 130px;
        }
        .phone {
            font-size: 1rem;
        }
        .icons {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 18px;
            cursor: pointer;
        }
        .cart {
            position: relative;
        }
        .cart span {
            position: absolute;
            top: -8px;
            right: -10px;
            background: orange;
            color: #fff;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
        /* Hamburger */
        .hamburger {
            font-size: 24px;
            cursor: pointer;
        }
        /* header en*/
        /* home page */
        .header-back-img {
            background-image: url("{{ asset('images/website/slider-glob.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }
        .home-text .home-title {
            font-size: var(--main-head-fs);
            font-weight: 800;
            line-height: 70px;
            letter-spacing: 3px;
        }
        .home-text p {
            color: white;
            font-weight: 400;
            font-size: var(--txt-fs);
            padding-top: 10px;
            margin-bottom: 45px;
        }
        .read-more-btn {
            background-color: orange;
            max-width: fit-content;
            padding: 10px 40px;
        }
        .read-more-btn:hover {
            background-color: white;
            border: none;
            transition-delay: 0.2s;
        }
        .services {
            position: relative;
        }
        .service-box {
            background-color: rgb(241, 230, 230);
            padding: 20px;
            cursor: pointer;
            border-radius: 20px;
            width: 100%;
        }
        .go_to_top {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: orange;
            position: fixed;
            bottom: 25px;
            right: 2%;
            z-index: 1000;
            width: 65px;
            height: 65px;
        }
        .go_to_top.whatsapp-btn {
            background-color: #25d366;
            bottom: 100px;
        }
        /* home page */
        /* sit home page */
        .sit-at-home-sec {
            background: var(--primary-bg);
            overflow: hidden;
        }
        .sit-home-title h2 {
            font-size: var(--head-one-fs);
            font-weight: 700;
        }
        .sit-home-icons i {
            font-size: 40px;
            color: var(--light-primary);
        }
        /* sit-home-page en */
        /* our recommadation st */
        .food-img {
            background-color: #f2efe6;
            margin-bottom: 2rem;
            border-radius: 14px;
            position: relative;
            padding: 16px;
            overflow: hidden;
        }
        .food-img .wrap {
            margin-bottom: 10px;
            transition: all 0.5s;
        }
        .food-img .wrap img {
            transition: all 0.5s;
        }
        .food-img:hover img {
            opacity: 0.9;
            transform: scale(1.18);
        }
        .order-food-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .order-food-btn a {
            color: var(--primary-bg);
            text-decoration: none;
        }
        .order-food-btn:hover a {
            color: var(--white);
        }
        .read-more-btns {
            background-color: #ffa500;
            max-width: fit-content;
            padding: 10px 40px;
            margin-inline: auto;
        }
        .read-more-btns:hover {
            background-color: rgb(7, 7, 7);
            color: white;
        }
        .read-more-btns:hover button {
            color: white;
        }
        /* hotted piza st */
        .hot-pizza-sec {
            overflow: hidden;
            background: var(--tertiary-bg);
        }
        .hot-pizzza-back-img {
            background-image: url("{{ asset('images/website/waves_white-15.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }
        .hot-pizza-title h2 {
            font-size: var(--main-head-fs);
        }
        .get-pizza-btn {
            max-width: fit-content;
            padding: 10px 40px;
            background-color: white;
            color: black !important;
        }
        .get-pizza-btn:hover {
            transition: all 0.3s;
            background-color: black;
            cursor: pointer;
        }
        .get-pizza-btn:hover button {
            color: white !important;
        }
        /* hot pizza en */
        /* testimonial */
        .testimonial-section {
            max-width: 700px;
            margin: auto;
        }
        .testimonial-title {
            color: #222;
            font-size: var(--head-one-fs);
            font-weight: bold;
        }
        .testimonial-sub {
            color: #f4b400;
            font-weight: bold;
            font-size: 14px;
        }
        .testimonial {
            display: none;
            animation: fade 1s ease-in-out;
        }
        .testimonial.active {
            display: block;
        }
        .quote {
            font-size: 40px;
            color: #f4b400;
            margin: 20px 0;
        }
        .testimonial p {
            font-size: 16px;
            color: #444;
            line-height: 1.6;
        }
        .client-img {
            margin-top: 20px;
        }
        .client-img img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid #eee;
        }
        .dots {
            margin-top: 15px;
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
        /* testimonial en */
        /* our Application st */
        .our-application-sec {
            overflow: hidden;
            background: var(--secondary-bg);
        }
        .our-application-title h2 {
            font-size: var(--main-head-fs);
            font-weight: 700;
        }
        /* our Application en */
        /* footer st */
        .footer-img {
            background-image: url("{{ asset('images/website/slider-glob.png') }}");
            background-position: center right;
            background-repeat: no-repeat;
        }
        .footer-bg {
            background: #2c2c34;
        }
        .call-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 80px 50px 80px;
        }
        .call-container {
            display: flex;
            align-items: center;
            /* background: white; */
            border-radius: 12px;
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        .call-container img {
            width: 50%;
            height: auto;
            object-fit: cover;
        }
        .call-info {
            background: #fcb900;
            padding: 47px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 20px;
        }
        .call-icon {
            background: #c9c5c5;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: orange;
            flex-shrink: 0;
            position: absolute;
            border: 9px solid white;
            right: 50%;
            transform: translateX(-50%);
        }
        .call-icon:hover {
            border: 7px solid black;
            background-color: none;
            color: black;
        }
        .call-text {
            display: flex;
            flex-direction: column;
        }
        .call-text small {
            font-size: 14px;
            color: #2c2c34;
            margin-bottom: 5px;
        }
        .call-text strong {
            font-size: 22px;
            color: #2c2c34;
        }
        .call-info {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
        }
        /* Responsive */
        @media screen and (max-width: 425px) {
            :root {
                --main-head-fs: 2.6rem;
            }
            .logo img {
                max-width: 200px;
            }
        }
        @media (max-width: 768px) {
            :root {
                --main-head-fs: 3rem;
            }
            .sit-at-home-sec {
                padding-block: var(--section-padding-y);
            }
            .home-text {
                text-align: center;
            }
            .home-text .home-title {
                font-size: 40px;
                line-height: 50px;
                padding-top: 1px;
            }
            .home-text p {
                text-align: center;
            }
            .read-more-btn {
                margin-inline: auto;
                padding: 10px 20px;
            }
            .service-box {
                background-color: rgb(241, 230, 230);
                cursor: pointer;
                border-radius: 20px;
                width: 100%;
            }
            .sit-home-title h2 {
                padding-top: 2%;
                font-size: 30px;
                text-align: center;
            }
            .sit-home-title p {
                font-size: 14px;
                text-align: center;
            }
            .our-application-title {
                text-align: center;
            }
            .text h5 {
                font-weight: 600;
                font-size: 15px;
                margin-top: 5px;
            }
            .app-btns .app-2 {
                margin-left: 13px;
                width: 64%;
            }
            .images img {
                padding: 0px 0px 0px 0px;
                height: 100px;
            }
            .letter-msg-icon {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .letter-text {
                text-align: center;
            }
            .call-container {
                flex-direction: column;
            }
            .call-container img {
                width: 100%;
                height: 150px;
            }
            .call-info {
                flex-direction: column;
                text-align: center;
            }
            .call-text strong {
                font-size: 20px;
            }
            .call-icon {
                background: #c9c5c5;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                color: orange;
                border: 9px solid white;
            }
            .call-info {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 10px;
            }
        }
        @media screen and (max-width: 992px) {
            /* Dropdown in mobile */
            .dropdown-content {
                position: static;
                background: white;
                padding: 10px;
            }
            .dropdown-content a {
                padding-left: 30px;
            }
            nav.menu a {
                color: black;
                text-align: center;
            }
            nav.menu {
                position: absolute;
                top: 100px;
                left: 0;
                right: 0;
                flex-direction: column;
                padding: 3rem 1rem;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 999;
            }
            nav.menu.show {
                background-color: white;
                transform: translateX(0%);
                transition: all 0.3s;
            }
        }
        /* footer en */
    </style>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="#" class="text-light" style="text-decoration: none;">
                    <img
                        src="https://food.matinsoftech.com/storage/logos/b8LQuPn2ZG9XTDwwXLsuQzScsQXxHhc0QHw7fiDD.png" />
                </a>
            </div>
            <!-- Menu -->
            <nav class="menu" id="menu">
                <a href="#" class="fw-medium">Home</a>
                <a href="#about-us" class="fw-medium">About</a>
                <a href="#testimonial" class="fw-medium">Testimonials</a>
            </nav>
            <!-- Right Section -->
            <div class="align-items-center gap-5 d-none d-xl-flex">
                <figure class="mb-0 download_app">
                    <img src="{{asset('images/website/App_Store_iOS-Badge-Logo.wine.png')}}"
                        alt="Dowload on Google play store image">
                </figure>
                <figure class="mb-0 download_app">
                    <a href="https://play.google.com/store/apps/details?id=com.himalride.user&pcampaignid=web_share" target="_blank">
                        <img src="{{asset('images/website/app-2.png')}}" alt="Dowload on App  store image">
                    </a>
                </figure>
                <a href="tel:+977-9705678786" class="phone  d-flex align-items-center gap-3" style="color: orange;">
                    <i class="fa-solid fa-phone"></i> +977-9705678786
                </a>
            </div>
            <!-- Hamburger -->
            <div class="hamburger  d-block d-lg-none" id="hamburger">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>
    <!--  -->
    <section class="hero-sec padding-section-y">
        <div class="header-back-img container">
            <div class="header-back-img">
                <div class="services mb-5">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-5 col-md-5 col-sm-6">
                            <div class="home-text">
                                <h1 class="home-title text-light">
                                    Express<br>
                                    <span class="text" style="color: orange;">Food Delivery</span>
                                </h1>
                                <p>Craving your favorites? Get fresh meals from top restaurants delivered fast and
                                    hassle-free.</p>
                                <div
                                    class="d-flex aligm-items-center gap-3 justify-content-center justify-content-md-start">
                                    <figure class="mb-0  download_app">
                                        <img style="max-width: 142px;"
                                            src="{{asset('images/website/App_Store_iOS-Badge-Logo.wine.png')}}"
                                            alt="Dowload on Google play store image">
                                    </figure>
                                    <figure class="mb-0 download_app">
                                        <a href="https://play.google.com/store/apps/details?id=com.himalride.user&amp;pcampaignid=web_share" target="_blank">
                                            <img style="max-width: 142px;" src="{{asset('images/website/app-2.png')}}"
                                                alt="Dowload on App  store image">
                                        </a>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 d-none d-md-block">
                            <div class="home-img">
                                <img src="{{ asset('images/website/slider-courier-mask.png') }}"
                                    alt="Food Delivery Boy in a Scooter" />
                            </div>
                        </div>
                    </div>
                    <div class="service mt-5 mt-md-3">
                        <div class="row flex-wrap justify-content-center">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="service-box d-flex mb-3 align-items-center gap-3">
                                    <div class="div">
                                        <div class="img rounded-circle px-3 py-3 d-flex align-item-center justify-content-center"
                                            style="background-color: orange;">
                                            {{-- <i class="fa-solid fa-burger fs-2 px-3"></i> --}}
                                            <img src="{{ asset('images/website/meat-fish.png') }}" alt="Meat Fish" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                    <div class="div">
                                        <div class="text">
                                            <h5 class="fw-bold">Meat Fish</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="service-box d-flex mb-3 align-items-center gap-3">
                                    <div class="div">
                                        <div class="img rounded-circle px-3 py-3 d-flex align-item-center justify-content-center"
                                            style="background-color: orange;">
                                            {{-- <i class="fa-solid fa-beer-mug-empty fs-2 px-3"></i> --}}
                                            <img src="{{ asset('images/website/dhamaka.png') }}" alt="Dhamaka" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                    <div class="div">
                                        <div class="text">
                                            <h5 class="fw-bold">Dhamaka</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="service-box d-flex mb-3 align-items-center gap-3">
                                    <div class="div">
                                        <div class="img rounded-circle px-3 py-3 d-flex align-item-center justify-content-center"
                                            style="background-color: orange;">
                                            {{-- <i class="fa-solid fa-cake-candles fs-2 px-3"></i> --}}
                                            <img src="{{ asset('images/website/drinks.png') }}" alt="Drinks" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                    <div class="div">
                                        <div class="text">
                                            <h5 class="fw-bold">Beverages & Drinks</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-md-4 col-sm-12">
                                <div class="service-box d-flex mb-3 align-items-center gap-3">
                                    <div class="div">
                                        <div class="img rounded-circle px-2 py-4 d-flex align-item-center justify-content-center"
                                            style="background-color: #ffa500;">
                                            <i class="fa-solid fa-bowl-food fs-2 px-3"></i>
                                        </div>
                                    </div>
                                    <div class="div">
                                        <div class="text">
                                            <h5 class="fw-bold">Briyani</h5>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <section class="Recommendations-sec padding-section-y">
        <div class="container overflow-hidden">
            <h5 class="text-center fw-bold head_one_fs mb-4 " style="color: #ffa500 ;">Our Recommendations</h5>
            <div class="row">
                <div class="col-xl-6 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <!-- <img class="rounded" src="{{ asset('images/website/mutton-thakali-set.jpg') }}"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/mutton-thakali-set.jpg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Mutton Thakali Set </h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/chickenroast.jpg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounde" src="/Images/chickenroast.jpg"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Chicken Roast</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/mutton-biryani.jpg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/mutton-biryani.jpg"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Mutton Biryani</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/chaumin.png') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/chaumin.png"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Chowmein</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/chickenmomo.webp') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/chickenmomo.webp"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Chicken Momo</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/chesse-pizza.jpg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/chesse-pizza.jpg"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                 -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Cheese Pizza</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/chicken-burger.jpg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/chicken-burger.jpg"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Burger</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="food-img">
                                <figure class="wrap overflow-hidden rounded">
                                    <img class="rounded" src="{{ asset('images/website/porksekuwa.jpeg') }}"
                                        style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food">
                                    <!-- <img class="rounded" src="/Images/porksekuwa.jpeg"
                                    style="width: 100%; height: 275px;object-fit: cover;" alt="rest-food"> -->
                                </figure>
                                <div class="recomm-description">
                                    <a href="#" class="our-header fw-bold" style="text-decoration: none;">
                                        <h4 class="fw-bold text-black">Pork Sekuwa</h4>
                                    </a>
                                </div>
                                <div class="order-food-btn cta-btn">
                                    <a href="#" class="p-1">
                                        Order Now
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <section class="sit-at-home-sec" id="about-us">
        <div class="wrap">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="image">
                        <img src="{{ asset('images/website/sit-photo.png') }}" style="width: 100%; height: 500px;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="sit-home-title p-5 pt-0">
                        <h2 class="text-light mb-4">Sit at Home<br>
                            <span class="texts" style="color: orange;"> We Will Take Care</span>
                        </h2>
                        <p class="fw-semibold text-light pb-3">
                            Good food, delivered right to your doorstep. Fresh, quick, and easy—so you can focus on what
                            matters.
                        </p>
                    </div>
                    <div class="row mx-3">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="sit-home-icons">
                                <div class="img text-center">
                                    <i class="fa-solid fa-clock mx5 mb-2"></i>
                                </div>
                                <div class="sit-icon-txt">
                                    <h6 class="text-light text-center fw-bold"> Fast <br />Delivery</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="sit-home-icons">
                                <div class="img text-center">
                                    <i class="fa-solid fa-bowl-food mx5 mb-2"></i>
                                </div>
                                <div class="sit-icon-txt">
                                    <h6 class="text-light text-center fw-bold">Wide Selection</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="sit-home-icons">
                                <div class="img text-center">
                                    <i class="fa-solid fa-credit-card mx5 mb-2"></i>
                                </div>
                                <div class="sit-icon-txt">
                                    <h6 class="text-light text-center fw-bold">
                                        Easy Payments
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="sit-home-icons">
                                <div class="img text-center">
                                    <i class="fa-solid fa-location-dot mx5 mb-2"></i>
                                </div>
                                <div class="sit-icon-txt">
                                    <h6 class="text-light text-center fw-bold">
                                        Real-Time Tracking
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <section class="testimonial-sec padding-section-y" id="testimonial">
        <div class="testimonial-section text-center container">
            <div class="testimonial-sub text-center">Testimonials</div>
            <h2 class="testimonial-title text-center">
                Why Our Clients Choose Us
            </h2>
            <div class="testimonial active">
                <div class="quote fs-3">❝</div>
                <h5>The food always arrives on time and still warm. It’s become my go-to app for dinner after work.</h5>
                <div class="client-img mb-4"><img src="https://randomuser.me/api/portraits/men/65.jpg" alt="client">
                    <h5 class="fw-bold pt-2">Sajan Shrestha</h5>
                    <h6 class="fw-bold" style="color: orange;">Marketing Manager</h6>
                </div>
            </div>
            <div class="testimonial">
                <div class="quote fs-3">❝</div>
                <h5>So easy to use and the delivery drivers are always polite. Love the variety of restaurants
                    available.</h5>
                <div class="client-img"><img src="https://randomuser.me/api/portraits/women/35.jpg" alt="client">
                    <h5 class="fw-bold pt-2">Anita Gurung</h5>
                    <h6 class="fw-bold" style="color: orange;">Software Engineer</h6>
                </div>
            </div>
            <div class="testimonial">
                <div class="quote fs-3">❝</div>
                <h5>I was surprised how quickly my order arrived. Tracking made it stress-free.</h5>
                <div class="client-img"><img src="https://randomuser.me/api/portraits/men/4.jpg" alt="client">
                    <h5 class="fw-bold pt-2">Bikash Thapa</h5>
                    <h6 class="fw-bold" style="color: orange;">Finance Officer</h6>
                </div>
            </div>
            <div class="dots">
                <span class="dot active" onclick="showSlide(0)"></span>
                <span class="dot" onclick="showSlide(1)"></span>
                <span class="dot" onclick="showSlide(2)"></span>
            </div>
        </div>
    </section>
    <!--  -->
    <section class="hot-pizza-sec padding-section-y">
        <div class="hot-pizzza-back-img container">
            <!-- Owl Carousel wrapping full two-column rows as items -->
            <div class="owl-carousel hp-owl-hero">
                <!-- Item 1 -->
                <div class="item">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="hot-pizza-title">
                                <h2 class="text-light fw-bold">Always<br>
                                    <span class="texts text-black"> the Hottest<br> Pizza</span>
                                </h2>
                                <p class="fw-medium text-black fs-5 pb-4">
                                    Freshly baked, straight from the oven — every pizza is made with hand-tossed dough,
                                    rich
                                    tomato sauce, premium toppings, and gooey cheese. Served piping hot to keep every
                                    bite as
                                    delicious as the first.
                                </p>
                                <div class="get-pizza-btn rounded-pill">
                                    <button type="button" class="btn fw-bold">Get Pizza</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="image pt-4">
                                <img src="{{ asset('images/website/pizza.png') }}" style="width: 100%;" alt="Hot pizza">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 2 (identical; change later as you like) -->
                <div class="item">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="hot-pizza-title">
                                <h2 class="text-light fw-bold">Always<br>
                                    <span class="texts text-black"> the Freshest <br> Momos</span>
                                </h2>
                                <p class="fw-medium text-black fs-5 pb-4">
                                    our momos are filled with juicy vegetables and
                                    tender meats. Paired with spicy dipping sauce, each bite is a burst of authentic
                                    taste straight from the Himalayas.
                                </p>
                                <div class="get-pizza-btn rounded-pill">
                                    <button type="button" class="btn fw-bold">Get Momos</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="image">
                                <img src="https://png.pngtree.com/png-clipart/20250206/original/pngtree-traditional-newari-momos-on-white-background-png-image_20372781.png"
                                    style="width: 100%; height: 440px;" alt="Hot Momos">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Item 3 (identical) -->
                <div class="item">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="hot-pizza-title">
                                <h2 class="text-light fw-bold">Always<br>
                                    <span class="texts text-black"> the Juiciest <br> Burgers</span>
                                </h2>
                                <p class="fw-medium text-black fs-5 pb-4">
                                    our burgers are made with fresh buns, tender patties, crunchy veggies, and secret
                                    sauces. Every bite is bursting with flavor, making it the ultimate comfort food
                                    you’ll crave again and again.
                                </p>
                                <div class="get-pizza-btn rounded-pill">
                                    <button type="button" class="btn fw-bold">Get Burger</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="image pt-4">
                                <img src="https://png.pngtree.com/png-clipart/20240830/original/pngtree-burger-with-floating-ingredient-png-image_15881303.png"
                                    style="width: 100%;" alt="delicious Burger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /owl-carousel -->
        </div>
    </section>
    <!--  -->
    <section class="our-Application-sec padding-section-y">
        <div class="row container mx-auto">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="our-application-title">
                    <h2 class="text-black mb-3"> Get More With <span class="texts" style="color: orange;">
                            our<br> Application
                        </span>
                    </h2>
                    <p class="fw-small text-black fs-6 pb-4">
                        Stay connected and enjoy a seamless shopping experience right at your fingertips. Our app is
                        designed to make your orders faster, safer, and more rewarding.
                    </p>
                </div>
                <div class="d-flex gap-2 mx-4">
                    <div class="number rounded-circle d-flex jutify-content-center">
                        <p class="rounded-circle px-2 py-1 text-light fw-bold"
                            style="background: orange; border: 8px solid white;">01</p>
                    </div>
                    <div class="text">
                        <h5 class="fw-bold pt-2 px-3">Follow Delivery Status</h5>
                    </div>
                </div>
                <div class="d-flex gap-2 mx-4">
                    <div class="number rounded-circle d-flex jutify-content-center">
                        <p class="rounded-circle px-2 py-1 text-light fw-bold"
                            style="background: orange; border: 8px solid white;">02</p>
                    </div>
                    <div class="text">
                        <h5 class="fw-bold pt-2 px-3">Easy Reorders</h5>
                    </div>
                </div>
                <div class="d-flex gap-2 mx-4">
                    <div class="number rounded-circle d-flex jutify-content-center">
                        <p class="rounded-circle px-2 py-1 text-light fw-bold"
                            style="background: orange; border: 8px solid white;">03</p>
                    </div>
                    <div class="text">
                        <h5 class="fw-bold pt-2 px-3">Secure Payments</h5>
                    </div>
                </div>
                <div class="d-flex gap-2 mx-4">
                    <div class="number rounded-circle d-flex jutify-content-center">
                        <p class="rounded-circle px-2 py-1 text-light fw-bold"
                            style="background: orange; border: 8px solid white;">04</p>
                    </div>
                    <div class="text">
                        <h5 class="fw-bold pt-2 px-3">Exclusive Offers
                        </h5>
                    </div>
                </div>
                <div class="d-flex aligm-items-center gap-3 justify-content-center justify-content-md-start">
                    <figure class="mb-0  download_app">
                        <img style="max-width: 142px;"
                            src="{{asset('images/website/App_Store_iOS-Badge-Logo.wine.png')}}"
                            alt="Dowload on Google play store image">
                    </figure>
                    <figure class="mb-0 download_app">
                        <a href="https://play.google.com/store/apps/details?id=com.himalride.user&amp;pcampaignid=web_share" target="_blank">
                            <img style="max-width: 142px;" src="{{asset('images/website/app-2.png')}}"
                                alt="Dowload on App  store image">
                        </a>
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 d-none d-md-block">
                <div class="images">
                    <img src="{{ asset('images/website/app_image.png') }}"
                        style="width: 100%; padding: 60px 0px 0px 0px; height: 700px;object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <footer class="footer-bg">
        <div class="footer-img container">
            <div class="call-section d-none d-lg-block">
                <div class="call-container">
                    <img src="{{ asset('images/website/footer-banner.png') }}" alt="Customer Support">
                    <div class="call-info">
                        <div class="call-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="call-text">
                            <small>Call us to make order now</small>
                            <strong><a class="text-black" href="tel:+977-9705678786">+977-9705678786</a></strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="gomoto-logo text-center">
                <div class="logo">
                    <a href="#" class="text-light mb-4" style="text-decoration: none; margin-inline: auto;">
                        <img
                            src="https://food.matinsoftech.com/storage/logos/b8LQuPn2ZG9XTDwwXLsuQzScsQXxHhc0QHw7fiDD.png" />
                    </a>
                </div>
                <div class="icons d-flex align-item-center justify-content-center gap-5"
                    style="border-bottom: 1px dashed gray;">
                    <i class="fa-brands fa-twitter fs-2" style="color: orange; margin-bottom: 50px;"></i>
                    <i class="fa-brands fa-facebook-f fs-2" style="color: orange; margin-bottom: 50px;"></i>
                    <i class="fa-brands fa-instagram fs-2" style="color: orange; margin-bottom: 50px;"></i>
                    <i class="fa-brands fa-youtube fs-2" style="color: orange; margin-bottom: 50px;"></i>
                </div>
            </div>
            <div class="last-footer text-center pt-4 pb-3">
                <p class="text" style="color: orange; font-size: 14px;">Matin Softech <span class="text-light">2025 All
                        Rights
                        Reserved.</span></p>
            </div>
        </div>
    </footer>
    <!--  -->
    <div class="go_to_top rounded-circle text-center">
        <a href="#" style="text-decoration: none; ">
            <i class="fa-solid fa-rocket" style="color: rgb(17, 17, 16);"></i>
            <p class="text-black fw-bold mb-0" style="font-size: 12px;">Go top</p>
        </a>
    </div>
    <div class="whatsapp-btn go_to_top rounded-circle text-center">
        <a href="https://wa.me/9827346441" style="text-decoration: none; ">
            <i class="fa-brands fa-whatsapp text-white fs-2"></i>
        </a>
    </div>
    <!--  -->
</body>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK"
    crossorigin="anonymous"></script>
<!--  -->
<!--Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"></script>
<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    const hamburger = document.getElementById("hamburger");
    const menu = document.getElementById("menu");
    const hamburgerIcon = document.querySelector("#hamburger i");
    hamburger.addEventListener("click", () => {
        menu.classList.toggle("show");
        if (menu.classList.contains("show")) {
            hamburgerIcon.classList.remove("fa-bars");
            hamburgerIcon.classList.add("fa-x");
        } else {
            hamburgerIcon.classList.remove("fa-x");
            hamburgerIcon.classList.add("fa-bars");
        }
    });
    // testimonials
    let index = 0;
    const testimonials = document.querySelectorAll(".testimonial");
    const dots = document.querySelectorAll(".dot");
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
    setInterval(4000);
    // testimonials
    $('.hp-owl-hero').owlCarousel({
        items: 1,              // one full row per slide
        loop: true,            // infinite
        margin: 0,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3500, // slide interval
        autoplayHoverPause: true,
        smartSpeed: 600
    });
</script>
</html>
