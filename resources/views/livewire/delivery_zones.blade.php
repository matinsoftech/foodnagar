@section('title', __('Delivery Zones'))
<div>

    <button
        class="flex items-center p-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 border border-transparent rounded-lg bg-primary-600 active:bg-red-600 hover:bg-primary-700 focus:outline-none focus:shadow-outline-red float-right"
        wire:click="$emitUp('showCreateModal')">
        <x-heroicon-o-plus class="w-5 h-5 mr-1" />
        @empty($title)
            {{ __('New') }}
        @else
            {{ $title }}
        @endempty
    </button>
    <x-baseview title="{{ __('Delivery Zones') }}" ::showNew="inProduction()">

        <livewire:tables.delivery-zone-table />
    </x-baseview>


    {{-- new form --}}
    <div x-data="{ open: @entangle('showCreate') }">
        <x-modal-lg confirmText="{{ __('Save') }}" action="save" :clickAway="false">
            <p class="text-xl font-semibold">{{ __('New Delivery Zone') }}</p>
            <x-input title="{{ __('Name') }}" name="name" placeholder="" />
            {{-- <x-input title="{{ __('Delivery Fee') }}" name="delivery_fee"
                hint="{{ __('Leave empty if you do not want to set delivery fee') }}" /> --}}
                <div class="mt-4">
                    <p class="font-semibold mb-2">{{ __('Delivery Fee Type') }}</p>

                    {{-- Base Delivery Fee --}}
                    <label class="flex items-center space-x-2">
                        <input type="radio" 
                            wire:model="delivery_fee_type" 
                            value="base" 
                            id="delivery_fee_base">
                        <span>{{ __('Base Delivery Fee (₹40)') }}</span>
                    </label>

                    {{-- Tiered Delivery Fee --}}
                    <label class="flex items-center space-x-2">
                        <input type="radio" 
                            wire:model="delivery_fee_type" 
                            value="tiered" 
                            id="delivery_fee_tiered">
                        <span>{{ __('Apply Tiered Delivery Fee') }}</span>
                    </label>

                    {{-- Tiered Rules (stay in DOM, use x-show) --}}
                    <div x-data x-show="$wire.delivery_fee_type === 'tiered'" class="ml-6 mt-2 text-sm text-gray-600">
                        <p>Below ₹100 = ₹40</p>
                        <p>₹101 - ₹200 = ₹20</p>
                        <p>Above ₹300 = ₹0</p>
                    </div>
                </div>


            <div wire:ignore id="map" class="my-4 h-72"></div>
            <x-textarea title="{{ __('Coordinates') }}" name="coordinates" placeholder="" disable="true" />
            <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />
        </x-modal-lg>
    </div>

    {{-- edit form --}}
    <div x-data="{ open: @entangle('showEdit') }">
        <x-modal-lg confirmText="{{ __('Save') }}" action="update" :clickAway="false">
            <p class="text-xl font-semibold">{{ __('Update Delivery Zone') }}</p>
            <x-input title="{{ __('Name') }}" name="name" placeholder="" />
            {{-- <x-input title="{{ __('Delivery Fee') }}" name="delivery_fee"
                hint="{{ __('Leave empty if you do not want to set delivery fee') }}" /> --}}
            {{-- Delivery Fee Type --}}
            <div class="mt-4">
                <p class="font-semibold mb-2">{{ __('Delivery Fee Type') }}</p>

                {{-- Base Delivery Fee --}}
                <label class="flex items-center space-x-2">
                    <input type="radio"
                        wire:model="delivery_fee_type"
                        value="base"
                        id="edit_delivery_fee_base">
                    <span>{{ __('Base Delivery Fee (₹40)') }}</span>
                </label>

                {{-- Tiered Delivery Fee --}}
                <label class="flex items-center space-x-2">
                    <input type="radio"
                        wire:model="delivery_fee_type"
                        value="tiered"
                        id="edit_delivery_fee_tiered">
                    <span>{{ __('Apply Tiered Delivery Fee') }}</span>
                </label>

                {{-- Tiered Rules Display --}}
                <div x-data x-show="$wire.delivery_fee_type === 'tiered'" class="ml-6 mt-2 text-sm text-gray-600">
                    <p>Below ₹100 = ₹40</p>
                    <p>₹101 - ₹200 = ₹20</p>
                    <p>Above ₹300 = ₹0</p>
                </div>
            </div>
            <div wire:ignore id="editMap" class="my-4 h-72"></div>
            <x-textarea title="{{ __('Coordinates') }}" name="coordinates" placeholder="" disable="true" />
            <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />
        </x-modal-lg>
    </div>


</div>


@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ setting('googleMapKey', '') }}&callback=initMap&libraries=drawing&v=weekly"
        async></script>
    <script src="{{ asset('js/delivery-zone.js') }}"></script>
@endpush
