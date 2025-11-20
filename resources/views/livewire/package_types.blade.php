@section('title', __('Package Types'))
<div>
    <x-baseview title="{{ __('Package Types') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Package Type') : __('Edit Package Type') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <!-- Name Input -->
                    <x-input title="{{ __('Name') }}" name="name" placeholder="Enter Package Type Name" />

                    <!-- Description Input -->
                    <x-input title="{{ __('Description') }}" name="description" placeholder="Enter Description" />

                    <!-- Driver Verify Stops Checkbox -->
                    <x-checkbox title="{{ __('Driver must verify all stops') }}" name="driver_verify_stops" :defer="true" />

                    <!-- Photo Upload -->
                    <x-media-upload title="{{ __('Photo') }}" name="photo" :photo="$photo" :photoInfo="$photoInfo" types="PNG or JPEG" rules="image/*" />

                    <!-- Active Checkbox -->
                    <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="true" />

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
            <livewire:tables.package-type-table />
        @endif
    </x-baseview>


</div>
