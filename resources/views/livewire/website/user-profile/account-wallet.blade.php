@extends('livewire.website.layouts.app') @section('content')
<main>
    <!-- section -->
    <section>
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div
                        class="d-flex justify-content-between align-items-center d-md-none py-4"
                    >
                        <!-- heading -->
                        <h3 class="fs-5 mb-0">Account Setting</h3>
                        <!-- button -->
                        <button
                            class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAccount"
                            aria-controls="offcanvasAccount"
                        >
                            <i class="bi bi-text-indent-left fs-3"></i>
                        </button>
                    </div>
                </div>

                @include('livewire.website.user-profile.account-sidebar')

                <div class="col-lg-9 col-md-8 col-12 py-5">
                    <div class="py-6 p-md-0 p-lg-0">
                        <div class="mb-6">
                            <!-- heading -->
                            <h2 class="mb-0">Wallet</h2>
                        </div>
                        <div
                            class="grid gap-6 mt-8 " style="color: black; grid-template-columns: repeat(4,1fr); display: grid;"
                        >

                            <div
                                class="flex items-center p-5 bg-primary-100 border rounded shadow-lg"
                            >
                                <div class="w-full">
                                    <p class="text-sm fw-bold">
                                        Wallet Balance
                                    </p>
                                    <p class="text-2xl font-semibold">{{ currencyformat(Auth::user()->wallet->balance ?? 0.0) }}</p>
                                </div>
                                <svg
                                    style="width: 4rem"
                                    class="w-16"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 32 32"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M 22.96875 4 C 22.816406 4.003906 22.65625 4.023438 22.5 4.0625 L 6.25 8.34375 C 4.9375 8.6875 4 9.890625 4 11.25 L 4 25 C 4 26.644531 5.355469 28 7 28 L 25 28 C 26.644531 28 28 26.644531 28 25 L 28 12 C 28 10.355469 26.644531 9 25 9 L 11.625 9 L 23 6 L 23 8 L 25 8 L 25 6 C 25 4.875 24.042969 3.984375 22.96875 4 Z M 7 11 L 25 11 C 25.566406 11 26 11.433594 26 12 L 26 25 C 26 25.566406 25.566406 26 25 26 L 7 26 C 6.433594 26 6 25.566406 6 25 L 6 12 C 6 11.433594 6.433594 11 7 11 Z M 22.5 17 C 21.671875 17 21 17.671875 21 18.5 C 21 19.328125 21.671875 20 22.5 20 C 23.328125 20 24 19.328125 24 18.5 C 24 17.671875 23.328125 17 22.5 17 Z"
                                    ></path>
                                </svg>
                            </div>

                            <div class="p-5 bg-primary-500 text-white border-primary-500 border rounded shadow-lg"
                            style="color: black;">
                            <button class="btn border border-start-0 rounded" type="button"
                                style="background-color: #662F88; color: white" id="modal-btn">

                                Topup +
                            </button>
                            <div style="color: black;">Top-up balance to your Wallet</div>
                        </div>


                            <div
                                class="flex items-center p-5 bg-primary-500 text-white border-primary-500 border rounded shadow-lg"
                            >
                                <div class="w-full">
                                    <p class="text-sm fw-bold" style="color: black;">
                                        Total Transactions
                                    </p>
                                    <p class="text-2xl font-semibold text-black">{{ $ordersCount ?? 0 }}</p>
                                </div>
                                <svg
                                    style="width: 4rem"
                                    class="w-16 text-black"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                

                    <div class="d-flex p-4 mt-4 bg-white rounded shadow flex-column flex-md-row gap-md-4">
                        <div class="w-100 col-md-6">
                            {{-- wallet transactions list  --}}
                            <p class="pb-2 h5 fw-bold">Wallet Transactions</p>
                            <livewire:tables.user-wallet-transaction-table walletId="{{ Auth::user()->wallet->id ?? '' }}" />
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
