@extends('layouts.app')
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
@endpush
@section('content')
@section('title', __('Testinomial'))
<x-baseview title="{{ __('Testinomial') }}" >
    <div class="container mx-auto py-6">
        <!-- Create Blog Button -->
        <div class="mb-4 text-right">
            <a href="{{route('testinomial.create')}}"  class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Create Testinomial
            </a>

        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Designation</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Published</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testinomials as $testinomial)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 {{ $testinomial->is_published ? '' : 'bg-red-100' }}">
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $loop->iteration}}</td>
                            <td class="px-6 py-3 text-sm text-gray-700"> @if ($testinomial->getFirstMediaUrl('images'))
                                <div class="mt-2">
                                    <img src="{{ $testinomial->getFirstMediaUrl('images') }}" alt="Blog Image" class="w-32 h-32 object-cover rounded-md">
                                </div>
                            @endif</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $testinomial->name }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $testinomial->designation }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">
                                {{ Str::limit($testinomial->description, 100, '...') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $testinomial->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">
                                {{ $testinomial->is_active ? 'Active' : 'Inactive' }}
                            </td>

                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- View Button -->
                                    <a href="{{ route('testinomial.show', $testinomial->id) }}"
                                        class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">
                                        <i class="fas fa-eye mr-1 text-sm"></i> <!-- Adjust icon size -->
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('testinomial.edit', $testinomial->id) }}"
                                        class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">
                                        <i class="fas fa-edit mr-1 text-sm"></i> <!-- Adjust icon size -->
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('testinomial.destroy', $testinomial->id) }}" method="POST" class="inline" id="deleteForm{{ $testinomial->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs delete-btn"
                                            data-id="{{ $testinomial->id }}">
                                            <i class="fas fa-trash-alt mr-1 text-sm"></i> <!-- Adjust icon size -->
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $testinomials->links() }}
        </div>
    </div>


</x-baseview>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            var blogId = event.target.getAttribute('data-id');
            // Trigger SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to delete the blog
                    document.getElementById('deleteForm' + blogId).submit();
                }
            });
        });
    });
</script>

@endpush

