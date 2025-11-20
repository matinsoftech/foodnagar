@section('title', __('Pricing'))

<div>
    <x-baseview title="{{ __('Pricing') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Pricing') : __('Edit Pricing') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-select title="{{ __('Vehicle Type') }}" :options='$vehicleTypes' name="vehicle_type_id" :defer="true" />
                    <x-select title="{{ __('Currency') }}" :options='$currencies' name="currency_id" :defer="true" />

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-input title="{{ __('Base Fare') }}" name="base_fare" />
                        <x-input title="{{ __('Distance Fare') }}(/km)" name="distance_fare" />
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-input title="{{ __('Fare Per Minute') }}" name="time_fare" />
                        <x-input title="{{ __('Minimum Fare') }}" name="min_fare" />
                    </div>

                    <x-checkbox title="{{ __('Active') }}" name="is_active" />

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
            <livewire:tables.taxi.pricing-table />
        @endif
    </x-baseview>
</div>
