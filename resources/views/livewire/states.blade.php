@section('title', __('States'))
<div>
    <x-baseview title="{{ __('States') }}" showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create State') : __('Edit State') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <!-- Country Select -->
                    <x-select title="{{ __('Country') }}" :options="$countries" name="country_id" :defer="false" />

                    <!-- Name Input -->
                    <x-input title="{{ __('Name') }}" name="name" placeholder="Enter State Name" />

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
            <livewire:tables.state-table />
        @endif
    </x-baseview>


</div>
