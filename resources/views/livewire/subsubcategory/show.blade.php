@extends('layouts.app')
@section('content')
@section('title', __('Sub-SubCategory Show'))
<x-baseview title="{{ __('Sub-SubCategory Show') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <label class="inline-flex items-center text-sm font-medium text-gray-700">
                        <input type="checkbox" name="is_active" {{ $subsubcategory->is_active ? 'checked' : '' }}
                            class="form-checkbox text-blue-500 focus:ring-blue-500" readonly> 
                        <span class="ml-2">{{ $subsubcategory->is_active ? 'Active' : 'InActive' }}</span>
                    </label>
                </div>
                
                <!-- Category Name -->
                <div class="mb-4">
                    <label class="text-md font-semibold text-gray-700">Category Name : </label>
                    <span class="text-lg text-gray-800">{{ $subsubcategory->category->name }}</span>
                </div>
    
                <!-- SubCategory Name -->
                <div class="mb-4">
                    <label class="text-md font-semibold text-gray-700">SubCategory Name : </label>
                    <span class="text-lg text-gray-800">{{ $subsubcategory->subcategory->name }}</span>
                </div>
                <!-- SubSubCategory Name -->
                <div class="mb-4">
                    <label class="text-md font-semibold text-gray-700">Sub-SubCategory Name : </label>
                    <span class="text-lg text-gray-800">{{ $subsubcategory->name }}</span>
                </div>
    
                <!-- Created and Updated At -->
                <div class="mt-4">
                    <p class="text-gray-500 text-sm">Created At: {{ $subsubcategory->created_at->format('Y-m-d') }}</p>
                    <p class="text-gray-500 text-sm">Updated At: {{ $subsubcategory->updated_at->format('Y-m-d') }}</p>
                </div>
               
                <!-- Action Buttons -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('subsubcategory.edit', $subsubcategory->id) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Edit
                    </a>
                    <a href="{{ route('subsubcategory.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Back to Sub-SubCategories
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</x-baseview>

@endsection

