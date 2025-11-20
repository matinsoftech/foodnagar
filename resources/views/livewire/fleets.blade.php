@section('title', __('Fleets'))

<div>
    <x-baseview title="{{ __('Fleets') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Fleet') : __('Edit Fleet') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" wire:model="name" placeholder="" />
                    <x-input title="{{ __('Email') }}" name="email" wire:model="email" placeholder="info@mail.com" />
                    <x-input title="{{ __('Phone') }}" name="phone" wire:model="phone" placeholder="" />
                    <x-input title="{{ __('Address') }}" name="address" wire:model="address" placeholder="" />

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
            <livewire:tables.fleet-table />
        @endif
    </x-baseview>



</div>
