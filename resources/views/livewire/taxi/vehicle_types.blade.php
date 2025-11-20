@section('title', __('Vehicle Types'))

<div>
    <x-baseview title="{{ __('Vehicle Types') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Vehicle Type') : __('Edit Vehicle Type') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" :value="$selectedModel->name ?? ''" />
                    <x-input title="{{ __('Base Fare') }}" name="base_fare" :value="$selectedModel->base_fare ?? ''" />
                    <x-input title="{{ __('Distance Fare') }}(/km)" name="distance_fare" :value="$selectedModel->distance_fare ?? ''" />
                    <x-input title="{{ __('Fare Per Minutes') }}" name="time_fare" :value="$selectedModel->time_fare ?? ''" />
                    <x-input title="{{ __('Minimum Fare') }}" name="min_fare" :value="$selectedModel->min_fare ?? ''" />
                    <x-media-upload title="{{ __('Logo') }}" name="photo" preview="{{ $selectedModel->logo ?? '' }}" :photo="$photo"
                        :photoInfo="$photoInfo" types="PNG or JPEG" rules="image/*" />
                    <x-checkbox title="{{ __('Active') }}" name="is_active" :checked="$selectedModel->is_active ?? false" />

                    <x-form-errors />

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
            <livewire:tables.taxi.vehicle-type-table />
        @endif
    </x-baseview>
</div>
