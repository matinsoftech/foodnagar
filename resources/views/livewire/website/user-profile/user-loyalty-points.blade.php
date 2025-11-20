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
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                            aria-controls="offcanvasAccount">
                            <i class="bi bi-text-indent-left fs-3"></i>
                        </button>
                    </div>
                </div>

                @include('livewire.website.user-profile.account-sidebar')


                <div class="col-lg-9 col-md-8 col-12 py-5">
                    <div class="grid gap-6 mt-8 "
                        style="color: black; grid-template-columns: repeat(4,1fr); display: grid;">
                        <div class="p-5 bg-primary-500 text-white border-primary-500 border rounded shadow-lg"
                            style="color: black;">
                            <button class="btn border border-start-0 rounded" type="button"
                                style="background-color: #662F88; color: white" id="modal-btn">

                                Withdraw +
                            </button>
                            <div style="color: black;">Withdraw your Loyalty Points to your Wallet</div>
                        </div>

                        <div class="flex items-center p-5 bg-primary-100 border rounded shadow-lg">
                            <div class="w-full">
                                <p class="text-sm fw-bold">
                                    Loyalty Points
                                </p>
                                <p class="text-2xl font-semibold">{{ $loyaltyPoints }} Points</p>
                            </div>
                            <svg style="width: 4rem" class="w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                fill="currentColor">
                                <path
                                    d="M 9 4 L 9 7.234375 L 5.515625 5.1425781 L 4.484375 6.8574219 L 6.3886719 8 L 3 8 L 3 27 L 9 27 L 9 25 L 5 25 L 5 10 L 13.027344 10 C 13.860344 9.38 14.884 9 16 9 C 16.352 9 16.682 9.0415625 17 9.1015625 L 17 8 L 13.611328 8 L 15.515625 6.8574219 L 14.484375 5.1425781 L 11 7.234375 L 11 4 L 9 4 z M 16 11 C 14.355 11 13 12.355 13 14 C 13 14.352 13.0745 14.684 13.1875 15 L 11 15 L 11 17 L 11 27 L 29 27 L 29 17 L 29 15 L 26.8125 15 C 26.9265 14.684 27 14.352 27 14 C 27 12.355 25.645 11 24 11 C 22.25 11 21.06225 12.3275 20.28125 13.4375 C 20.17625 13.5855 20.093 13.731953 20 13.876953 C 19.906 13.731953 19.82375 13.5865 19.71875 13.4375 C 18.93675 12.3275 17.75 11 16 11 z M 16 13 C 16.625 13 17.4375 13.6715 18.0625 14.5625 C 18.2145 14.7815 18.1915 14.793953 18.3125 15.001953 L 16 15.001953 C 15.434 15.001953 15 14.567953 15 14.001953 C 15 13.435953 15.434 13 16 13 z M 24 13 C 24.566 13 25 13.434 25 14 C 25 14.566 24.566 15 24 15 L 21.6875 15 C 21.8095 14.793 21.7855 14.7805 21.9375 14.5625 C 22.5625 13.6715 23.375 13 24 13 z M 13 17 L 19 17 L 19 25 L 13 25 L 13 17 z M 21 17 L 27 17 L 27 25 L 21 25 L 21 17 z">
                                </path>
                            </svg>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</main>


<!-- Modal Dialog -->
<dialog id="modalForm" style="padding: 20px; border: none; border-radius: 8px; margin: auto; width: 35rem;">
    <form action="{{ route('topup') }}" class="d-flex flex-column gap-4" method="POST">
        @csrf
        <div class="alert alert-danger {{ $loyaltyPoints > 0 ? 'd-none' : '' }}" role="alert">
            <strong>Error!</strong> You don't have Loyalty Points to Withdraw.
        </div>

        @error('points')
        <div class="alert alert-danger d-block d-none" role="alert">
            <strong>Error!</strong> {{ $message }}
        </div>
        @enderror
        <input type="number" placeholder="Points" name="points" class="form-control form-control-lg rounded-3 p-3" {{
            ($loyaltyPoints==0) ? 'disabled' : '' }} required min="1"
            max="{{ ($loyaltyPoints > 0) ? $loyaltyPoints : '99999' }}">
        <div class="d-flex align-items-center w-100 gap-3 flex-column justify-content-center">
            <button type="submit" class="btn btn-primary py-2 w-100" {{$loyaltyPoints==0 ? 'disabled' : '' }}>
                Withdraw to Wallet
            </button>
            <button id="close-btn" class="btn btn-primary py-2 w-100">
                Cancel
            </button>
        </div>
    </form>
</dialog>
@endsection


@section('js')
<!-- JavaScript to handle the modal -->
<script>
    // Get the modal and button elements
        const modal = document.getElementById('modalForm');
        const modalBtn = document.getElementById('modal-btn');
        const closeBtn = document.getElementById('close-btn');
    
        // Open the modal when the div is clicked
        modalBtn.addEventListener('click', function () {
            modal.showModal();  // Open the dialog modal
        });
    
        // Close the modal when the close button is clicked
        closeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.close();  // Close the dialog modal
        });

        // Close the modal if clicked outside of the modal content
        modal.addEventListener('click', function (e) {
        // Check if the click target is the modal background (not the form inside)
        if (e.target === modal) {
            modal.close();  // Close the dialog modal if clicked outside
        }
    });
</script>
@endsection

@section('css')
<style>
    #modalForm::backdrop {
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>
@endsection