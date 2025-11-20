@extends('layouts.app')

@section('content')
@section('title', __('Edit Blog'))
<x-baseview title="{{ __('Edit Blog') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Modules</label>
                    <select name="vendortype" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="" disabled selected>Select Module</option>
                        @foreach ($vendortypes as $vendortypes)
                            <option value="{{ $vendortypes->id }}" {{$vendortypes->id == $blog->vendortype_id ? 'selected' : ''}}>{{ $vendortypes->name }}</option>
                        @endforeach
                     </select>
                    </div>
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Blog Title">
                    </div>

                    <!-- Description Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Blog Description">{{ old('description', $blog->description) }}</textarea>
                    </div>

                    <!-- Image Upload Input (optional) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if ($blog->getFirstMediaUrl('images'))
                            <div class="mt-2">
                                <img src="{{ $blog->getFirstMediaUrl('images') }}" alt="Blog Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                    </div>

                    <!-- Published Checkbox -->
                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm font-medium text-gray-700">
                            <input type="checkbox" name="is_published" {{ $blog->is_active ? 'checked' : '' }}
                                class="form-checkbox text-blue-500 focus:ring-blue-500">
                            <span class="ml-2">Publish this blog</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('blogs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
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
