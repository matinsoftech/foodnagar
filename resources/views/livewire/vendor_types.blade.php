@section('title', __('Modules'))

<div>
    <x-baseview title="{{ __('Modules') }}" :showNew="inProduction()">

    {{-- new form --}}
    @if ($showCreate || $showEdit)
        <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
            ← {{ __('Back') }}
        </button>

        <div class="mb-4">
            <p class="text-xl font-semibold">
                {{ $showCreate ? __('Create Module') : __('Edit Module') }}
            </p>

            <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                <x-select title="{{ __('Type') }}" :options='$types' name="slug" :defer="false" />
                {{-- {{$deliveryZones}} --}}
                @if($showCreate)
                    <x-select2 :ignore="true" title="{{ __('Delivery Zone') }}" :options="$deliveryZones ?? []" name="deliveryZonesIDs"
                        id="deliveryZonesSelect2" :multiple="true" width="100" :value="$deliveryZonesIDs ?? []" />
                @else
                    <x-select2 :ignore="true" title="{{ __('Delivery Zone') }}" :options="$deliveryZones ?? []" name="deliveryZonesIDs"
                        id="editDeliveryZonesSelect2" :multiple="true" width="100" :value="$deliveryZonesIDs ?? []" />
                @endif
                    {{-- <x-select2
                        title="{{ __('Delivery Zone') }}"
                        :options="$deliveryZones ?? []"
                        name="deliveryZonesIDs"
                        id="deliveryZonesSelect2"
                        :multiple="true"
                        width="100"
                        wire:model="deliveryZonesIDs"
                        :value="$selectedModel && $selectedModel->deliveryZones
                            ? $selectedModel->deliveryZones->pluck('id')->toArray()
                            : []"
                    /> --}}
                    


                    <x-input title="{{ __('Name') }}" name="name" />
                <x-input title="{{ __('Color') }}" name="color" type="color" class="h-10" />
                <x-input title="{{ __('Description') }}" name="description" />

                <x-media-upload title="{{ __('Logo') }}" name="photo" preview="{{ $selectedModel->logo ?? '' }}"
                    :photo="$photo" :photoInfo="$photoInfo" types="PNG or JPEG" rules="image/*" />
                <x-media-upload title="{{ __('Website Header image') }}" name="secondPhoto"
                    preview="{{ $selectedModel->website_header ?? '' }}" :photo="$secondPhoto" :photoInfo="$secondPhotoInfo"
                    types="PNG or JPEG" rules="image/*" />

                <x-checkbox title="{{ __('Active') }}" name="isActive" :defer="false" />
                <x-form-errors />

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                        {{ $showCreate ? __('Save') : __('Update') }}
                    </button>
                    <button type="button" wire:click="goBack"
                        class="ml-2 px-4 py-2 bg-red-500 text-white rounded">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </form>
        </div>
    @else
        <livewire:tables.vendor-type-table />
    @endif
</x-baseview>
</div>
