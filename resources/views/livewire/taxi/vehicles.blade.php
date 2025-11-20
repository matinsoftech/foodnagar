@section('title', __('Vehicles'))

<div>
    <x-baseview title="{{ __('Vehicles') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Vehicle') : __('Edit Vehicle') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Registration Number') }}" name="reg_no" />
                    <x-input title="{{ __('Color') }}" name="color" />

                    <x-select title="{{ __('Vehicle Type') }}" :options='$vehicleTypes' name="vehicle_type_id"
                        :defer="true" />

                    <div>
                        <livewire:component.autocomplete-input title="{{ __('Driver') }}"
                            placeholder="{{ __('Search for driver') }}" column="name" model="User"
                            customQuery="driver" emitFunction="autocompleteDriverSelected" />
                        <x-input-error message="{{ $errors->first('driver_id') }}" />
                    </div>

                    <div>
                        <livewire:component.autocomplete-input title="{{ __('Car Make') }}" column="name"
                            model="CarMake" emitFunction="autocompleteCategorySelected" />
                        <x-input-error message="{{ $errors->first('car_make_id') }}" />
                    </div>

                    <div>
                        <livewire:component.autocomplete-input title="{{ __('Car Model') }}" column="name"
                            model="CarModel" emitFunction="autocompleteCarModelSelected" />
                        <x-input-error message="{{ $errors->first('car_model_id') }}" />
                    </div>

                    <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />
                    <x-checkbox title="{{ __('Featured') }}" name="featured"
                        description="{{ __('Can be featured on the homepage') }}" />

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
            <livewire:tables.taxi.vehicle-table />
        @endif
    </x-baseview>
</div>
