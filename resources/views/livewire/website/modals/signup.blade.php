<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="signupModalLabel">Sign Up</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer border-0 justify-content-center">
                Already have an account?
                <a href="#" data-bs-toggle="modal" data-bs-target="#userModal">Sign in</a>
            </div>
        </div>
    </div>
</div>
