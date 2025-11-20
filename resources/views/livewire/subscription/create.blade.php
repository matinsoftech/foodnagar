@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
@section('title', 'Create Subscription Package')

@section('content')
<div class="w-full bg-gray-50 min-h-screen py-10">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-8">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-5 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create Subscription Package</h2>
            <a href="{{ route('subscription.index') }}"
               class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="vendor_type_ids" class="block text-sm font-semibold text-gray-700 mb-1">Vendor Types</label>
                <select id="vendor_type_ids" name="vendor_type_id[]" multiple>
                    @foreach($vendortypes as $type)
                        <option value="{{ $type->id }}" {{ in_array($type->id, old('vendor_type_id', $package->vendor_type_id ?? [])) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Package Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter package name"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter description"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="is_free" name="is_free" value="1" onchange="toggleAmountField(this)"
                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="is_free" class="text-gray-700 font-medium">This is a free package</label>
            </div>

            <div>
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">Amount (if paid)</label>
                <input type="number" id="amount" name="amount" placeholder="Enter amount" value="{{ old('amount') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="days" class="block text-sm font-semibold text-gray-700 mb-1">Number of Days</label>
                <input type="number" id="days" name="days" placeholder="Enter validity in days"
                       value="{{ old('days') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1">Upload Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*"
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="pt-4 text-center">
                <button type="submit"
                    class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7" />
                    </svg>
                    Save Package
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
    function toggleAmountField(checkbox) {
        const amountInput = document.getElementById('amount');
        amountInput.disabled = checkbox.checked;
        if (checkbox.checked) {
            amountInput.value = '';
        }
    }
</script>
<script>
    new TomSelect("#vendor_type_ids", {
        plugins: ['remove_button'], // allows removing selected items
        placeholder: 'Select vendor types'
    });
</script>
@endsection
