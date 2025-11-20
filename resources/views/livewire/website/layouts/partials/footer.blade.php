<!-- footer -->
<footer class="footer footer-bg  pt-2 pt-md-12 pb-0">
    <div class="container">
        <div class="row g-4 py-4">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <div class="d-flex align-items-center justify-content-center">

                        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
                            <img src="{{ appLogo() }}" style="height: 7rem;"
                                alt="" />
                        </a>
                        <div class="d-flex justify-content-between w-100 d-lg-none">
                            <a class="navbar-brand" href="{{ url('/') }}" style="">
                                <img src="{{ appLogo() }}" style="height: 7rem;"
                                    alt="" />
                            </a>
                        </div>
                    </div>
                    <p class="mt-4 text-white">Get the latest updates and offers from Altic</p>
                    <div class="row mt-4 mt-md-0  text-center">
                        <div class="container col-6">
                            <a href="#!"><img src="{{ asset('css/assets/images/appbutton/appstore-btn.svg') }}"
                                alt="" style="width: 140px" /></a>
                        </div>
                        <div class="container col-6 ">
                            <a href="#!"><img src="{{ asset('css/assets/images/appbutton/googleplay-btn.svg') }}"
                                alt="" style="width: 140px" /></a>
                        </div>
                    </div>
                    <div class="col text-lg-start text-center mb-2 mb-lg-0">
                        <div class="mb-0 d-flex justify-between container p-2 align-middle">
                            <div class=" col m-auto">
                                <a href="#!"><img style="width:50px"
                                        src="{{ asset('css/assets/images/payment/esewa.png') }}" alt="" /></a>
                            </div>
                            <div class=" col  m-auto ">
                                <a href="#!"><img style="width:50px"
                                        src="{{ asset('css/assets/images/payment/fonepay-logo-C9B7151FD6-seeklogo.com.png') }}"
                                        alt="" /></a>
                            </div>
                            <div class="col  m-auto">
                                <a href="#!"><img style="width:50px"
                                        src="{{ asset('css/assets/images/payment/Mastercard-Logo-2016-2020.png') }}"
                                        alt="" /></a>
                            </div>
                            <div class="col  m-auto">
                                <a href="#!"><img style="width:50px"
                                        src="{{ asset('css/assets/images/payment/logo1.png') }}" alt="" /></a>
                            </div>
                            <div class="col  m-auto">
                                <a href="#!"><img style="width:50px"
                                        src="{{ asset('css/assets/images/payment/visa.svg') }}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="row g-4">
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4 fs-16 text-white">Get to know us</h6>
                        <!-- list -->
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="{{ url('about') }}" class="nav-link text-white">About</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('contact') }}" class="nav-link text-white">Contact</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('blog-list') }}" class="nav-link text-white">Blog</a></li>
                            {{-- <li class="nav-item mb-2"><a href="#!" class="nav-link">Help Center</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Our Value</a></li> --}}
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4 fs-16 text-white">Policies</h6>
                        <ul class="nav flex-column">
                            <!-- list -->
                            <li class="nav-item mb-2"><a href="{{ url('privacy/policy') }}" class="nav-link text-white">Privacy Policy</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('pages/terms') }}" class="nav-link text-white">Terms & Condition</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('pages/refund/terms') }}" class="nav-link text-white">Refund Policy</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('pages/cancel/terms') }}" class="nav-link text-white">Cancellation Policy</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('pages/shipping/terms') }}" class="nav-link text-white">Delivery/Shipping Policy</a></li>
                            <li class="nav-item mb-2"><a href="{{ url('pages/payment/terms') }}" class="nav-link text-white">Payment Terms</a></li>
                        </ul>
                    </div>
                    @if($check_module_type == 'multi')
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4 fs-16 text-white">Modules</h6>
                        <ul class="nav flex-column">
                            @foreach ($vendortypes as $vendortype)
                                <li class="nav-item mb-2">
                                    <a href="{{ $vendortype->base_url }}" class="nav-link text-white">
                                        {{ $vendortype->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4 fs-16 text-white">More</h6>
                        <ul class="nav flex-column">
                            <!-- list -->
                            <li class="nav-item mb-2"><a href="#!" class="nav-link text-white">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link text-white">Altic Programs</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link text-white">Promos & Coupons</a></li>
                            {{-- <li class="nav-item mb-2"><a href="#!" class="nav-link">Altic Ads</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Careers</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-top py-4">
        <div class="align-items-center">
            <div class="col text-center">
                <span class="small text-white">
                    © 2022
                    <span id="copyright">
                        -
                        <script>
                            document.getElementById("copyright").appendChild(document.createTextNode(new Date().getFullYear()));
                        </script>
                    </span>
                    Altic. All rights reserved. Developed by
                    <a href="https://matinsoftech.com" style="color:#fff">Matinsoftech</a>
                    .
                </span>
            </div>
        </div>
    </div>
</footer>
