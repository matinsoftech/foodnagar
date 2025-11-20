@section('title', __('Delivery Address'))
<div>
    <x-baseview title="{{ __('Delivery Address') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Delivery Address') : __('Edit Delivery Address') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-autocomplete-input title="{{ __('User') }}" name="user" :dataList="$users ?? []" emitFunction="autocompleteUserSelected" />
                    <x-input title="{{ __('Name') }}" name="name" placeholder="" />
                    <x-input title="{{ __('Description') }}" name="description" placeholder="" />
                    <livewire:component.autocomplete-address title="{{ __('Address') }}" name="address" address="{{ $address ?? '' }}" />

                    <div class="grid grid-cols-2 space-x-4">
                        <x-input title="{{ __('Latitude') }}" name="latitude" :disable="true" />
                        <x-input title="{{ __('Longitude') }}" name="longitude" :disable="true" />
                    </div>

                    <x-form-errors />

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
            <livewire:tables.delivery-address-table />
        @endif
    </x-baseview>
</div>
