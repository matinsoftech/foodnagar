@extends('layouts.app')
@section('content')
@section('title', __('Blogs'))
<x-baseview title="{{ __('Blogs') }}" >
    <div class="container mx-auto py-6">
        <!-- Create Blog Button -->
        <div class="mb-4 text-right">
            <button onclick="toggleModal()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Create Blog
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        {{--  <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Published At</th>  --}}
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 {{ $blog->is_published ? '' : 'bg-red-100' }}">
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $blog->id }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $blog->title }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $blog->description }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $blog->created_at->format('Y-m-d') }}</td>
                            {{--  <td class="px-6 py-3 text-sm text-gray-700">{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : '—' }}</td>  --}}
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        View
                                     </a>

                                     <a href="{{ route('blogs.edit', $blog->id) }}"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        Edit
                                     </a>


                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-3 text-center text-gray-500">
                                No blogs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
    <!-- Modal -->
    <div id="createBlogModal" class="fixed inset-0 bg-black bg-opacity-50 {{ $errors->any() ? '' : 'hidden' }} z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="border-b px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-medium">Create Blog</h3>
                <button onclick="toggleModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{route('blogs.store')}}" method="POST" enctype="multipart/form-data">
                    <!-- Title Input -->
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Blog Title">
                    </div>
                    <!-- Description Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Blog Description"></textarea>
                    </div>
                    <!-- Image Upload Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex justify-end">
                        <button type="button" onclick="toggleModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 text-sm">
                            Cancel
                        </button>
                        <button type="submit"
                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            Save
                        </button>
                    </div>
                </form>

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

