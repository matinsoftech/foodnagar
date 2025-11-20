@section('title', __('Car Models'))

<div>
    <x-baseview title="{{ __('Car Models') }}" :showNew="inProduction()">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Car Model') : __('Edit Car Model') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Car Model Name') }}" name="name" />

                    {{-- Car Make --}}
                    <livewire:component.autocomplete-input
                        title="{{ __('Car Make') }}"
                        column="name"
                        model="CarMake"
                        emitFunction="autocompleteVendorSelected"
                        onclearCalled="clearAutocompleteFieldsEvent"
                    />

                    <hr class="my-2">

                    <x-checkbox title="{{ __('Active') }}" name="isActive" />
                    <x-checkbox title="{{ __('Featured') }}" description="{{ __('Can be featured on the home screen of the customer app') }}" name="featured" />

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
            <livewire:tables.taxi.car-model-table />
        @endif
    </x-baseview>
</div>
