@section('title', __('Flash Sales'))
<div>
    @if ($showCreate || $showEdit)
        <!-- Back Button -->
        <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
            ← {{ __('Back') }}
        </button>

        <!-- Create/Edit Form -->
        <div>
            <p class="text-xl font-semibold">
                {{ $showCreate ? __('New Flash Sale') : __('Edit Flash Sale') }}
            </p>

            <x-input name="title" title="{{ __('Title') }}" />

            <!-- Vendor Type -->
            <x-label for="vendor_type_id" title="{{ __('Vendor Type') }}">
                <livewire:select.sales-vendor-type-select name="vendor_type_id" />
            </x-label>

            <!-- Vendor -->
            <x-label for="vendor_id" title="{{ __('Vendor') }}">
                <livewire:select.vendor-select name="vendor_id" placeholder="{{ __('Search vendor') }}"
                    :searchable="true" :depends-on="['vendor_type_id']" />
            </x-label>

            <!-- Product Selection -->
            <x-label for="product_id" title="{{ __('Items/Products') }}">
                <livewire:select.multiple-product-select name="product_id" placeholder="{{ __('Search products') }}"
                    :multiple="true" :searchable="true" :depends-on="['vendor_type_id', 'vendor_id']" />
            </x-label>

            <!-- Display Selected Products -->
            @if (!empty($selectedProducts))
                <div class="p-2 my-2 border rounded">
                    <div class="mb-2 text-2xl font-bold">
                        {{ __('Selected Items/Products') }}
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        @foreach ($selectedProducts as $key => $selectedProduct)
                            <div class="flex items-center px-4 py-2 border rounded-sm shadow-sm">
                                <p class="w-full">{{ $selectedProduct->name ?? '' }}</p>
                                <x-buttons.plain h="h-8" bgColor="bg-red-400" wireClick="removeItem('{{ $key }}')">
                                    <x-heroicon-o-x class="w-4 h-4" />
                                </x-buttons.plain>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <x-input type="datetime-local" name="expires_at" title="{{ __('Expires At') }}" />

            <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />

            <button type="button" wire:click="{{ $showCreate ? 'save' : 'update' }}" class="px-4 py-2 bg-blue-500 text-white rounded">
                {{ $showCreate ? __('Save') : __('Update') }}
            </button>

            <button type="button" wire:click="goBack" class="ml-2 px-4 py-2 bg-red-500 text-white rounded">
                {{ __('Cancel') }}
            </button>
        </div>

    @else
        <!-- Display Table -->
        <x-baseview title="{{ __('Flash Sales') }}" :showNew="true">
            <livewire:tables.flash-sale-table />
        </x-baseview>
    @endif
</div>
