@section('title', __('SubCategories'))
<div>
    <x-baseview title="{{ __('SubCategories') }}" :showNew="true">
        @if ($showCreate || $showEdit)
            <button type="button" wire:click="goBack" class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                ← {{ __('Back') }}
            </button>
            <div class="mb-4">
                <p class="text-xl font-semibold">
                    {{ $showCreate ? __('Create SubCategory') : __('Edit SubCategory') }}
                </p>

                <form wire:submit.prevent="{{ $showCreate ? 'save' : 'update' }}">
                    <!-- Name Input -->
                    <x-input title="{{ __('Name') }}" name="name" placeholder="Vegetables" />

                    <!-- Category Select -->
                    <x-select title="{{ __('Category') }}" :options="$categories ?? []" name="category_id" :noPreSelect="true" />

                    <!-- Photo Upload -->
                    <x-media-upload title="{{ __('Photo') }}" name="photo" :photo="$photo" :photoInfo="$photoInfo" types="PNG or JPEG" rules="image/*" />

                    <!-- Active Checkbox -->
                    <x-checkbox title="{{ __('Active') }}" name="isActive" :defer="false" />

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
            <livewire:tables.sub-category-table />
        @endif
    </x-baseview>
</div>
