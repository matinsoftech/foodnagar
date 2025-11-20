@extends('livewire.website.layouts.app')
@section('css')
<style>
    .hidden {
        display: none;
    }
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
                        <img src="{{ asset('css/assets/images/svg-graphics/fp-g.svg') }}" alt="" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                        <div>
                            <div class="mb-lg-9 mb-5">
                                <!-- heading -->
                                <h1 class="mb-2 h2 fw-bold">Forgot your password?</h1>
                                <p>Please enter the @if(setting('verification_type') == 'phone') phone number @else email @endif associated with your account and We will email you a link
                                    to reset your password.</p>
                            </div>
                            <!-- form -->
                            <div id="sendOtpForm" class="needs-validation" novalidate>
                                <!-- row -->
                                <div class="row g-3">
                                    <!-- col -->
                                    <div class="col-12">
                                        <!-- input -->
                                        @if(setting('verification_type') == 'phone')
                                            <label for="formForgetPhone" class="form-label visually-hidden">Enter Your Phone Number</label>
                                            <input type="tel" class="form-control" id="formForgetPhone" placeholder="Enter Your Phone Number" required />
                                            <div class="invalid-feedback">Please enter correct phone.</div>
                                        @else
                                            <label for="formForgetEmail" class="form-label visually-hidden">Enter Your Email</label>
                                            <input type="email" class="form-control" id="formForgetEmail" placeholder="Email"
                                            required />
                                            <div class="invalid-feedback">Please enter correct email.</div>
                                        @endif
                                    </div>

                                    <!-- btn -->
                                    <div class="col-12 d-grid gap-2">
                                        <button id="resetPasswordBtn" type="submit" class="btn btn-primary">Reset Password</button>
                                        <a href="signup.html" class="btn btn-light">Back</a>
                                    </div>
                                </div>
                            </div>
                            <div id="verifyOtpForm" class="needs-validation hidden">
                                <div class="col-12">
                                    <label for="otp">Enter Otp</label>
                                    <input class="form-control" type="text" name="otp" id="otp" />
                                </div>
                                <div class="col-12 d-grid gap-2">
                                    <button id="verifyOtp" type="submit" class="btn btn-primary">Verify Otp</button>
                                </div>

                            </div>
                            <div id="resetPasswordForm" class="needs-validation hidden">
                                <div class="col-12">
                                    <label for="password">Enter New Password</label>
                                    <input class="form-control" type="password" name="password" id="password" />
                                </div>
                                <div class="col-12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
                                </div>
                                <div class="col-12 d-grid gap-2">
                                    <input type="text" name="token" id="token" hidden />
                                    <button id="resetPassword" type="submit" class="btn btn-primary">Reset Password</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
<script>
    $(document).on('click','#resetPasswordBtn',function(e){
        e.preventDefault();
        var email = $('#formForgetEmail').val();
        var phone = $('#formForgetPhone').val();

        $.ajax({
            'url': "{{ route('forgot-password.sent-otp') }}",
            'type': "POST",
            'data': {
                'email': email,
                'phone': phone,
                '_token': "{{ csrf_token() }}"
            },
            'success': function(response) {
                if (response.success == true) {
                    $('#verifyOtpForm').removeClass('hidden');
                    $('#sendOtpForm').addClass('hidden');
                }
            },
            'error': function(response) {
                console.log(response);
            }
        });
    });

    $(document).on('click','#verifyOtp',function(e){
        e.preventDefault();
        var otp = $('#otp').val();

        $.ajax({
            'url': "{{ route('forgot-password.verify-otp') }}",
            'type': "POST",
            'data': {
                'otp': otp,
                'phone' : $('#formForgetPhone').val(),
                '_token': "{{ csrf_token() }}"
            },
            'success': function(response) {
                if (response.success == true) {
                    $('#resetPasswordForm').removeClass('hidden');
                    $('#verifyOtpForm').addClass('hidden');
                    $('#token').val(response.token);
                }else{

                    $('#resetPasswordForm').html('<h1>Invalid Otp.</h1>');
                    $('#resetPasswordForm').removeClass('hidden');
                }
            },
            'error': function(response) {
                console.log(response);
            }
        });
    });

    $(document).on('click','#resetPassword',function(e){
        e.preventDefault();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        let token = $('#token').val();

        $.ajax({
            'url': "{{ route('forgot-password.reset-password') }}",
            'type': "POST",
            'data': {
                'phone' : $('#formForgetPhone').val(),
                'token': token,
                'password': password,
                'password_confirmation': password_confirmation,
                '_token': "{{ csrf_token() }}"
            },
            'success': function(response) {
                if (response.success == true) {
                    $('#resetPasswordForm').html('<h1>Password Reset Successfully.</h1>');
                }else{
                    $('#resetPasswordForm').html('<h1>Invalid data sent.</h1>');
                }
            },
            'error': function(response) {
                console.log(response);
            }
        });
    });

</script>
@endsection
