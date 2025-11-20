<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign In</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer border-0 justify-content-center">
                Dont have an account?
                <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
            </div>
        </div>
    </div>
</div>
