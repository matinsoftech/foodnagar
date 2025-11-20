@extends('layouts.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
@section('title', __('Edit Sub-SubCategory'))
<x-baseview title="{{ __('Edit Sub-SubCategory') }}">
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('subsubcategory.update', $subsubcategory->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="" value="{{ $subsubcategory->name }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm select2"
                            id="category_id">
                            <option value="" disabled selected>Select Module</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $subsubcategory->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Sub-Category</label>
                        <select name="sub_category_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm select2"
                            id="subcategory_id">
                            <option value="" disabled selected>Select Module</option>
                            @foreach ($subcatgeories as $subcatgeory)
                                <option value="{{ $subcatgeory->id }}"
                                    {{ $subcatgeory->id == $subsubcategory->sub_category_id ? 'selected' : '' }}>
                                    {{ $subcatgeory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" name="is_active" {{ $subsubcategory->is_active ? 'checked' : '' }}
                                class="form-checkbox text-blue-500 focus:ring-blue-500">
                            <span class="ml-2">Make Active</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('subsubcategory.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-baseview>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    
        $('#category_id').change(function() {
            let categoryId = $(this).val();
            let subcategorySelect = $('#subcategory_id');
    
            if (categoryId) {
                $.ajax({
                    url: 'get-subcategories/' + categoryId, // Replace with your route
                    type: 'GET',
                    success: function(data) {
                        subcategorySelect.empty();
                        subcategorySelect.append('<option value="" disabled selected>Select Sub-Category</option>');
                        
                        $.each(data, function(key, value) {
                            subcategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Failed to fetch subcategories.');
                    }
                });
            } else {
                subcategorySelect.empty();
                subcategorySelect.append('<option value="" disabled selected>Select Sub-Category</option>');
            }
        });
    });
    
</script>
@endpush
