@extends('layouts.app')

@section('content')
@section('title', __('Create Amenity'))
<x-baseview title="{{ __('Create Amenity') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('amenities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Amenity Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Vendor Types</label>
                        <select name="vendor_type_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="" disabled selected>Select Module</option>
                            @foreach ($vendorTypes as $vendorType)
                                <option value="{{ $vendorType->id }}">{{ $vendorType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image Upload Input (optional) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Published Checkbox -->
                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" name="is_published"
                                class="form-checkbox text-blue-500 focus:ring-blue-500" checked>
                            <span class="ml-2">Publish this Amenity</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('amenities.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save Amenity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-baseview>
@endsection
