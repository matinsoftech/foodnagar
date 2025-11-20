@extends('livewire.website.layouts.app')

@section('content')
    <style>
        .owl-carousel {
            display: block !important;
        }
    </style>
    <section class="mt-8">
        <div class="container">
            <div class="hero-slider">
                <div
                    style="url('{{ asset('css/assets/images/category/slide-1.jpg') }}') no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
                    <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                        <span class="badge text-bg-warning">Opening Sale Discount 50%</span>

                        <h2 class="text-dark display-5 fw-bold mt-4">SuperMarket For Fresh Grocery</h2>
                        <p class="lead">Introduced a new model for online grocery shopping and convenient home
                            delivery.</p>
                        <a href="#!" class="btn btn-dark mt-3">
                            Shop Now
                            <i class="feather-icon icon-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div
                    style="background: url('{{ asset('css/assets/images/slider/slider-2.jpg') }}') no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
                    <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                        <span class="badge text-bg-warning">Free Shipping - orders over $100</span>
                        <h2 class="text-dark display-5 fw-bold mt-4">
                            Free Shipping on
                            <br />
                            orders over
                            <span class="text-primary">$100</span>
                        </h2>
                        <p class="lead">Free Shipping to First-Time Customers Only, After promotions and discounts are
                            applied.</p>
                        <a href="#!" class="btn btn-dark mt-3">
                            Shop Now
                            <i class="feather-icon icon-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="image-container">
                    <img src="{{ asset('css/assets/images/delivery.png') }}" alt="Shopping Image">
                    <div class="discount-badge">50% Off</div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-start">
                <div class="explore-section">
                    <h1>Explore Categories</h1>
                </div>
                <!-- Category Section Start-->
                <section class="mb-lg-10 mt-lg-14 " style="position: relative;left: -191px;top: -66px;">
                    <div class="container">

                        <div class="category-slider">
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-dairy-bread-eggs.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3 img-fluid" />
                                            <div class="text-truncate">Dairy, Bread & Eggs</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-snack-munchies.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Snack & Munchies</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-bakery-biscuits.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Bakery & Biscuits</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-instant-food.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Instant Food</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-tea-coffee-drinks.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Tea, Coffee & Drinks</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-atta-rice-dal.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Atta, Rice & Dal</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-baby-care.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Baby Care</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-chicken-meat-fish.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Chicken, Meat & Fish</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-cleaning-essentials.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Cleaning Essentials</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="pages/shop-grid.html" class="text-decoration-none text-inherit">
                                    <div class="card card-product mb-lg-4">
                                        <div class="card-body text-center py-8">
                                            <img src="{{ asset('css/assets/images/category/category-pet-care.jpg') }}"
                                                alt="Grocery Ecommerce Template" class="mb-3" />
                                            <div class="text-truncate">Pet Care</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Category Section End-->
                
                
            </div>
            <!-- Testimonial Section start-->
            <section class="relative py-20 bg-white overflow-hidden">
                <!-- Floating Images for Background Effect -->
                <div class="absolute top-10 left-10 h-16 w-16 rounded-full overflow-hidden">
                    <img src="assets/img/testimonials/avatar-1.jpg" alt="floating image" class="object-cover w-full h-full blur-sm">
                </div>
                <div class="absolute top-1/4 right-20 h-16 w-16 rounded-full overflow-hidden">
                    <img src="assets/img/testimonials/avatar-2.jpg" alt="floating image" class="object-cover w-full h-full blur-sm">
                </div>
                <div class="absolute bottom-10 left-40 h-20 w-20 rounded-full overflow-hidden">
                    <img src="assets/img/testimonials/avatar-3.jpg" alt="floating image" class="object-cover w-full h-full blur-sm">
                </div>
                <div class="absolute bottom-20 right-10 h-20 w-20 rounded-full overflow-hidden">
                    <img src="assets/img/testimonials/avatar-4.jpg" alt="floating image" class="object-cover w-full h-full blur-sm">
                </div>
            
                <!-- Main Container -->
                <div class="container mx-auto flex flex-col items-center lg:flex-row lg:justify-between">
                    <!-- Text: Vertical Testimonials Heading -->
                    <div class="lg:w-1/6 text-center lg:text-left">
                        <h4 class="text-2xl font-semibold text-gray-200 transform -rotate-90 origin-top-left lg:origin-center">Testimonials</h4>
                    </div>
                    
                    <!-- Testimonial Content -->
                    <div class="lg:w-4/6 bg-white p-10 rounded-3xl shadow-lg flex flex-col lg:flex-row items-center">
                        <!-- Profile Image -->
                        <div class="w-40 h-40 rounded-3xl overflow-hidden mr-6">
                            <img src="assets/img/testimonials/main-avatar.jpg" alt="Isabella Oliver" class="object-cover w-full h-full">
                        </div>
            
                        <!-- Testimonial Text -->
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-gray-800">Isabella Oliver</h4>
                            <p class="text-sm text-gray-500">(Manager)</p>
                            <p class="mt-4 text-gray-600">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto at sint eligendi possimus perspiciatis asperiores reiciendis hic amet alias aut, quaerat maiores blanditiis."</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Testimonial Section end-->
          <!-- Blog Section start-->
<section class="section-blog overflow-hidden pb-5 pt-5">
    <div class="container">
        <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <!-- Blog Card 1 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/7.jpg" class="card-img-top" alt="blog-7">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">June 30, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">Marketing Guide: 5 Steps to Success.</a></h5>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Card 2 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/8.jpg" class="card-img-top" alt="blog-8">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">June 30, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">Marketing Guide: 5 Steps to Success.</a></h5>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Card 3 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/9.jpg" class="card-img-top" alt="blog-9">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">June 30, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">Marketing Guide: 5 Steps to Success.</a></h5>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Card 4 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/10.jpg" class="card-img-top" alt="blog-10">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">July 5, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">10 Tips for Social Media Success.</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add additional carousel items here with similar structure -->
                <div class="carousel-item">
                    <div class="row">
                        <!-- Blog Card 5 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/11.jpg" class="card-img-top" alt="blog-11">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">July 10, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">How to Grow Your Online Presence.</a></h5>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Card 6 -->
                        <div class="col-md-3">
                            <div class="card rounded-3 overflow-hidden" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <img src="https://maraviyainfotech.com/projects/blueberry-tailwind/assets/img/blog/12.jpg" class="card-img-top" alt="blog-12">
                                <div class="card-body bg-light">
                                    <span class="text-muted small">July 15, 2024 - organic</span>
                                    <h5 class="card-title"><a href="blog-detail-left-sidebar.html" class="text-dark">The Ultimate SEO Guide for 2024.</a></h5>
                                </div>
                            </div>
                        </div>
                        <!-- Add more blog cards here if needed -->
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<!-- Blog Section end-->


        </div>
    </div>
@endsection
