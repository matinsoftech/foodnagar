@section('title', __('Car Makes'))

<div>
    <x-baseview title="{{ __('Car Makes') }}">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>

            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Car Make') : __('Edit Car Make') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" wire:model="name" />

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
            <livewire:tables.taxi.car-make-table />
        @endif
    </x-baseview>
</div>
