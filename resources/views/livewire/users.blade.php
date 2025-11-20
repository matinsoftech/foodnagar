@section('title', __('Users'))

<div>
    <x-baseview title="{{ __('Users') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create User Account') : __('Edit User Account') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <x-input title="{{ __('Name') }}" name="name" placeholder="John" :value="$name" />
                    <div class="grid grid-cols-1 gap-0 md:gap-4 md:grid-cols-2">
                        <x-input title="{{ __('Email') }}" name="email" placeholder="info@mail.com"
                            :value="$email" />
                        <x-phoneselector :value="$phone" />
                    </div>
                    <x-input title="{{ __('Login Password') }}" name="password" type="password"
                        placeholder="**********************" :value="$password" />
                    <x-select title="{{ __('Role') }}" :options="$roles" name="role" :value="$role"
                        :defer="false" />

                    @if ($role == 'driver')
                        <x-input title="{{ __('Commission') }}" name="commission" :value="$commission" />
                    @endif

                    <hr class="my-4" />

                    <p>
                        {{ __('You can manage user wallet balance from the wallet transaction page') }}:
                        <a href="{{ route('wallet.transactions') }}" class="underline text-primary-500">
                            {{ __('Wallet Transactions') }}
                        </a>
                    </p>

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
            <livewire:tables.user-table />
        @endif
    </x-baseview>
    {{-- details modal --}}
    <div x-data="{ open: @entangle('showDetails') }">
        <x-modal>

            <p class="text-xl font-semibold">
                {{ $selectedModel != null ? $selectedModel->name : '' }}
                {{ __('Details') }}</p>
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
                <x-details.item title="{{ __('Role') }}">
                    @php
                        $roles = $selectedModel->roles ?? [];
                        $roleCollection = collect($roles);
                        $roleNames = $roleCollection
                            ->map(function ($role) {
                                return $role->name ?? '';
                            })
                            ->toArray();
                        $roleNames = implode(', ', $roleNames);
                    @endphp
                    <x-details.p text="{{ $roleNames ?? '' }}" />
                </x-details.item>

                <div>
                    <x-label title="{{ __('Status') }}" />
                    <x-table.active :model="$selectedModel" />
                </div>
            </div>

            <hr class="my-4" />
            <p class="font-light">{{ __('Documents') }}</p>
            <div class="grid grid-cols-1 gap-2 pt-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($selectedModel->documents ?? [] as $document)
                    <a href="{{ $document }}" target="_blank"><img src="{{ $document }}"
                            class="object-cover border border-gray-200" /></a>
                @endforeach
            </div>

            @if (setting('qrcodeLogin', false))
                @production
                    <hr class="my-4" />
                    <p class="font-light">{{ __('Scan to login') }}</p>
                    <p class="text-xs font-thin">{{ __('Only works with mobile apps') }}</p>
                    <div class="items-center justify-center text-center">
                        <div class="w-56 h-56 mx-auto">
                            @if ($selectedModel != null && ($showDetails ?? false))
                                <img src="{{ (new \chillerlan\QRCode\QRCode())->render($selectedModel->qrcodeLogin ?? '') }}"
                                    alt="{{ __('QR Code Login') }}" class="mx-auto" />
                            @endif
                        </div>
                    </div>
                @endproduction
            @endif

        </x-modal>
    </div>
</div>
