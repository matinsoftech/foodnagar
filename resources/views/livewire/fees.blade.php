@section('title', __('Fees'))
<div>

    <x-baseview title="{{ __('Fees') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Fee') : __('Edit Fee') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" />
                    <x-input title="{{ __('Value') }}" name="value" />

                    <div class="grid gap-4 md:grid-cols-2">
                        <x-checkbox title="{{ __('For Admin') }}" name="for_admin" :defer="false" />
                        <x-checkbox title="{{ __('Is Percentage?') }}" name="percentage" :defer="false" />
                        <x-checkbox title="{{ __('Active') }}" name="is_active" :defer="false" />
                    </div>

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
            <livewire:tables.fee-table />
        @endif
    </x-baseview>

</div>
