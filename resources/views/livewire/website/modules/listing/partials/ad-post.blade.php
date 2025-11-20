@extends('livewire.website.layouts.app')



@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
@endsection



@section('content')
    <main>
        {{-- banner section start --}}
        <section class="single-banner dashboard-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>ad post</h2>
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ad-post</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- banner section end --}}


        <section class="adpost-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <form class="adpost-form">
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Ad Information</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Product Title</label>
                                            <input type="text" class="form-control"
                                                placeholder="Type your product title here">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">product image</label>
                                            <input type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-control custom-select">
                                                <option selected>Select Category</option>
                                                <option value="1">property</option>
                                                <option value="2">electronics</option>
                                                <option value="3">automobiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter your pricing amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">price condition</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="fix-check">
                                                    <label for="fix-check" class="form-check-text">fixed</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="nego-check">
                                                    <label for="nego-check" class="form-check-text">negotiable</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="day-check">
                                                    <label for="day-check" class="form-check-text">daily</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="week-check">
                                                    <label for="week-check" class="form-check-text">weekly</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="month-check">
                                                    <label for="month-check" class="form-check-text">monthly</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="year-check">
                                                    <label for="year-check" class="form-check-text">yearly</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">ad category</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="sale-check">
                                                    <label for="sale-check" class="flat-badge sale">sale</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="rent-check">
                                                    <label for="rent-check" class="flat-badge rent">rent</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="book-check">
                                                    <label for="book-check" class="flat-badge booking">booking</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">product condition</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="use-check">
                                                    <label for="use-check" class="form-check-text">used</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" class="form-check" id="new-check">
                                                    <label for="new-check" class="form-check-text">new</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">ad description</label>
                                            <textarea class="form-control" placeholder="Describe your message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">ad tag</label>
                                            <textarea class="form-control" placeholder="Maximum of 15 keywords"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Author Information</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Number</label>
                                            <input type="number" class="form-control" placeholder="Your Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" placeholder="Your Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>Plan Information</h3>
                                </div>
                                <ul class="adpost-plan-list">
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Free Plan - <span>Submit 5 Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque
                                                corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$00.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Standerd Plan - <span>Submit 10 Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque
                                                corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$23.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="adpost-plan-content">
                                            <h6>Premium Plan - <span>Unlimited Ad Listings</span></h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Delectus minus Eaque
                                                corporis accusantium incidunt officiis deleniti.</p>
                                        </div>
                                        <div class="adpost-plan-meta">
                                            <h3>$43.00</h3>
                                            <button class="btn btn-outline">
                                                <span>Select</span>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="adpost-card pb-2">
                                <div class="adpost-agree">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-check">
                                    </div>
                                    <p>Send me Trade Email/SMS Alerts for people looking to buy mobile handsets in www By
                                        clicking "Post", you agree to our <a href="#">Terms of Use</a> and <a
                                            href="#">Privacy Policy</a> and acknowledge that you are the rightful
                                        owner of this item and using Trade to find a genuine buyer.</p>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>published your ad</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Safety Tips</h3>
                                <button data-dismiss="alert">close</button>
                            </div>
                            <ul class="account-card-text">
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis
                                        placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis
                                        placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis
                                        placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis
                                        placeat at aperiam.</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis
                                        placeat at aperiam.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>Custom Offer</h3>
                                <button data-dismiss="alert">close</button>
                            </div>
                            <form class="account-card-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>send Message</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ADPOST PART END-->


        <!--FOOTER PART PART-->
        {{-- <footer class="footer-part">
            <div class="container">
                <div class="row newsletter">
                    <div class="col-lg-6">
                        <div class="news-content">
                            <h2>Subscribe for Latest Offers</h2>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laboriosam, aliquid reiciendis!
                                Exercitationem soluta provident non.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form class="news-form">
                            <input type="text" placeholder="Enter Your Email Address">
                            <button class="btn btn-inline">
                                <i class="fas fa-envelope"></i>
                                <span>Subscribe</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Contact Us</h3>
                            <ul class="footer-address">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>1420 West Jalkuri Fatullah, <span>Narayanganj, BD</span></p>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <p>support@classicads.com <span>info@classicads.com</span></p>
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <p>+8801838288389 <span>+8801941101915</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Quick Links</h3>
                            <ul class="footer-widget">
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Orders Tracking</a></li>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">Faq</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-content">
                            <h3>Information</h3>
                            <ul class="footer-widget">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Delivery System</a></li>
                                <li><a href="#">Secure Payment</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="footer-info">
                            <a href="#"><img src="images/logo.png" alt="logo"></a>
                            <ul class="footer-count">
                                <li>
                                    <h5>929,238</h5>
                                    <p>Registered Users</p>
                                </li>
                                <li>
                                    <h5>242,789</h5>
                                    <p>Community Ads</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-card-content">
                            <div class="footer-payment">
                                <a href="#"><img src="images/pay-card/01.jpg" alt="01"></a>
                                <a href="#"><img src="images/pay-card/02.jpg" alt="02"></a>
                                <a href="#"><img src="images/pay-card/03.jpg" alt="03"></a>
                                <a href="#"><img src="images/pay-card/04.jpg" alt="04"></a>
                            </div>
                            <div class="footer-option">
                                <button type="button" data-toggle="modal" data-target="#language"><i
                                        class="fas fa-globe"></i>English</button>
                                <button type="button" data-toggle="modal" data-target="#currency"><i
                                        class="fas fa-dollar-sign"></i>USD</button>
                            </div>
                            <div class="footer-app">
                                <a href="#"><img src="images/play-store.png" alt="play-store"></a>
                                <a href="#"><img src="images/app-store.png" alt="app-store"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-end">
                <div class="container">
                    <div class="footer-end-content">
                        <p>All Copyrights Reserved &copy; 2021 - Developed by <a href="#">Mironcoder</a></p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer> --}}
        <!-- 
                        FOOTER PART END
         -->


        <!-- 
                      CURRENCY MODAL PART START
             -->
        <div class="modal fade" id="currency">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Choose a Currency</h4>
                        <button class="fas fa-times" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <button class="modal-link active">United States Doller (USD) - $</button>
                        <button class="modal-link">Euro (EUR) - €</button>
                        <button class="modal-link">British Pound (GBP) - £</button>
                        <button class="modal-link">Australian Dollar (AUD) - A$</button>
                        <button class="modal-link">Canadian Dollar (CAD) - C$</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 
                      CURRENCY MODAL PART END
           -->


        <!-- 
                      LANGUAGE MODAL PART END
            -->
        <div class="modal fade" id="language">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Choose a Language</h4>
                        <button class="fas fa-times" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <button class="modal-link active">English</button>
                        <button class="modal-link">bangali</button>
                        <button class="modal-link">arabic</button>
                        <button class="modal-link">germany</button>
                        <button class="modal-link">spanish</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
