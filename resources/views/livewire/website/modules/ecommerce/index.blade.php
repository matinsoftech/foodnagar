@extends('livewire.website.layouts.app')

@section('content')
    @include('livewire.website.modals.popup')

    <main>
        <section class="mt-8">
            <div class="container">
                <!-- Hero Slider Owl Carousel -->
                <!-- Hero Slider Owl Carousel -->
                <div class="hero-main-banner owl-carousel owl-theme">
                    @foreach ($banners as $banner)
                        <div class="item">
                            <img src="{{ $banner->getFirstMediaUrl('default') }}" alt="" style="height: 65vh;">
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Category Section Start-->
        <section class="mb-lg-10 mt-lg-14 my-8">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-6">
                        <h3 class="mb-0">Featured Categories</h3>
                    </div>
                </div>
                <!-- Category Slider Owl Carousel -->
                <div class="ecom-category-slider owl-carousel owl-theme">
                    @foreach ($categories as $category)
                        <div class="item">
                            <a href="{{ url()->current() }}/category/{{ $category->id }}/products"
                                class="text-decoration-none text-inherit">
                                <div class="card card-product mb-lg-4 align-items-center">
                                    <div class="card-body text-center py-8 ecom-category w-100">
                                        <img src="{{ $category->getFirstMediaUrl('default') }}"
                                            alt="Grocery Ecommerce Template" class="mb-3 img-fluid" />
                                        <div class="text-truncate text-wrap-auto">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Category Section End-->

        @php $vendor_name = $vendorType->name; @endphp


        <!-- Feature Products Start-->
        @include('livewire.website.modules.ecommerce.section.few_products')
        <!-- Feature Products End-->

        <!-- Flash Sale Products Start-->
        @include('livewire.website.modules.ecommerce.section.flash_sale')
        <!--Flash Sale  Products End-->


        <!-- Latest Products Start-->
        @include('livewire.website.modules.ecommerce.section.latest-product')
        <!-- Latest Products End-->

        <!-- Category wise Products Start-->
        @include('livewire.website.modules.ecommerce.section.category-wise-product')
        <!-- Category wise Products End-->

        @if($vendorType->show_store_on_homepage == 1)
            <!-- Shop list -->
            @include('livewire.website.modules.ecommerce.section.shop-list-slider')
            <!-- Shop list Ends -->
        @endif

        <!-- Blog Section start-->
        @include('livewire.website.section.blogs')
        <!-- Blog Section end-->


        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="mb-8 mb-xl-0">
                            <div class="mb-6"><img src="{{ asset('css/assets/images/icons/clock.svg') }}"
                                    alt="" /></div>
                            <h3 class="h5 mb-3">Quick Service Booking</h3>
                            <p>Get your order delivered to your doorstep at the earliest from FreshCart pickup stores near
                                you.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="mb-8 mb-xl-0">
                            <div class="mb-6"><img src="{{ asset('css/assets/images/icons/gift.svg') }}" alt="" />
                            </div>
                            <h3 class="h5 mb-3">Best Prices & Offers</h3>
                            <p>Choose from 1000+ services, including home repairs, cleaning, beauty, health, event
                                management, and more. Find everything you need in one platform.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="mb-8 mb-xl-0">
                            <div class="mb-6"><img src="{{ asset('css/assets/images/icons/refresh-cw.svg') }}"
                                alt="" /></div>
                                <h3 class="h5 mb-3">Wide Range of Services</h3>
                                <p>
                                    Choose from 1000+ services, including home repairs, cleaning, beauty, health, event
                                    management, and more. Find everything you need in one platform.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="mb-8 mb-xl-0">
                                <div class="mb-6"><img src="{{ asset('css/assets/images/icons/package.svg') }}"
                                        alt="" /></div>
                                <h3 class="h5 mb-3">Easy Cancellations & Refunds</h3>
                                <p>Not satisfied with the service? Cancel or request a refund quickly. Enjoy a
                                    no-questions-asked refund policy for your peace of mind.
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </main>
@endsection
