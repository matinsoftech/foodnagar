@extends('livewire.website.layouts.app')
@section('css')
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        .coordinates {
            margin-top: 20px;
        }

        .suggestion-list {
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
            max-height: 300px;
            /* Limit the height */
            overflow-y: auto;
            /* Scroll if content exceeds max height */
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .suggestion-list li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .suggestion-list li:hover {
            background-color: #f1f1f1;
            /* Highlight on hover */
        }

        .suggestion-list li:last-child {
            border-bottom: none;
            /* Remove border on the last item */
        }
    </style>
@endsection


@section('content')
    <main>
        <!-- section-->
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('ecommerce.cart_products')}}">Cart</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div>
                            <div class="mb-8">
                                <!-- text -->
                                <h1 class="fw-bold mb-0">Checkout</h1>
                                <p class="mb-0">Shopping Code : {{ $shopping_id }}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- row -->
                    <div class="row">

                        <div class="col-xl-7 col-lg-5 col-md-12">
                            <!-- accordion -->
                            <form action="{{ route('place_order') }}" method="post">
                                @csrf
                                <input type="hidden" name="shopping_code" value="{{ $shopping_id }}" id="shopping_id">
                                <input type="hidden" name="subtotal" value="{{ $subtotal ??  0 }}">
                                <input type="hidden" name="delivery_fee" value="{{ $delivery_charges ??  0 }}">
                                <input type="hidden" name="total_amount" value="{{ $total_amount ??  0 }}">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <!-- accordion item -->
                                    <div class="accordion-item py-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- heading one -->
                                            <a href="#" class="fs-5 text-inherit collapsed h4"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="true" aria-controls="flush-collapseOne">
                                                <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                                                Add delivery address
                                            </a>
                                            <!-- btn -->
                                            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addAddressModal"id="new_address_modal">Add a new
                                                address</a>
                                            <!-- collapse -->
                                        </div>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <div class="row">
                                                    @if ($shipping_address)
                                                        @foreach ($shipping_address as $address_detail)
                                                            <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                                                                <!-- form -->
                                                                <div class="card card-body p-6">
                                                                    <div class="form-check mb-4">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="flexRadioDefault"
                                                                            id="{{ $address_detail->id }}"
                                                                            {{ $address_detail->is_default == 1 ? 'checked' : '' }} />
                                                                        <label class="form-check-label text-dark"
                                                                            for="{{ $address_detail->id }}">{{ $address_detail->delivery_category }}</label>
                                                                    </div>
                                                                    <!-- address -->
                                                                    <strong>{{ $address_detail->name }}</strong>

                                                                    <address>
                                                                        <strong>{{ $address_detail->address }}</strong>

                                                                        <br />
                                                                        <abbr title="Phone">P:
                                                                            {{ $address_detail->phone ?? 'N/A' }}</abbr>
                                                                    </address>

                                                                    @if ($address_detail->is_default == 1)
                                                                        <div class="mt-4">
                                                                            <a href="#"
                                                                                class="btn btn-info btn-sm">Default
                                                                                address</a>
                                                                        </div>
                                                                    @else
                                                                        <a
                                                                            href="{{ route('set_shipping_address', $address_detail->id) }}">
                                                                            <span class="text-success">Set as Default
                                                                                Address</span>
                                                                        </a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- accordion item -->

                                    <!-- accordion item -->
                                    <div class="accordion-item py-4">
                                        <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                                            aria-controls="flush-collapseThree">
                                            <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>
                                            Delivery instructions
                                            <!-- collapse -->
                                        </a>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <label for="DeliveryInstructions" class="form-label sr-only">Delivery
                                                    instructions</label>
                                                <textarea class="form-control" id="DeliveryInstructions" name="delivery_instructions" rows="3"
                                                    placeholder="Write delivery instructions "></textarea>
                                                <p class="form-text">Add instructions for how you want your order shopped
                                                    and/or delivered</p>
                                                <div class="mt-5 d-flex justify-content-end">
                                                    <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        Prev
                                                    </a>
                                                    <a href="#" class="btn btn-primary ms-2" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                                        aria-controls="flush-collapseFour">
                                                        Next
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- accordion item -->
                                    <div class="accordion-item py-4">
                                        <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                                            aria-controls="flush-collapseFour">
                                            <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                                            Payment Method
                                            <!-- collapse -->
                                        </a>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <div>

                                                    <!-- card -->
                                                    <div class="card card-bordered shadow-none">
                                                        <div class="card-body p-6">
                                                            <!-- check input -->
                                                            <div class="col-12">
                                                                <div class="row ">
                                                                    @foreach ($payment_methods as $payment)
                                                                    <div class="col-md-6">
                                                                        <div class="card m-2">
                                                                            <div class="card-body">
                                                                                <div class="d-flex">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input"
                                                                                               type="radio"
                                                                                               name="payment_method"
                                                                                               id="payment_{{ $payment->id }}"
                                                                                               value="{{ $payment->id }}" />
                                                                                        <label class="form-check-label ms-2"
                                                                                               for="payment_{{ $payment->id }}">
                                                                                            <h5 class="mb-1 h6">{{ $payment->name }}</h5>
                                                                                        </label>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Button -->
                                                    <div class="mt-5 d-flex justify-content-end">
                                                        <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                                                            aria-controls="flush-collapseThree">
                                                            Prev
                                                        </a>
                                                        <button type="submit" class="btn btn-primary ms-2">Place
                                                            Order</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="col-md-12  col-xl-5 col-lg-6">
                            <div class="mt-4 mt-lg-0">
                                <div class="card shadow-sm">
                                    <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                                    <ul class="list-group list-group-flush">
                                        <!-- list group item -->
                                        @if (count($cart_products) > 0)
                                            @foreach ($cart_products as $data)
                                                <li class="list-group-item px-4 py-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-2 col-md-2">
                                                            @if ($data->hasproduct)
                                                                <img src="{{ $data->hasproduct->getFirstMediaUrl('default') }}"
                                                                    alt="{{ $data->hasproduct->name }}"
                                                                    class="icon-shape icon-md" />
                                                            @else
                                                                <img src="{{ $data->hasService->getFirstMediaUrl('default') }}"
                                                                    alt="{{ $data->hasService->name }}"
                                                                    class="icon-shape icon-md" />
                                                            @endif
                                                        </div>
                                                        <div class="col-5 col-md-5">
                                                            <h6 class="mb-0">
                                                                {{ $data->hasproduct ? $data->hasproduct->name : $data->hasService->name }}
                                                            </h6>

                                                        </div>
                                                        <div class="col-2 col-md-2 text-center text-muted">
                                                            <span>{{ $data->quantity }}
                                                                {{ isset($data->hasService) ? $data->hasService->duration : '' }}</span>
                                                        </div>
                                                        <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                            <span class="fw-bold">
                                                                {{ currencyFormat($data->price) }}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item py-3 ps-0 border-top text-center"> No Orders</li>
                                        @endif

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this address?</h6>
                    <p class="mb-6">
                        Jitu Chauhan
                        <br />

                        4450 North Avenue Oakland,
                        <br />

                        Nebraska, United States,
                        <br />

                        402-776-1106
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('store.shipping_address') }}" method="post" id="delivery_address_form">
                @csrf
                <div class="modal-content">
                    <!-- modal body -->
                    <div class="modal-body p-6">
                        <div class="d-flex justify-content-between mb-5">
                            <!-- heading -->
                            <div>
                                <h5 class="h6 mb-1" id="addAddressModalLabel">New Shipping Address</h5>
                                <p class="small mb-0">Add new shipping address for your order delivery.</p>
                            </div>
                            <div>
                                <!-- button -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        <!-- row -->
                        <input type="hidden" name="id" id="addressId" value="">
                        <!-- Address input -->
                        <label for="" class="form-label">Map Search </label>
                        <input id="autocomplete" name="address" class="form-control" type="text"
                            placeholder="Enter an address" required style="width: 100%; padding: 8px;" />

                        <ul id="suggestions" class="suggestion-list"></ul>
                        <!-- Map container -->
                        <div id="map" style="width: 100%; height: 400px; margin-top: 10px;"></div>
                        <div class="coordinates">
                            <p>Latitude: <span id="latitude">N/A</span></p>
                            <p>Longitude: <span id="longitude">N/A</span></p>
                        </div>
                        <!-- Additional form fields go here -->
                        <div class="col-12 mb-2">
                            <!-- button -->
                            <label for="" class="form-lable">Pickup Person Name</label>
                            <input type="text" class="form-control" name="name" placeholder="eg: Demo  "
                                required />

                        </div>
                        <div class="col-12 mb-2">
                            <!-- button -->
                            <label for="" class="form-lable">Pickup Person Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="eg: 98989845414 "
                                required />

                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Delivery Category</label>
                            <input type="text" class="form-control" name="delivery_category"
                                placeholder="eg: Home, Office " required />

                        </div>
                        <div class="col-12 mb-2">
                            <!-- button -->
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-control" name="description" placeholder="Description" rows="3" cols="4"></textarea>

                        </div>
                        <div class="col-12 mb-2">
                            <input type="hidden" class="form-control" name="latitude" placeholder="Latitude"
                                readonly />
                        </div>
                        <div class="col-12 mb-2">
                            <input type="hidden" class="form-control" name="longitude" placeholder="Longitude"
                                readonly />
                        </div>

                        <div class="col-12 mb-2">
                            <!-- button -->
                            <label for="" class="form-label">city</label>
                            <input type="text" class="form-control" name="city" placeholder="City" readonly />
                        </div>
                        <div class="col-12 mb-2">
                            <label for="" class="form-label">country</label>
                            <input class="form-control" type="text" name="country" placeholder="country" readonly />
                            <!-- button -->

                        </div>
                        <div class="col-12 mb-2">
                            <!-- button -->
                            <label for="" class="form-label">state</label>
                            <input class="form-control" type="text" name="state" placeholder="state" readonly />

                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="default_status" value="1"
                                    id="flexCheckDefault" />
                                <!-- label -->
                                <label class="form-check-label" for="flexCheckDefault">Set as Default</label>
                            </div>
                        </div>
                        <!-- button -->
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save Address</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection

