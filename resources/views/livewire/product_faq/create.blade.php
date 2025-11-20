@extends('layouts.app')

@section('content')
@section('title', __('Product Faqs'))
<x-baseview title="{{ __('Product Faqs') }}" >
    <div class="overflow-x-auto">
        <div class="container mx-auto py-6">
            <div class="bg-white shadow-md rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-4"> Product {{ $product->name }} (Faqs)</h1>

                <table class="table-auto w-full border border-gray-300 text-sm">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Question</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Answer</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productFaqs as $productFaq)
                            <tr>
                                <td>{{ $productFaq->question }}</td>
                                <td>{{ $productFaq->answer }}</td>
                                <td>
                                    <form action="{{ route('product.faq.destroy', $productFaq->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No product faqs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <form action="{{ route('product.faq.store', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" name="question" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Enter Question">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Answer</label>
                        <input type="text" name="answer" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            placeholder="Enter Answer">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('admin.products') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </a>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save Faq
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-baseview>
@endsection
