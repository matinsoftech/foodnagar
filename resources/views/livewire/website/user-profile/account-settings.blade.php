@extends('livewire.website.layouts.app')

@section('content')
    <main>
        <!-- section -->
        <section>
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>

                    @include('livewire.website.user-profile.account-sidebar')

                    <div class="col-lg-9 col-md-8 col-12 py-5">
                        <div class="py-6 p-md-0 p-lg-0">
                            <div class="mb-6">
                                <!-- heading -->
                                <h2 class="mb-0">Account Setting</h2>
                            </div>
                            <div>
                                <!-- heading -->
                                <h5 class="mb-4">Account details</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- form -->
                                        <form method="POST" action="{{ route('update_user') }}">
                                            @csrf
                                            <!-- Input for Name -->
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="user_name"
                                                    value="{{ old('user_name', auth()->user()->name ?? "") }}" />
                                                @error('user_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Input for Email -->
                                            <div class="mb-3">
                                                <label class="form-label">Email (<code>{{auth()->user()->email_verified_at ? 'verified' : 'not verified'}}</code>)</label>
                                                <input type="email" class="form-control" name="user_email"
                                                    value="{{ old('user_email', auth()->user()->email ?? "") }}" />
                                                @error('user_email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Input for Phone -->
                                            <div class="mb-5">
                                                <label class="form-label">Phone  (<code>{{auth()->user()->phone_verified_at ? 'verified' : 'not verified'}}</code>)</label>
                                                <input type="text" class="form-control" name="user_phone"
                                                    value="{{ old('user_phone', auth()->user()->phone ?? "") }}" />
                                                @error('user_phone')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Save Details</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <hr class="my-4 my-md-5" />
                            <div class="pe-lg-14">
                                <!-- heading -->
                                <h5 class="mb-4">Password</h5>
                                <form class="row row-cols-1 row-cols-lg-2"  method="POST" action="{{ route('update-password') }}">
                                    @csrf
                                    <!-- input -->
                                    <div class="mb-3 col">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="**********" />
                                        @error('new_password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col">
                                        <label class="form-label">Current Password</label>
                                        <input type="password"  name="current_password" class="form-control" placeholder="**********" />
                                        @error('current_password')
                                             <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- input -->
                                    <div class="col-12">
                                        <p class="mb-4">
                                            Can’t remember your current password?
                                            <a href="{{route('forgot-password')}}">Reset your password.</a>
                                        </p>
                                        <button type="submit" class="btn btn-primary">Save Password</button>
                                    </div>
                                </form>
                            </div>
                            <hr class="my-4 my-md-5" />

                            <div>
                                <!-- heading -->
                                <h5 class="mb-4">Delete Account</h5>
                                <p class="mb-2">Would you like to delete your account?</p>
                                <p class="mb-5">
                                    This account contains 12 orders. Deleting your account will remove all the
                                    order details associated with it.
                                </p>
                                <!-- Form -->
                                <form method="POST" action="{{ route('delete-account') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Your Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required />
                                        @error('password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-outline-danger">I want to delete my account</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
