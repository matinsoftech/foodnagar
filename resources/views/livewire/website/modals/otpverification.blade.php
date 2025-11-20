<!-- Modal -->
<div class="modal fade" id="otpverificationmodal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">OTP Verification</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Otp_verification" method="post" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" >

                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP you have received</label>
                        <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
                        <div class="invalid-feedback">Please enter the OTP.</div>
                    </div>

                    <div id="message" class="form-text text-danger"></div>

                    <button type="submit" class="btn btn-primary w-100">Verify</button>
                </form>

            </div>

        </div>
    </div>
</div>
