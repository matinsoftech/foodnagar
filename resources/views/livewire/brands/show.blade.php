@extends('layouts.app')
@section('content')
@section('title', __('Blogs Show'))
<x-baseview title="{{ __('Blogs Show') }}" >
        <div class="overflow-x-auto">
            <div class="container mx-auto py-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-blue-600 text-center">{{ $blog->module->name }}</h2>

                    <h2 class="text-2xl font-semibold text-gray-700">{{ $blog->title }}</h2>
                    <p class="text-sm text-gray-600 mt-2">{{ $blog->description }}</p>
                    <div class="mt-4">
                        <p class="text-gray-500">Created At: {{ $blog->created_at->format('Y-m-d') }}</p>
                        <p class="text-gray-500">Updated At: {{ $blog->updated_at->format('Y-m-d') }}</p>
                    </div>

                    <!-- Image Upload Input (optional) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload Image</label>

                        @if ($blog->getFirstMediaUrl('images'))
                            <div class="mt-2">
                                <img src="{{ $blog->getFirstMediaUrl('images') }}" alt="Blog Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                    </div>

                    @if ($blog->is_active)
                        <p class="mt-2 text-green-600">This blog is published.</p>
                    @else
                        <p class="mt-2 text-red-600">This blog is not published.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Edit</a>
                        <a href="{{ route('blogs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 ml-2">Back to Blogs</a>
                    </div>
                </div>
            </div>
        </div>



    <script>
        function toggleModal() {
            const modal = document.getElementById('createBlogModal');
            modal.classList.toggle('hidden');
        }

        // Close modal after saving
        window.addEventListener('close-modal', () => {
            toggleModal();
        });
    </script>

</x-baseview>

@endsection

