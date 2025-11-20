@extends('livewire.website.layouts.app')
@section('css')
    <style>
        .table td {
            font-size: 0.875rem;
            padding: 0.25rem;
        }
    </style>


@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <main>
        <!-- section-->
        {{-- <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        @if (Auth::check())
                            <div class="card py-1 border-0 mb-8 bg-unset">
                                <div>
                                    <h1 class="fw-bold">Shop Cart</h1>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <div class="py-3">
                            <!-- alert -->

                            <ul class="list-group list-group-flush">
                                <!-- list group -->
                                @if ($cart_products->isNotEmpty())
                                    @foreach ($cart_products as $vendorName => $products)
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="mt-4">Shop Name: {{ $vendorName }}</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>Product Details</th>
                                                                <th>Unit Price</th>
                                                                <th width="20%">Quantity</th>
                                                                <th>Total Price</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $index => $data)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            @if ($data->hasproduct)
                                                                                <img src="{{ $data->hasproduct->getFirstMediaUrl('default') }}"
                                                                                    alt="{{ $data->hasproduct->name }}"
                                                                                    class="icon-shape icon-sm me-3" />
                                                                            @else
                                                                                <img src="{{ $data->hasService->getFirstMediaUrl('default') }}"
                                                                                    alt="{{ $data->hasService->name }}"
                                                                                    class="icon-shape icon-sm me-3" />
                                                                            @endif
                                                                            <div>
                                                                                <a href="shop-single.html"
                                                                                    class="text-inherit">
                                                                                    <h6 class="mb-0">
                                                                                        {{ $data->hasproduct ? $data->hasproduct->name : $data->hasService->name }}
                                                                                    </h6>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>

                                                                        <span
                                                                            class="fw-bold">{{ currencyFormat(isset($data->hasproduct) ? (isset($data->hasproduct->discount_price) && $data->hasproduct->discount_price > 0 ? $data->hasproduct->discount_price : $data->hasproduct->price) : $data->hasService->price) }}
                                                                        </span>
                                                                        @if (isset($data->hasproduct) && $data->hasproduct->discount_price > 0)
                                                                            <strike>{{ currencyFormat(isset($data->hasproduct->price)) }}</strike>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div
                                                                            class="input-group input-spinner align-items-center">
                                                                            <input type="button" value="-"
                                                                                class="button-minus1 btn btn-sm"
                                                                                data-field="quantity"
                                                                                style="font-size: 1rem; padding: 0.25rem 0.5rem;" />
                                                                            <input type="number" step="1"
                                                                                max="10" value="{{ $data->quantity }}"
                                                                                name="quantity"
                                                                                class="quantity-field form-control-sm form-input"
                                                                                data-id="{{ $data->id }}"
                                                                                style="font-size: 0.875rem; padding: 0.25rem 0.5rem; height: 30px;" />
                                                                            <input type="button" value="+"
                                                                                class="button-plus1 btn btn-sm"
                                                                                data-field="quantity"
                                                                                style="font-size: 1rem; padding: 0.25rem 0.5rem;" />
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <span
                                                                            class="fw-bold">{{ currencyFormat($data->price) }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('ecommerce.remove_product', $data->id) }}"
                                                                            class="text-decoration-none text-danger">
                                                                            <span class="me-1 align-text-bottom">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="14" height="14"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-trash-2 text-danger">
                                                                                    <polyline points="3 6 5 6 21 6">
                                                                                    </polyline>
                                                                                    <path
                                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                    </path>
                                                                                    <line x1="10" y1="11"
                                                                                        x2="10" y2="17">
                                                                                    </line>
                                                                                    <line x1="14" y1="11"
                                                                                        x2="14" y2="17">
                                                                                    </line>
                                                                                </svg>
                                                                            </span>

                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <li class="list-group-item py-3 ps-0 border-top text-center">Cart is Empty</li>
                                @endif

                            </ul>
                            <!-- btn -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
                                {{--  <a href="{{route('ecommerce.cart_products')}}" class="btn btn-dark">Update Cart</a>  --}}
                            </div>
                        </div>
                    </div>

                    <!-- sidebar -->
                    <div class="col-12 col-lg-4 col-md-5">
                        <!-- card -->
                        <div class="mb-5 card mt-6">
                            <div class="card-body p-6">
                                <h2>Select Days</h2>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daysRadio" id="day1"
                                                value="1" checked>
                                            <label class="form-check-label" for="day1">
                                                1 Day (Today)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daysRadio" id="day7"
                                                value="7">
                                            <label class="form-check-label" for="day7">
                                                7 Days (Week)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daysRadio" id="day15"
                                                value="15">
                                            <label class="form-check-label" for="day15">
                                                15 Days (Fortnight)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daysRadio"
                                                id="day30" value="30">
                                            <label class="form-check-label" for="day30">
                                                30 Days (Month)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="daysRadio"
                                                id="customDays" value="custom">
                                            <label class="form-check-label" for="customDays">
                                                Custom Selection
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <h2>Select Dates</h2>
                                <div class="card mb-4">
                                    <div class="card-body p-0">
                                        <div id="inlineCalendar"></div>
                                        <div class="p-3 border-top">
                                            <small class="text-muted">Selected Dates:</small>
                                            <div id="selectedDates" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- heading -->
                                <h2 class="h5 mb-4">Summary</h2>
                                <div class="card mb-2">
                                    <!-- list group -->
                                    <ul class="list-group list-group-flush">
                                        <!-- list group item -->
                                        <!-- list group item -->
                                        <li class="list-group-item px-4 py-3">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div>Item Subtotal</div>
                                                <div class="fw-bold">{{ currencyFormat($subtotal) }}</div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    Delivery Fee

                                                </div>
                                                <div class="fw-bold">{{ currencyFormat($delivery_charges) }}</div>
                                            </div>
                                        </li>
                                        <!-- list group item -->
                                        <li class="list-group-item px-4 py-3">
                                            <div class="d-flex align-items-center justify-content-between fw-bold">
                                                <div>Total Amount</div>
                                                <div>{{ currencyFormat($total_amount) }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-grid mb-1 mt-4">
                                    <!-- btn -->
                                    {{-- <button
                                        class="btn btn-primary btn-lg d-flex justify-content-between align-items-center"
                                        type="submit">
                                        Go to Checkout
                                        <span class="fw-bold">$67.00</span>
                                    </button> --}}
                                    <a href="{{ url('checkout') }}"
                                        class="btn btn-primary btn-lg d-flex justify-content-between align-items-center">
                                        Go to Checkout
                                        <span class="fw-bold">{{ currencyFormat($subtotal) }}</span>
                                    </a>
                                </div>
                                <!-- text -->
                                <p>
                                    <small>
                                        By placing your order, you agree to be bound by the Freshcart
                                        <a href="#!">Terms of Service</a>
                                        and
                                        <a href="#!">Privacy Policy.</a>
                                    </small>
                                </p>

                                <!-- heading -->
                                <div class="mt-8">
                                    <h2 class="h5 mb-3">Add Promo or Gift Card</h2>
                                    <form>
                                        <div class="mb-2">
                                            <!-- input -->
                                            <label for="giftcard" class="form-label sr-only">Email address</label>
                                            <input type="text" class="form-control" id="giftcard"
                                                placeholder="Promo or Gift Card" />
                                        </div>
                                        <!-- btn -->
                                        <div class="d-grid"><button type="submit"
                                                class="btn btn-outline-dark mb-1">Redeem</button></div>
                                        <p class="text-muted mb-0"><small>Terms & Conditions apply</small></p>
                                    </form>
                                </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            const calendar = flatpickr("#inlineCalendar", {
                inline: true,
                mode: "multiple",
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates) {
                    updateSelectedDatesDisplay(selectedDates);
                    // If dates are manually selected, switch to custom mode
                    if (selectedDates.length > 0) {
                        document.getElementById('customDays').checked = true;
                    }
                }
            });

            // Update selected dates display
            function updateSelectedDatesDisplay(dates) {
                const container = document.getElementById('selectedDates');
                if (dates.length === 0) {
                    container.innerHTML = '<span class="text-muted">No dates selected</span>';
                    return;
                }

                container.innerHTML = dates.map(date =>
                    `<span class="badge bg-primary me-1 mb-1">${date.toDateString()}</span>`
                ).join('');
            }

            // Handle radio button changes
            document.querySelectorAll('input[name="daysRadio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'custom') return;

                    const days = parseInt(this.value);
                    const today = new Date();
                    const selectedDates = [];

                    for (let i = 0; i < days; i++) {
                        const date = new Date(today);
                        date.setDate(today.getDate() + i);
                        selectedDates.push(date);
                    }

                    calendar.setDate(selectedDates);
                    updateSelectedDatesDisplay(selectedDates);
                });
            });

            // Initialize with today's date
            document.getElementById('day1').dispatchEvent(new Event('change'));
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle button clicks
            document.querySelectorAll('.button-minus1, .button-plus1').forEach(button => {
                // Remove any previously attached listeners
                button.removeEventListener('click', handleButtonClick);

                // Add the click event listener
                button.addEventListener('click', handleButtonClick);
            });

            function handleButtonClick(event) {
                let button = event.currentTarget;
                let inputField = button.parentElement.querySelector('.quantity-field');
                let currentValue = parseInt(inputField.value) || 0;
                let maxValue = parseInt(inputField.getAttribute('max')) || Infinity;

                // Adjust value based on button type
                if (button.classList.contains('button-plus1')) {
                    if (currentValue < maxValue) inputField.value = currentValue + 1;
                } else if (button.classList.contains('button-minus1')) {
                    if (currentValue > 1) inputField.value = currentValue - 1;
                }

                // Trigger update
                updateCartQuantity(inputField);
            }

            // Handle manual input change
            document.querySelectorAll('.quantity-field').forEach(input => {
                input.addEventListener('change', function() {
                    let minValue = 1;
                    let maxValue = parseInt(this.getAttribute('max')) || Infinity;

                    if (this.value < minValue) {
                        this.value = minValue;
                    } else if (this.value > maxValue) {
                        this.value = maxValue;
                    }

                    // Trigger update
                    updateCartQuantity(this);
                });
            });
        });

        // AJAX request to update the cart
        function updateCartQuantity(input) {
            let cartItemId = input.getAttribute('data-id');
            let newQuantity = input.value;

            $.ajax({
                url: "{{ route('ecommerce.updateCart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: cartItemId,
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Cart updated successfully!',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        location.reload();
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update cart. Please try again.',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating the cart.',
                        toast: true,
                        position: 'top-end',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
@endsection
