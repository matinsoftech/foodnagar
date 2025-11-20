@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <style>
        .adpost-card {
            padding: 0;
            background: unset;
        }

        .adpost-title {
            border-bottom: unset;
        }

        .adpost-title::before {
            display: none;
        }
    </style>
@endsection
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
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-0 p-lg-0">
                            {{-- banner section start --}}
                            {{-- <section class="single-banner dashboard-banner">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single-content">
                                                <h2>ad post</h2>
                                                <ol class="breadcrumb justify-content-center">
                                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">ad-post</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section> --}}
                            {{-- banner section end --}}
                            <section class="adpost-part p-0">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <form class="adpost-form" id="product-form" action="{{ url('/user-store-listing') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="adpost-card">
                                                    <div class="adpost-title m-0">
                                                        <h3>Add Information</h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Title</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    placeholder="Type your title here">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <h3 class="mt-3 mb-3">@lang('Location')</h3>

                                                            <div class="row">
                                                                <!-- Province Selection -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Province</label>
                                                                    <select name="province_id"
                                                                        class="form-control province_id"
                                                                        id="edit_province_id">
                                                                        <option value="">Select Province</option>
                                                                        @foreach ($provinces as $province)
                                                                            <option value="{{ $province->province_id }}"
                                                                                @if (isset($data['province_id']) && $data['province_id'] == $province->province_id) selected @endif>
                                                                                {{ $province->province_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                @php
                                                                    // Fetch districts based on the selected province
                                                                    $selectedProvinceId = isset($data['province_id'])
                                                                        ? $data['province_id']
                                                                        : null;
                                                                    $districts = \DB::table('districts')
                                                                        ->where('province_id', $selectedProvinceId)
                                                                        ->get();
                                                                @endphp

                                                                <!-- District Selection -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="">District</label>
                                                                    <select name="district_id"
                                                                        class="form-control district_id"
                                                                        id="edit_district_id">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $district)
                                                                            <option value="{{ $district->district_id }}"
                                                                                @if (isset($data['district_id']) && $data['district_id'] == $district->district_id) selected @endif>
                                                                                {{ $district->district_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                @php
                                                                    // Fetch cities based on the selected district
                                                                    $selectedDistrictId = isset($data['district_id'])
                                                                        ? $data['district_id']
                                                                        : null;
                                                                    $cities = \DB::table('municipalities')
                                                                        ->where('district_id', $selectedDistrictId)
                                                                        ->get();
                                                                @endphp

                                                                <!-- City Selection -->
                                                                <div class="form-group col-md-4">
                                                                    <label for="">City</label>
                                                                    <select name="city_id" class="form-control city_id"
                                                                        id="edit_city_id">
                                                                        <option value="">Select City</option>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->municipality_id }}"
                                                                                @if (isset($data['city_id']) && $data['city_id'] == $city->municipality_id) selected @endif>
                                                                                {{ $city->municipality_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Image</label>
                                                                <input type="file" name="image" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Category</label>
                                                                <select class="form-control custom-select"
                                                                    name="category_id">
                                                                    <option selected disabled>Select Category</option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" name="price" class="form-control"
                                                                    placeholder="Enter your pricing amount">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <fieldset>
                                                                    <legend class="form-label">Price Condition</legend>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="fix-check" name="unit" value="fixed">
                                                                        <label class="form-check-label"
                                                                            for="fix-check">Fixed</label>
                                                                    </div>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="nego-check" name="unit"
                                                                            value="negotiable">
                                                                        <label class="form-check-label"
                                                                            for="nego-check">Negotiable</label>
                                                                    </div>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="day-check" name="unit" value="daily">
                                                                        <label class="form-check-label"
                                                                            for="day-check">Daily</label>
                                                                    </div>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="week-check" name="unit"
                                                                            value="weekly">
                                                                        <label class="form-check-label"
                                                                            for="week-check">Weekly</label>
                                                                    </div>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="month-check" name="unit"
                                                                            value="monthly">
                                                                        <label class="form-check-label"
                                                                            for="month-check">Monthly</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="year-check" name="unit"
                                                                            value="yearly">
                                                                        <label class="form-check-label"
                                                                            for="year-check">Yearly</label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <fieldset>
                                                                    <legend class="form-label">Ad Type</legend>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="sale-check" name="ad_type"
                                                                            value="sale">
                                                                        <label class="form-check-label flat-badge sale"
                                                                            for="sale-check">Sale</label>
                                                                    </div>
                                                                    <div class="form-check mb-2">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="rent-check" name="ad_type"
                                                                            value="rent">
                                                                        <label class="form-check-label flat-badge rent"
                                                                            for="rent-check">Rent</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input"
                                                                            id="book-check" name="ad_type"
                                                                            value="booking">
                                                                        <label class="form-check-label flat-badge booking"
                                                                            for="book-check">Booking</label>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                            <!--<div class="col-md-4">
                                                                            <fieldset>
                                                                                <legend class="form-label">Product Condition</legend>
                                                                                <div class="form-check mb-2">
                                                                                    <input type="checkbox" class="form-check-input"
                                                                                        id="use-check" value="used">
                                                                                    <label class="form-check-label"
                                                                                        for="use-check">Used</label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input"
                                                                                        id="new-check" value="new">
                                                                                    <label class="form-check-label"
                                                                                        for="new-check">New</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>-->
                                                        </div>



                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Add description</label>
                                                                <textarea class="form-control" name="description" placeholder="Describe your message"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Add tag</label>
                                                                <textarea class="form-control" placeholder="Maximum of 15 keywords"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="adpost-card">
                                                    <div class="adpost-title">
                                                        <h3>Author Information</h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Your Name" name="user_name"
                                                                    value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    placeholder="Your Email" name="user_email"
                                                                    value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Number</label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Your Number" name="user_phone"
                                                                    value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Your Address" name="user_address"
                                                                    value="{{ Auth::check() ? Auth::user()->address : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="adpost-card pb-2">
                                                    <div class="adpost-agree">
                                                        <div class="form-group">
                                                            <input type="checkbox" class="form-check">
                                                        </div>
                                                        <p>Send me Trade Email/SMS Alerts for people looking to buy mobile
                                                            handsets in www By
                                                            clicking "Post", you agree to our <a href="#">Terms of
                                                                Use</a> and <a href="#">Privacy Policy</a> and
                                                            acknowledge that you are the rightful
                                                            owner of this item and using Trade to find a genuine buyer.</p>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-inline">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>Publish your ad</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- ADPOST PART END-->
                        </div>
                    </div>
    </main>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to populate dropdown
        function populateDropdown(targetId, placeholder, data, valueKey, textKey) {
            let dropdown = $(`#${targetId}`);
            dropdown.empty();
            dropdown.append(`<option value="">${placeholder}</option>`);

            $.each(data, function(key, value) {
                dropdown.append(`<option value="${value[valueKey]}">${value[textKey]}</option>`);
            });
        }

        // Generic function for AJAX request
        function fetchData(url, params, targetId, placeholder, valueKey, textKey) {
            $.ajax({
                url: url,
                type: "GET",
                data: params,
                beforeSend: function() {
                    $(`#${targetId}`).prop('disabled', true);
                },
                success: function(response) {
                    populateDropdown(targetId, placeholder, response.data, valueKey, textKey);
                    $(`#${targetId}`).prop('disabled', false);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Failed to load data. Please try again.');
                    $(`#${targetId}`).prop('disabled', false);
                }
            });
        }

        // Event listeners for province and district changes
        $(document).on('change', '#province_id, #edit_province_id', function() {
            let provinceId = $(this).val();
            let targetDistrictId = $(this).is('#province_id') ? 'district_id' : 'edit_district_id';
            fetchData(
                "{{ route('districts') }}", {
                    province_id: provinceId
                },
                targetDistrictId,
                'Select District',
                'district_id',
                'district_name'
            );
        });

        $(document).on('change', '#district_id, #edit_district_id', function() {
            let districtId = $(this).val();
            let targetCityId = $(this).is('#district_id') ? 'city_id' : 'edit_city_id';
            fetchData(
                "{{ route('cities') }}", {
                    district_id: districtId
                },
                targetCityId,
                'Select City',
                'municipality_id',
                'municipality_name'
            );
        });

        const selectedValues = Array.from(document.querySelectorAll('.form-check-input:checked'))
            .map(input => input.value);

        console.log(selectedValues); 
        
    </script>
@endsection
