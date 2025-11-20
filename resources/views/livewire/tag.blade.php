@section('title', __('Tags'))
<div>
    <x-baseview title="{{ __('Tags') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Tag') : __('Edit Tag') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <!-- Name Input -->
                    <x-input title="{{ __('Name') }}" name="name" placeholder="Enter Tag Name" />

                    <!-- Type Select -->
                    <x-select title="{{ __('Type') }}" :options="$types" name="vendor_type_id" :defer="false" noPreSelect="true" />

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
            <livewire:tables.tag-table />
        @endif
    </x-baseview>
</div>
