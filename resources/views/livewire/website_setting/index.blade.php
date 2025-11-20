@extends('layouts.app')
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
        .custom-btn {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 20px; /* Padding for the button */
            border: none; /* Remove default border */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Font size */
            font-weight: bold; /* Bold text */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease; /* Smooth background-color transition */
        }

        .custom-btn:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .custom-btn:active {
            background-color: #3e8e41; /* Even darker green when clicked */
        }
    </style>
@endpush
@section('content')
@section('title', __('Website Setting'))
<x-baseview title="{{ __('Website Setting') }}">
    <div class="container mx-auto py-6">
        <!-- Vendor Selection Form -->
        <form action="{{route('website_settings.store')}}" method="POST">
            @csrf

            <!-- MOdule Mode Selection -->
            <div class="mb-4">
                <label for="vendor_mode" class="block text-sm font-medium text-gray-700">
                    {{ __('Choose Any') }}
                </label>
                <div class="mt-2">
                    <label>
                        <input type="radio" name="module" value="single" class="form-check-input vendor-mode"  {{ $check_app_module && $check_app_module->module_type == 'single' ? 'checked' : '' }}>
                        {{ __('Single Module') }}
                    </label>
                    <label class="ml-4">
                        <input type="radio" name="module" value="multi" class="form-check-input vendor-mode"  {{ $check_app_module && $check_app_module->module_type == 'multi' ? 'checked' : '' }}>
                        {{ __('Multi Module') }}
                    </label>
                </div>
            </div>

            <!-- Module Selection -->
            <div class="mb-4" id="vendor-selection">
                <label for="vendors" class="block text-sm font-medium text-gray-700">
                    {{ __('Select Module') }}
                </label>
                <select id="vendors" name="vendors" class="form-select mt-2 block w-full" required>
                    <option value="" selected disabled>{{ __('Choose a Module') }}</option>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}" {{ $check_app_module && $check_app_module->vendor_types_id == $module->id ? 'selected' : '' }}>{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Vendor Mode Selection -->
            <div class="mb-4" id="vendor_mode1">
                <label for="vendor_mode1" class="block text-sm font-medium text-gray-700">
                    {{ __('Choose Any Vendor') }}
                </label>
                <div class="mt-2">
                    <label>
                        <input type="radio" name="vendor" value="single" class="form-check-input vendor-mode1"  {{ $check_app_module && $check_app_module->vendor_type == 'single' ? 'checked' : '' }}>
                        {{ __('Single Vendor') }}
                    </label>
                    <label class="ml-4">
                        <input type="radio" name="vendor" value="multi" class="form-check-input vendor-mode1"  {{ $check_app_module && $check_app_module->vendor_type == 'multi' ? 'checked' : '' }}>
                        {{ __('Multi Vendor') }}
                    </label>
                </div>
            </div>

            <!-- Vendor Selection -->
            <div class="mb-4" id="sub_vendor-selection">
                <label for="vendors" class="block text-sm font-medium text-gray-700">
                    {{ __('Select Vendor') }}
                </label>
                <select id="sub_vendors" name="sub_vendors" class="form-select mt-2 block w-full" required>
                    <option value="" selected disabled>{{ __('Choose a Vendor') }}</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ $check_app_module && $check_app_module->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>


            <input type="hidden" name="data_id" value="{{$check_app_module->id}}" id="">

            <!-- Submit Button -->
            <div>
                <button type="submit" class="custom-btn">
                    {{ __('Save Settings') }}
                </button>
            </div>
        </form>
    </div>
</x-baseview>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#vendor_mode1').hide();
        $('#sub_vendor-selection').hide();

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        function toggleVendorMode() {
            const selectedMode = $('input[name="module"]:checked').val();
            if (selectedMode === 'single') {
                $('#vendor-selection').show(); // Show vendor selection
                $('#vendors').prop('disabled', false); // Enable vendor selection
                $('#vendor_mode1').show();

                $('#sub_vendor-selection').show(); // Show vendor selection
                $('#sub_vendors').prop('disabled', false); // Enable vendor selection
            } else {
                $('#vendor-selection').hide(); // Hide vendor selection
                $('#vendors').prop('disabled', true); // Disable vendor selection
                $('#vendors').val(null); // Clear existing selections
                $('#vendor_mode1').hide();

                 //subvendor
                 $('#sub_vendor-selection').hide(); // Hide vendor selection
                 $('#sub_vendors').prop('disabled', true); // Disable vendor selection
                 $('#sub_vendors').val(null); // Clear existing selections

            }
        }

        function toggleVendorMode1() {
            const selectedMode = $('input[name="vendor"]:checked').val();

            if (selectedMode === 'single') {
                //sub vendor
                $('#sub_vendor-selection').show(); // Show vendor selection
                $('#sub_vendors').prop('disabled', false); // Enable vendor selection
            } else {

                //subvendor
                $('#sub_vendor-selection').hide(); // Hide vendor selection
                $('#sub_vendors').prop('disabled', true); // Disable vendor selection
                $('#sub_vendors').val(null); // Clear existing selections
            }
        }

        function updateVendors(moduleId) {
            // Clear and disable the sub_vendors dropdown while loading
            $('#sub_vendors').empty().append('<option value="" selected disabled>Loading...</option>').prop('disabled', true);

            // Make AJAX call to fetch vendors for the selected module
            $.ajax({
                url: `{{ route('website_settings.show', ':moduleId') }}`.replace(':moduleId', moduleId),
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Populate the vendors dropdown
                    $('#sub_vendors').empty().append('<option value="" selected disabled>Choose a Vendor</option>');

                    if (response.vendors.length > 0) {
                        response.vendors.forEach(vendor => {
                            $('#sub_vendors').append(`<option value="${vendor.id}">${vendor.name}</option>`);
                        });
                    } else {
                        $('#sub_vendors').append('<option value="" disabled>No vendors available</option>');
                    }

                    // Enable the dropdown
                    $('#sub_vendors').prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching vendors:", error);
                    toastr.error("Failed to fetch vendors. Please try again.");
                }
            });
        }

        // Listen for module selection changes
        $('#vendors').on('change', function () {
            const moduleId = $(this).val();
            if (moduleId) {
                updateVendors(moduleId);
            }
        });
        // Initialize the mode on page load
        toggleVendorMode();
        toggleVendorMode1();

        // Add event listener to vendor mode radio buttons
        $('.vendor-mode').on('change', function() {
            toggleVendorMode();
        });

        $('.vendor-mode1').on('change', function() {
            toggleVendorMode1();
        });


    });
</script>
@endpush
