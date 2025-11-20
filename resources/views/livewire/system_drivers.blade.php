@section('title', __('Drivers'))

<div>
    <x-baseview title="{{ __('Drivers') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create Driver Account') : __('Edit Driver Account') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" placeholder="John" />
                    <div class="grid grid-cols-1 gap-0 md:gap-4 md:grid-cols-2">
                        <x-input title="{{ __('Email') }}" name="email" placeholder="info@mail.com" />
                        <x-phoneselector />
                    </div>
                    <x-input title="{{ __('Login Password') }}" name="password" type="password" placeholder="**********************" />
                    <x-input title="{{ __('Commission') }}" name="commission" placeholder="%" />
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
            <livewire:tables.system-driver-table />
        @endif
    </x-baseview>

    {{-- Details Modal --}}
    <div x-data="{ open: @entangle('showDetails') }">
        <x-modal>
            <p class="text-xl font-semibold">
                {{ $selectedModel != null ? $selectedModel->name : '' }}
                {{ __('Details') }}
            </p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-details.item title="{{ __('Name') }}" text="{{ $selectedModel->name ?? '' }}" />
                @production
                    <x-details.item title="{{ __('Phone') }}" text="{{ $selectedModel->phone ?? '' }}" />
                    <x-details.item title="{{ __('Email') }}" text="{{ $selectedModel->email ?? '' }}" />
                @else
                    <x-details.item title="{{ __('Phone') }}"
                        text="{{ Str::padLeft('', Str::of($selectedModel->phone ?? '')->length(), '*') }}" />
                    <x-details.item title="{{ __('Email') }}"
                        text="{{ Str::padLeft('', Str::of($selectedModel->email ?? '')->length(), '*') }}" />
                @endproduction

                <x-details.item title="{{ __('Referral Code') }}" text="{{ $selectedModel->code ?? '' }}" />
                <x-details.item title="{{ __('Wallet') }}"
                    text="{{ currencyFormat($selectedModel->wallet->balance ?? 0.0) }}" />
                @if (($selectedModel->role_name ?? '') == 'driver')
                    <x-details.item title="{{ __('Commission') }}%" text="{{ $selectedModel->commission ?? '' }}" />
                @endif
                <x-details.item title="{{ __('Role') }}" text="{{ $selectedModel->role_name ?? '' }}" />

                <div>
                    <x-label title="{{ __('Status') }}" />
                    <x-table.active :model="$selectedModel" />
                </div>
            </div>

            <hr class="my-4" />
            <p class="font-semibold text-sm mb-2">{{ __('Documents') }}</p>
            @if (!empty($selectedModel->documents ?? []))
                <div class="grid grid-cols-1 gap-2 pt-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($selectedModel->documents ?? [] as $document)
                        <a href="{{ $document }}" target="_blank"><img src="{{ $document }}"
                                class="object-cover border border-gray-200" /></a>
                    @endforeach
                </div>
            @endif
            <div class="my-2">
                @if ($selectedModel != null && $selectedModel->document_requested)
                    <div class="border p-2 text-center rounded text-sm space-y-2 py-4">
                        <p>{{ __('Driver has been notified to upload documents') }}</p>
                        {{-- cancel request button --}}
                        <div class="flex justify-center">
                            <x-buttons.plain wireClick="cancelDocumentRequest">
                                {{ __('Cancel Request') }}
                            </x-buttons.plain>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end w-full md:w-6/12 mx-auto">
                        <x-buttons.primary wireClick="requestDocuments">
                            {{ __('Request Documents') }}
                        </x-buttons.primary>
                    </div>
                @endif
            </div>
        </x-modal>
    </div>

</div>
{{--  @include('layouts.partials.phoneselector')  --}}
