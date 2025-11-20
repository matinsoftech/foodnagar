@section('title', __('Hotel/Booking'))
<div>
    <x-baseview title="{{ __('Hotel Booking') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Hotel/Booking') : __('Edit Hotel/Booking') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    {{-- Show all errors --}}
                    <x-form-errors />

                    @role('manager')
                    @else
                        <livewire:component.autocomplete-input
                            wire:key="vendor-autocomplete-{{ $vendor_id ?? 'new' }}"
                            title="{{ __('Vendor') }}"
                            column="name"
                            model="Vendor"
                            :selectedId="$vendor_id ?? null"
                            emitFunction="autocompleteVendorSelected"
                            :extraQueryData="['service', 'book']"
                            customQuery="vendor_type"
                        />
                        <x-input-error message="{{ $errors->first('vendor_id') }}" />
                    @endrole

                    <livewire:component.autocomplete-input
                        wire:key="category-autocomplete-{{ $category_id ?? 'new' }}"
                        title="{{ __('Category') }}"
                        column="category"
                        model="Category"
                        :selectedId="$category_id ?? null"
                        emitFunction="autocompleteCategorySelected"
                        :extraQueryData="['service', 'book']"
                        customQuery="vendor_type_service"
                    />
                    <x-input-error message="{{ $errors->first('category_id') }}" />

                    {{-- @role('manager')
                    @else
                        <livewire:component.autocomplete-input title="{{ __('Vendor') }}" column="name" model="Vendor"
                            errorMessage="{{ $errors->first('vendor_id') }}" :queryClause="$vendorSearchClause"
                            emitFunction="autocompleteVendorSelected" :extraQueryData="['service', 'book']" customQuery="vendor_type" />
                        <x-input-error message="{{ $errors->first('vendor_id') }}" />
                    @endrole

                    <livewire:component.autocomplete-input title="{{ __('Category') }}" column="name" model="Category"
                        errorMessage="{{ $errors->first('category_id') }}" emitFunction="autocompleteCategorySelected"
                        customQuery="vendor_type_service" :extraQueryData="['service', 'book']" />
                    <x-input-error message="{{ $errors->first('category_id') }}" /> --}}

                    <x-select title="{{ __('Subcategory') }}" name="subcategory_id" :options="$subcategories" :noPreSelect="true" />

                    <x-input title="{{ __('Name') }}" name="name" />
                    <x-input.summernote name="description" wire:model.defer="description" title="{{ __('Description') }}" id="newContent" />

                    {{-- Photos --}}
                    <livewire:component.multiple-media-upload title="{{ __('Images') }}" name="photos" types="PNG or JPEG"
                        fileTypes="image/*" emitFunction="photoSelected" previewsEmit="servicePreviewsListener" max="{{ setting('filelimit.max_service_images', 3) }}"
                        maxSize="{{ setting('filelimit.service_image_size', 200) }}" />

                    <x-select title="{{ __('Duration Type') }}" :options="$durationTypes" name="duration" :defer="false" />

                    <div class="grid grid-cols-2 space-x-2">
                        <x-input title="{{ __('Price') }}" name="price" />
                        <x-input title="{{ __('Discount Price') }}" name="discount_price" />
                    </div>

                    <div class="grid grid-cols-2 space-x-2">
                        <x-checkbox title="{{ __('Location Required') }}" name="location" :defer="false" />
                        <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />
                    </div>

                    <x-checkbox title="{{ __('Age Restriction') }}" name="age_restricted"
                        description="{{ __('Customer will be informed they must be of legal age when buying this service') }}"
                        :defer="false" />

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            {{ $showCreate ? __('Save') : __('Update') }}
                        </button>
                        <button type="button" wire:click="resetForm"
                            class="ml-2 px-4 py-2 bg-red-500 text-white rounded">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <livewire:tables.service-table />
        @endif
    </x-baseview>
</div>
