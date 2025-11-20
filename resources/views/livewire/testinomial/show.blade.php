@extends('layouts.app')
@section('content')
@section('title', __('Testinomial Show'))
<x-baseview title="{{ __('Testinomial Show') }}" >
        <div class="overflow-x-auto">
            <div class="container mx-auto py-6">
                <div class="bg-white shadow-md rounded-lg p-6">


                    <span class=" font-semibold text-gray-700"> Name : </span><span>{{ $testinomial->name }}</span> <br>
                    <span class=" font-semibold text-gray-700"> Designation </span><span>{{ $testinomial->designation }}</span> <br>
                    <span class=" font-semibold text-gray-700"> Description</span>
                    <p class="text-sm text-gray-600 mt-2"> {{ $testinomial->description }}</p>
                    <div class="mt-4">
                        <p class="text-gray-500">Created At: {{ $testinomial->created_at->format('Y-m-d') }}</p>
                        <p class="text-gray-500">Updated At: {{ $testinomial->updated_at->format('Y-m-d') }}</p>
                    </div>

                    <!-- Image Upload Input (optional) -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload Image</label>

                        @if ($testinomial->getFirstMediaUrl('images'))
                            <div class="mt-2">
                                <img src="{{ $testinomial->getFirstMediaUrl('images') }}" alt="testinomial Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                    </div>

                    @if ($testinomial->is_active)
                        <p class="mt-2 text-green-600">This testinomial is published.</p>
                    @else
                        <p class="mt-2 text-red-600">This testinomial is not published.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('testinomial.edit', $testinomial->id) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Edit</a>
                        <a href="{{ route('testinomial.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 ml-2">Back to testinomials</a>
                    </div>
                </div>
            </div>
        </div>



    <script>
        function toggleModal() {
            const modal = document.getElementById('createtestinomialModal');
            modal.classList.toggle('hidden');
        }

        // Close modal after saving
        window.addEventListener('close-modal', () => {
            toggleModal();
        });
    </script>

</x-baseview>

@endsection