@section('js')
    //
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps') }}&libraries=places&callback=initMap"
        async defer></script>

    <script>
        let map;
        let marker;
        let autocompleteService;
        let placesService;

        function initMap() {
            // Initialize the map centered at a default location (e.g., New York)
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 54.65904016697729,
                    lng: 199.93144252430439
                }, // Example coordinates
                zoom: 10,
            });

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: {
                    lat: 54.65904016697729,
                    lng: 199.93144252430439
                },
            });

            // Initialize the Autocomplete service
            autocompleteService = new google.maps.places.AutocompleteService();
            placesService = new google.maps.places.PlacesService(map);
        }

        // Function to fetch address suggestions
        function getAddressSuggestions(input) {
            if (input.length > 2) { // Only search if the input is longer than 2 characters
                autocompleteService.getPlacePredictions({
                    input: input
                }, displaySuggestions);
            }
        }

        // Display suggestions and handle selection
        function displaySuggestions(predictions, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                const suggestionList = document.getElementById('suggestions');
                if (suggestionList) {
                    suggestionList.innerHTML = ''; // Clear existing suggestions

                    predictions.forEach(prediction => {
                        const listItem = document.createElement('li');
                        listItem.textContent = prediction.description;
                        listItem.style.cursor = 'pointer'; // Add cursor style for better UX

                        // Add click event to fetch the coordinates of the selected suggestion
                        listItem.addEventListener('click', function() {
                            const selectedAddress = prediction.description;
                            fetchCoordinates(
                                selectedAddress); // Call fetchCoordinates with the selected address
                            suggestionList.innerHTML = ''; // Clear suggestions after selection
                        });

                        suggestionList.appendChild(listItem);
                    });
                } else {
                    console.error("The 'suggestions' element is not found in the DOM.");
                }
            }
        }

        // Update fetchCoordinates to handle updating the map and marker
        function fetchCoordinates(address) {
            const apiKey = "{{ config('app.google_maps') }}"; // Replace with your actual API key
            const url =
                `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {
                        const location = data.results[0].geometry.location;
                        const addressComponents = data.results[0].address_components;
                        marker.setPosition(location);
                        map.setCenter(location);

                        // Extract city, state, and country from the address components
                        let city = '';
                        let state = '';
                        let country = '';
                        let formattedAddress = data.results[0].formatted_address;

                        for (let component of addressComponents) {
                            const types = component.types;
                            if (types.includes('locality')) {
                                city = component.long_name;
                            } else if (types.includes('administrative_area_level_1')) {
                                state = component.long_name;
                            } else if (types.includes('country')) {
                                country = component.long_name;
                            }
                        }

                        // Display the extracted data in the input fields
                        document.getElementById('autocomplete').value = formattedAddress;
                        document.querySelector('input[name="city"]').value = city;
                        document.querySelector('input[name="state"]').value = state;
                        document.querySelector('input[name="country"]').value = country;

                        // Update coordinates display
                        document.getElementById('latitude').textContent = location.lat.toFixed(6);
                        document.getElementById('longitude').textContent = location.lng.toFixed(6);
                        document.querySelector('input[name="latitude"]').value = location.lat;
                        document.querySelector('input[name="longitude"]').value = location.lng;
                    } else {
                        alert('Error: Could not fetch coordinates.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('An error occurred while fetching data.');
                });
        }

        // Attach event listener to the address input field
        document.getElementById('autocomplete').addEventListener('input', function() {
            const address = this.value.trim();

            // Check if the input field is empty
            if (address === '') {

                document.getElementById('suggestions').innerHTML = ''; // Clear suggestions if input is empty
                document.getElementById('latitude').textContent = 'N/A';
                document.getElementById('longitude').textContent = 'N/A';
                document.querySelector('input[name="latitude"]').value = '';
                document.querySelector('input[name="longitude"]').value = '';
                document.querySelector('input[name="city"]').value = '';
                document.querySelector('input[name="state"]').value = '';
                document.querySelector('input[name="country"]').value = '';
            } else {
                // Call a function to fetch and display suggestions based on the current input
                getAddressSuggestions(address);
            }
            // const address = this.value;
            // getAddressSuggestions(address);
        });
        window.onload = function() {
            initMap(); // Or any other function that sets up the event listeners
        };

        document.querySelector('#new_address_modal').addEventListener('click', function() {
            document.querySelector('#delivery_address_form').reset();
            document.getElementById('latitude').textContent = 'N/A';
            document.getElementById('longitude').textContent = 'N/A';
            document.querySelector('[name="id"]').value = '';
            initMap();
        });
    </script>
@endsection
