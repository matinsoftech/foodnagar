@extends('livewire.website.layouts.app')

@section('content')
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
                        @if(Auth::check())
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
                            {{--  <div class="alert alert-danger p-2" role="alert">
                                You’ve got FREE delivery. Start
                                <a href="#!" class="alert-link">checkout now!</a>
                            </div>  --}}
                            <ul class="list-group list-group-flush">
                                <!-- list group -->
                                @if(count($cart_products)>0)

                                    @foreach ($cart_products as $data)
                                        <li class="list-group-item py-3 ps-0 border-top">
                                            <!-- row -->
                                            <div class="row align-items-center">
                                                <div class="col-6 col-md-6 col-lg-7">
                                                    <div class="d-flex">
                                                        @if($data->hasproduct)
                                                            <img src="{{$data->hasproduct->getFirstMediaUrl('default') }}" alt="{{$data->hasproduct->name}}"
                                                            class="icon-shape icon-xxl" />
                                                        @else
                                                            <img src="{{$data->hasService->getFirstMediaUrl('default') }}" alt="{{$data->hasService->name}}"
                                                            class="icon-shape icon-xxl" />
                                                        @endif
                                                        <div class="ms-3">
                                                            <!-- title -->

                                                            <a href="shop-single.html" class="text-inherit">
                                                                <h6 class="mb-0">{{$data->hasproduct ? $data->hasproduct->name : $data->hasService->name}}</h6>
                                                            </a>
                                                            @if($data->hasproduct)
                                                                <small class="text-muted">  Vendor Name: {{$data->hasproduct->vendor->name}}</small></span>
                                                            @else
                                                                <small class="text-muted">  Vendor Name: {{$data->hasService->vendor->name}}</small></span>
                                                            @endif

                                                            <!-- text -->
                                                            <div class="mt-2 small lh-1">
                                                                <a href="{{route('ecommerce.remove_product',$data->id)}}" class="text-decoration-none text-inherit">
                                                                    <span class="me-1 align-text-bottom">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-trash-2 text-danger">
                                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                                            <path
                                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                            </path>
                                                                            <line x1="10" y1="11" x2="10"
                                                                                y2="17"></line>
                                                                            <line x1="14" y1="11" x2="14"
                                                                                y2="17"></line>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="text-danger">Remove</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- input group -->
                                                <div class="col-4 col-md-4 col-lg-3">
                                                    <!-- input -->
                                                    <!-- input -->
                                                    @if(isset($data->hasService->duration))
                                                    <div class="input-group input-spinner align-items-center">
                                                        @if($data->hasService->duration != 'fixed')
                                                            <input type="button" value="-" class="button-minus1 btn btn-sm" data-field="quantity" style="font-size: 1.5rem"/>
                                                            <input type="number" step="1" max="10" value="{{ $data->quantity }}"
                                                                name="quantity" class="quantity-field form-control-sm form-input"
                                                                data-id="{{ $data->id }}" style="font-size: 1rem"/>
                                                            <input type="button" value="+" class="button-plus1 btn btn-sm" data-field="quantity" style="font-size: 1.5rem"/>
                                                            <span>{{isset($data->hasService) ? $data->hasService->duration : ''}}</span>
                                                       @else
                                                       <span>Fixed (1)</span>
                                                        @endif
                                                    </div>
                                                    @else
                                                    <div class="input-group input-spinner align-items-center">
                                                            <input type="button" value="-" class="button-minus1 btn btn-sm" data-field="quantity" style="font-size: 1.5rem"/>
                                                            <input type="number" step="1" max="10" value="{{ $data->quantity }}"
                                                                name="quantity" class="quantity-field form-control-sm form-input"
                                                                data-id="{{ $data->id }}" style="font-size: 1rem"/>
                                                            <input type="button" value="+" class="button-plus1 btn btn-sm" data-field="quantity" style="font-size: 1.5rem"/>
                                                    </div>
                                                   @endif

                                                </div>
                                                <!-- price -->
                                                <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                    <span class="fw-bold"> {{currencyFormat( $data->price) }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    @else
                                         <li class="list-group-item py-3 ps-0 border-top text-center"> Cart is Empty</li>
                                    @endif
                            </ul>
                            <!-- btn -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{url('/')}}" class="btn btn-primary">Continue Shopping</a>
                                {{--  <a href="{{route('ecommerce.cart_products')}}" class="btn btn-dark">Update Cart</a>  --}}
                            </div>
                        </div>
                    </div>

                    <!-- sidebar -->
                    <div class="col-12 col-lg-4 col-md-5">
                        <!-- card -->
                        <div class="mb-5 card mt-6">
                            <div class="card-body p-6">
                                <!-- heading -->
                                <h2 class="h5 mb-4">Summary</h2>
                                <div class="card mb-2">
                                    <!-- list group -->
                                    <ul class="list-group list-group-flush">
                                        <!-- list group item -->
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Item Subtotal</div>
                                            </div>
                                            <span>{{currencyFormat($subtotal)}}</span>
                                        </li>

                                        <!-- list group item -->
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Service Fee</div>
                                            </div>
                                            <span>{{currencyFormat(0)}}</span>
                                        </li>
                                        <!-- list group item -->
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div class="fw-bold">Subtotal</div>
                                            </div>
                                            <span class="fw-bold">{{currencyFormat($subtotal)}}</span>
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
                                        <span class="fw-bold">{{currencyFormat($subtotal)}}</span>
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
    document.addEventListener("DOMContentLoaded", function () {
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
            input.addEventListener('change', function () {
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
            success: function (response) {
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
            error: function () {
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
