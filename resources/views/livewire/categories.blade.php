@section('title', __('Categories'))
<div>
    <x-baseview title="{{ __('Categories') }}" :showNew="inProduction()">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Category') : __('Edit Category') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name *') }}" name="name" placeholder="" />
                    <x-input title="{{ __('Color') }}" name="color" placeholder="" type="color" class="h-10 p-1"/>
                    <x-select title="{{ __('Vendor Type') }}" :options='$vendorTypes ?? []' name="vendor_type_id" />
                    <x-input 
                        title="{{ __('Priority') }}" 
                        name="priority" 
                        placeholder="Enter priority (higher number = higher priority)" 
                        type="number" 
                        min="0" 
                    />
                    <x-media-upload
                        title="{{ __('Photo') }}"
                        name="photo"
                        :photo="$photo"
                        :photoInfo="$photoInfo"
                        types="PNG or JPEG"
                        rules="image/*" />
                    <x-media-upload
                        title="{{ __('Banner') }}"
                        name="banner"
                        :photo="$banner"
                        :photoInfo="$bannerInfo"
                        types="PNG or JPEG"
                        rules="image/*" />

                    <x-checkbox
                        title="{{ __('Active') }}"
                        name="isActive" :defer="false" />

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            {{ $showCreate ? __('Save') : __('Update') }}
                        </button>
                        <button type="button" wire:click="resetForm" class="ml-2 px-4 py-2 bg-red-500 text-white rounded">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        @else
            <livewire:tables.category-table />
        @endif
    </x-baseview>
</div>
