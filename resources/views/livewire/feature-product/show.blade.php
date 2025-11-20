@extends('layouts.app')

@section('content')
@section('title', __('Show Feature Section'))
<x-baseview title="{{ __('Show Feature Section') }}" >
    <div class="container mx-auto py-8">
        <!-- Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b bg-gray-50">
                <h2 class="text-2xl font-bold text-gray-800">{{ $feature_product->title }}</h2>
                <p class="text-gray-600 text-sm mt-1">Detailed information about this feature product.</p>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6">
                <!-- Description -->
                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Description</h3>
                    <p class="text-gray-800 text-sm">{{ $feature_product->description }}</p>
                </div>

                <!-- Products -->
                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Products</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach (json_decode($feature_product->product_id) ?? [] as $prod_id)
                            @php
                                $product = App\Models\Product::find($prod_id);
                            @endphp
                            @if ($product)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium">
                                    {{ $product->name }}
                                </span>
                            @endif
                        @endforeach
                        @if(empty(json_decode($feature_product->product_id)))
                            <span class="text-gray-500 text-sm">No products assigned</span>
                        @endif
                    </div>
                </div>

                <!-- Priority -->
                <div>
                    <h3 class="text-gray-700 font-semibold mb-2">Priority</h3>
                    <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">
                        {{ $feature_product->priority ?? 'N/A' }}
                    </span>
                </div>

                <!-- Created & Updated -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-gray-700 font-semibold mb-2">Created At</h3>
                        <p class="text-gray-800 text-sm">{{ $feature_product->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-gray-700 font-semibold mb-2">Last Updated</h3>
                        <p class="text-gray-800 text-sm">{{ $feature_product->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 py-4 border-t flex justify-end space-x-3 bg-gray-50">
                <a href="{{ route('feature_product.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                    Back
                </a>
                <a href="{{ route('feature_product.edit', $feature_product->id) }}"
                   class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Edit
                </a>
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
