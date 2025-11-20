@extends('livewire.website.layouts.app')
@section('css')
    <style>
    </style>
@endsection

@section('content')
    <main>
        <!-- section -->

        <section class="my-lg-14 my-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="{{ asset('css/assets/images/signup-g.svg') }}" alt="" class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Get Start Shopping</h1>
                            <p>Welcome to {{ setting('websiteName', env('APP_NAME')) }}! Enter your email to get started.</p>
                        </div>
                        <!-- form -->
                        <form  id="registerForm" class=""  >
                            @csrf
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="fullName" placeholder="Enter Your Name" value="{{ old('name') }}"  />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register_email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="register_email" placeholder="Enter Email address" value="{{ old('email') }}"  />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter Phone no." value="{{ old('phone') }}"  />
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="register_password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="register_password" placeholder="Enter Password"  />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="referral_code" class="form-label">Referral Code</label>
                                <input type="text" class="form-control @error('referral_code') is-invalid @enderror" name="referral_code" id="referral_code" placeholder="Referral Code (optional)" value="{{ old('referral_code') }}" />
                                @error('referral_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text">
                                    By Signup, you agree to our
                                    <a href="#!">Terms of Service</a>
                                    &
                                    <a href="#!">Privacy Policy</a>.
                                </small>
                            </div>
        
                            <button type="submit" class="btn btn-primary registerbtn" type="submit">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script></script>
@endsection
