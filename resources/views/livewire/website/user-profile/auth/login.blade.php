@extends('livewire.website.layouts.app')
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <main>
        <!-- section -->
        <section class="my-lg-14 my-8">
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="{{ asset('css/assets/images/signin-g.svg') }}" alt="" class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Sign in to {{ setting('websiteName', env('APP_NAME')) }}</h1>
                            <p>Welcome back to {{ setting('websiteName', env('APP_NAME')) }}! Enter your email to get
                                started.</p>
                        </div>

                        <form id="loginForm" class="" >
                            @csrf
                            <div class="mb-3">
                                <label for="login" class="form-label">Email / Phone</label>
                                <input 
                                    type="text"  
                                    class="form-control @error('login') is-invalid @enderror" 
                                    id="login" 
                                    name="login" 
                                    placeholder="Enter phone number or email"
                                    value="{{ old('login') }}" 
                                     
                                />
                                @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"  class="form-control" id="password" placeholder="Enter Password"
                                     />
                                @error('password')
                                 <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
        
        
                                <div>
                                    Forgot password?
                                    <a href="{{ url('forgot-password') }}">Reset It</a>
                                </div>
                                {{-- <small class="form-text">
                                    By Signup, you agree to our
                                    <a href="#!">Terms of Service</a>
                                    &
                                    <a href="#!">Privacy Policy</a>
                                </small> --}}
                            </div>
        
                            <button type="submit" class="btn btn-primary loginbtn" type="submit">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
@endsection
