@extends('layouts.app')

@section('content')
@section('title', __('Create Feature Section'))
<x-baseview title="{{ __('Create Feature Section') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('feature_product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Feature Product Title">
                    </div>

                    <!-- Description Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Feature Product Description"></textarea>
                    </div>
                    <!-- Product Dropdown multiple select -->
                    <div class="mb-4">
                        <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">Select Products:</label>
                        <select id="product_id" name="product_id[]" multiple
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @foreach ($product as $products)
                                <option value="{{ $products->id }}">{{ $products->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Priority -->
                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority:</label>
                        <input type="number" name="priority" id="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="eg: 1">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('feature_product.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-baseview>

{{-- jQuery + Select2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#product_id').select2({
            placeholder: "Select products",
            allowClear: true
        });
    });
</script>
@endsection
