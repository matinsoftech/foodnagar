@extends('livewire.website.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/service.css') }}">
@endsection



@section('content')
    <style>
        .responsive-height {
            height: 300px;
            /* Default height for smaller screens */
        }

        @media (min-width: 576px) {
            .responsive-height {
                height: 400px;
                /* Height for small screens and above */
            }
        }

        @media (min-width: 768px) {
            .responsive-height {
                height: 500px;
                /* Height for medium screens and above */
            }
        }

        @media (min-width: 992px) {
            .responsive-height {
                height: 600px;
                /* Height for large screens and above */
            }
        }

        @media (min-width: 1200px) {
            .responsive-height {
                height: 700px;
                /* Height for extra large screens and above */
            }
        }

        @media (min-width: 768px) {
            .image-container {
                display: block;
                /* Display the container on medium screens and larger */
                text-align: center;
            }
        }

        .image-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <!-- hero-section -->
    <section class="hero-section">

        <div class="container m-auto">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 align-middle m-auto ">
                    <div class="container-fluid align-content-center">
                        <h1 style="color:#652d89">Express
                            Home Delivery

                        </h1>
                        <p class="text-white">
                            Curabitur imperdiet varius lacus, id placerat purus vulputate non. Fusce in felis vel arcu
                            maximus placerat eu ut arcu. Ut nunc ex, gravida vel porttitor et, pretium ac sapien.
                        </p>
                        <div class="btn col-4 py-5 serv-Read-btn"
                            style="width:200px; border:1px solid #652d89; border-radius:30px"> Read more</div>
                    </div>
                </div>
                <div class="col-12 mt-2 mt-md-0 mt-lg-0 col-md-6 col-lg-6 align-middle">
                    <div class="image-container w-100 ">
                        <img src="{{ asset('css/assets/images/services/slider-courier-mask.png') }}" alt=""
                            class="w-100 h-90" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- herosection-end -->
    <!-- Sit home section-->
    <section class="sit-at-Home">
        <div class="container sit-at-Home">
            <div class="row">
                <div class="col-12  col-md-6 col-6 align-content-center">
                    <img src="{{ asset('css/assets/images/services/sit-photo.jpg') }}" alt ="" class="h-90 w-100">
                </div>

                <div class="col-12 col-md-6 col-6 align-content-center">
                    <h1 class="text-left text-white">Sit at Home</h1>
                    <h1 class="text-leftss" style="color: #652d89"> We Will Take Care</h1>
                    <p class="text-left text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia a ex
                        rerum iste, quia inventore! Quibusdam alias harum ipsum. Ab laborum amet architecto assumenda
                        eveniet.</p>
                    <div class="image-container d-flex justify-between  ">
                        <div class="container  text-center  align-content-center p-2 p-md-5 p-lg-5">
                            <i class="fa-solid fa-truck-fast fa-2xl mb-7" style="color: #652d89"></i>
                            <div class="card-body">
                                <h6 class="text-white">
                                    Fast Delivery
                                    in 1 Hour
                                </h6>
                            </div>

                        </div>
                        <div class="container  text-center align-content-center p-2 p-md-5 p-lg-5">
                            <i class="fa-brands fa-app-store fa-2xl mb-7" style="color: #652d89"></i>
                            <div class="card-body">
                                <h6 class="text-white">
                                    Amazing
                                    Mobile App
                                </h6>
                            </div>

                        </div>
                        <div class="container  text-center align-content-center p-2 p-md-5 p-lg-5">
                            <i class="fa-solid fa-location-dot fa-2xl mb-7" style="color: #652d89"></i>
                            <div class="card-body">
                                <h6 class="text-white">
                                    Wide
                                    Coverage Map
                                </h6>
                            </div>

                        </div>
                        <div class="container  text-center align-content-center p-2 p-md-5 p-lg-5">
                            <i class="fa-solid fa-money-bill-trend-up fa-2xl mb-7" style="color: #652d89"></i>
                            <div class="card-body">
                                <h6 class="text-white">
                                    More Than
                                    150 Couriers
                                </h6>
                            </div>

                        </div>

                    </div>

                </div>


            </div>
        </div>
        </div>
    </section>
    <!-- Sit home section-- >
                    <!--Get mobile app -->

    <section class="Get-Mobile-app">
        <div class="container m-auto h-100">
            <div class="row h-100">

                <div class="col-12 col-md-6 col-lg-6 m-auto">
                    <div class="container-fluid h-100">
                        <h1>Get More With <span style="color:#652d89">Our Application
                            </span>
                        </h1>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora nihil minima quasi eos
                            officiis ratione?
                        </p>
                        <ul class="list-unstyled d-flex flex-column gap-4">
                            <li class="d-flex gap-4 align-middle align-content-center">
                                <div class="  rounded-circle align-content-center text-center text-white"
                                    style="background-color:#652d89; width:50px; height:50px; border:8px solid white">01
                                </div>
                                <h4 class="align-content-center">


                                    Follow Delivery Status
                                </h4>
                            </li>
                            <li class="d-flex gap-4 align-middle align-content-center">
                                <div class="  rounded-circle align-content-center text-center text-white"
                                    style="background-color:#652d89; width:50px; height:50px; border:8px solid white">01
                                </div>
                                <h4 class="align-content-center">


                                    Follow Delivery Status
                                </h4>
                            </li>
                            <li class="d-flex gap-4 align-middle align-content-center">
                                <div class="  rounded-circle align-content-center text-center text-white"
                                    style="background-color:#652d89; width:50px; height:50px; border:8px solid white">01
                                </div>
                                <h4 class="align-content-center">


                                    Follow Delivery Status
                                </h4>
                            </li>
                        </ul>
                        <div class="d-flex my-4 my-md-0  text-left">
                            <div class="container col-6 col-md-4 ">
                                <a href="#!"><img src="{{ asset('css/assets/images/appbutton/appstore-btn.svg') }}"
                                        alt="" style="width: 140px" /></a>
                            </div>
                            <div class="container ">
                                <a href="#!"><img src="{{ asset('css/assets/images/appbutton/googleplay-btn.svg') }}"
                                        alt="" style="width: 140px" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-12 col-md-6 col-lg-6 h-100  m-auto Mobile-side align-middle">
                    <div class="image-container  h-100">
                        <img src="{{ asset('css/assets/images/services/Mobile.png') }}" alt=""
                            class="w-100 responsive-height " style="object-fit: cover; object-position:top" />
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Get mobile app  end-->
@endsection
