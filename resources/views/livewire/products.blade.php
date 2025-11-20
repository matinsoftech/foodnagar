@section('title', __('Products'))
@push('styles')
    <style>
        .btn {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
            border: none;
        }

        .btn-danger {
            background-color: #e53e3e;
            color: white;
        }

        .btn-success {
            background-color: #38a169;
            color: white;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
@endpush
<div>

    <x-baseview title="{{ __('Products') }}" :showNew="true">
        @if (!$showCreate && !$showEdit && !$showDetails)
            <livewire:tables.product-table />
        @endif
    </x-baseview>

    @if ($showCreate)
        {{-- new form --}}
        <div>
            <x-form confirmText="{{ __('Save') }}" action="save">
                {{-- <button type="button" wire:click="$emitUp('dismissModal'); $set('showAssign', false)"
                    class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                    ← {{ __('Back') }}
                </button> --}}
                {{-- show all errors --}}
                <x-form-errors />
                <div class="container mx-auto">
                    {{-- <p class="text-2xl font-semibold">{{ __('Create Product') }}</p> --}}

                    <div class="grid gap-2" style="grid-template-columns: 60% 40%">
                        <!-- Main Content (Left Side) -->
                        <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="vendorType" class="block font-semibold">Vendor Type <span
                                            class="text-danger">*</span></label>
                                    <select id="vendorType" class="w-full border p-2 rounded"
                                        wire:model="vendor_type_id" required>
                                        <option value="">Select Vendor Type</option>
                                        @foreach ($vendorTypes as $vendorType)
                                            <option value="{{ $vendorType->id }}">{{ $vendorType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="vendor" class="block font-semibold">Vendor <span
                                            class="text-danger">*</span></label>
                                    <select id="vendor" class="w-full border p-2 rounded" wire:model="vendor_id"
                                        required>
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="productName" class="block font-semibold">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="productName" placeholder="Enter product name"
                                    class="w-full border p-2 rounded" wire:model.defer="name" required>
                            </div>

                            <div class="mb-4">
                                <label class="block font-semibold">Product Description</label>
                                <hr class="my-2">
                                <textarea id="summernote" class="w-full border p-2 rounded h-32" wire:model.defer='description'></textarea>
                            </div>


                            <div>
                                <label for="orderNumber" class="block font-semibold">Order Number</label>
                                <input type="number" id="orderNumber" class="w-full border p-2 rounded"
                                    wire:model.defer="in_order">
                            </div>
                            @if ($classified_visible == true)
                                <div>
                                    <label for="address" class="block font-semibold"> {{ __('Address') }} </label>
                                    <input type="text" wire:model="address" id="address"
                                        class="block w-full px-2 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter" />
                                </div>

                                <div class="grid grid-cols-12 gap-4">
                                    <label for="ad_type" class="block font-semibold"> {{ __('Ad Type') }} </label>
                                    <select wire:model="ad_type" id="ad_type"
                                        class="block w-full px-2 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter">
                                        <option value="Buy">Buy</option>
                                        <option value="Sell">Sell</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>
                            @endif
                            {{-- <div class="mb-4">
                            <label for="selectedAmenities" class="block font-semibold">Amenities</label>
                            <select id="selectedAmenities" wire:model="selectedAmenities"
                                class="w-full border p-2 rounded">
                                @foreach ($amenities as $amenity)
                                <option value="{{ $amenity['id'] }}">{{ $amenity['name'] }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                            <div class="mb-4">
                                <label for="brand_id" class="block font-semibold">Brand</label>
                                <select id="brand_id" class="w-full border p-2 rounded" wire:model="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="sku" class="block font-semibold">SKU</label>
                                    <input type="text" id="sku" class="w-full border p-2 rounded"
                                        wire:model.defer="sku">
                                </div>
                                <div>
                                    <label for="barcode" class="block font-semibold">Barcode</label>
                                    <input type="text" id="barcode" class="w-full border p-2 rounded"
                                        wire:model.defer="barcode">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 my-4">
                                @if (!$variant_price_enabled)
                                <div>
                                    <label for="product_price" class="block font-semibold">Price <span
                                            class="text-danger">*</span></label>
                                    <input type="number" id="product_price" class="w-full border p-2 rounded"
                                        wire:model.defer="price" required>
                                </div>
                                @endif
                                <div>
                                    <label for="discount_price" class="block font-semibold">Discount Price</label>
                                    <input type="number" id="discount_price" class="w-full border p-2 rounded"
                                        wire:model.defer="discount_price">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="capacity" class="block font-semibold">Capacity</label>
                                    <input type="number" id="capacity" class="w-full border p-2 rounded"
                                        placeholder="e.g. 15" wire:model.defer="capacity">
                                </div>
                                <div>
                                    <label for="unit" class="block font-semibold">Unit</label>
                                    <input type="text" id="unit" class="w-full border p-2 rounded"
                                        placeholder="Enter the unit of product" wire:model.defer="unit">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="capacity" class="block font-semibold">Package Count</label>
                                    <input type="number" id="capacity" class="w-full border p-2 rounded"
                                        placeholder="Number of iteams per package. Eg. 6,12"
                                        wire:model.defer="package_count">
                                </div>
                                <div>
                                    <label for="unit" class="block font-semibold">Available Quanity</label>
                                    <input type="number" id="unit" class="w-full border p-2 rounded"
                                        placeholder="Number of iteam available quantity"
                                        wire:model.defer="available_qty">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-4 mb-4">
                                <div>
                                    <div x-data="subscriptionForm()">
                                        <label for="subscription" class="block font-semibold">Can be
                                            Subscribed</label>
                                        <div x-data="{ subscription: @entangle('subscription') }">
                                            <label>
                                                <input type="radio" value="no" x-model="subscription"> No
                                            </label>
                                            <label class="ml-4">
                                                <input type="radio" value="yes" x-model="subscription"> Yes
                                            </label>
                                        </div>

                                        @if ($subscription === 'yes')
                                            <div class="mt-4 border p-4 rounded space-y-4">
                                                @foreach ($periods as $index => $period)
                                                    <div class="row"
                                                        style="display: flex; gap: 1em; align-items: center;">
                                                        <div class="col-md-3">
                                                            <label>Package Name</label>
                                                            <input class="w-full border p-2 rounded" type="text"
                                                                wire:model.defer="periods.{{ $index }}.package_name"
                                                                @if ($index !== 0)  @endif />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>From</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.startDay"
                                                                @if ($index !== 0) readonly @endif />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>To</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.endDay"
                                                                wire:change="updateNextStart({{ $index }})" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Price</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.price" />
                                                        </div>
                                                        <div class="flex space-x-2 col-md-4">
                                                            <button class="btn btn-danger" type="button"
                                                                wire:click.prevent="removePeriod({{ $index }})"
                                                                @if (count($periods) === 1) disabled @endif>-</button>
                                                            <button class="btn btn-success" type="button"
                                                                wire:click.prevent="addPeriod({{ $index }})">+</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <div class="mt-4">
                                @foreach ($customFields as $customField)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium">{{ $customField->name }}</label>

                                        {{-- Render field based on its type --}}
                                        @if ($customField->type == 'textbox')
                                            <input type="text"
                                                wire:model="customFieldValues.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'number')
                                            <input type="number"
                                                wire:model="customFieldValues.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'textarea')
                                            <textarea wire:model="customFieldValues.{{ $customField->id }}" class="block w-full px-2 border rounded"></textarea>
                                        @elseif($customField->type == 'fileinput')
                                            <input type="file"
                                                wire:model="customFieldFiles.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'radio')
                                            @if ($customField->values)
                                                @foreach ($customField->values as $value)
                                                    <label class="inline-flex items-center">
                                                        <input type="radio"
                                                            wire:model="customFieldValues.{{ $customField->id }}"
                                                            name="{{ $customField->id }}"
                                                            value="{{ $value }}" class="form-radio">
                                                        <span class="ml-2">{{ $value }}</span>
                                                    </label>
                                                @endforeach
                                            @endif
                                        @elseif($customField->type == 'checkbox')
                                            @if ($customField->values)
                                                @foreach ($customField->values as $value)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox"
                                                            wire:model="customFieldValues.{{ $customField->id }}.{{ $value }}"
                                                            class="form-checkbox">
                                                        <span class="ml-2">{{ $value }}</span>
                                                    </label>
                                                @endforeach
                                            @endif
                                        @elseif($customField->type == 'dropdown')
                                            @if ($customField->values)
                                                <select wire:model="customFieldValues.{{ $customField->id }}"
                                                    class="block w-full px-2 border rounded">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($customField->values as $value)
                                                        <option value="{{ $value }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if (!$digital ?? false)
                                <hr class="my-4" />
                                <div class="border p-4 rounded-sm my-4">
                                    <p class="font-semibold">{{ __('Variations/Option Groups') }}</p>
                                    <div class="space-y-2 mt-4">
                                        @foreach ($optionGroups ?? [] as $key => $optionGroup)
                                            <div class="border rounded-sm p-4 m-2">
                                                {{-- name --}}
                                                <x-input title="{{ __('Name') }}"
                                                    name="optionGroups.{{ $key }}.name" />
                                                <div class="gap-4 grid grid-cols-2">
                                                    <x-checkbox title="{{ __('Required') }}"
                                                        name="optionGroups.{{ $key }}.required" />
                                                    <x-checkbox title="{{ __('Multiple') }}"
                                                        name="optionGroups.{{ $key }}.multiple"
                                                        :defer="false" />
                                                </div>
                                                {{-- if multiple is true --}}
                                                @if ($optionGroup['multiple'] ?? false)
                                                    <x-input title="{{ __('Max Options') }}"
                                                        name="optionGroups.{{ $key }}.max_options" />
                                                @endif
                                                {{-- options --}}
                                                <div>
                                                    <table class="table w-full">
                                                        <tbody>
                                                            @foreach ($optionGroup['options'] ?? [] as $optionKey => $optionGroupOption)
                                                                <tr>
                                                                    <td>
                                                                        <x-input title="{{ __('Name') }}"
                                                                            name="optionGroups.{{ $key }}.options.{{ $optionKey }}.name" />
                                                                    </td>
                                                                    <td class="px-4">
                                                                        <x-input title="{{ __('Price') }}"
                                                                            name="optionGroups.{{ $key }}.options.{{ $optionKey }}.price" />
                                                                    </td>
                                                                    <td class="my-auto">
                                                                        <x-buttons.plain bgColor="my-auto bg-red-500"
                                                                            wireClick="removeOption('{{ $optionKey }}', '{{ $key }}')">
                                                                            <x-heroicon-o-trash class="w-5 h-5" />
                                                                        </x-buttons.plain>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <x-buttons.primary title="{{ __('Add Option') }}"
                                                        wireClick="newOption('{{ $key }}')"
                                                        type="button" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- add button --}}
                                    <x-buttons.primary title="{{ __('Add Option Group') }}"
                                        wireClick="newOptionGroup" type="button" />
                                </div>
                                <hr class="my-4" />
                            @endif

                            {{-- Variant Pricing --}}
                            <hr class="my-4" />
                            <div class="border p-4 rounded-sm my-4">
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="variant_price_enabled" id="variantCheck">
                                    <label for="variantCheck"
                                        class="font-semibold">{{ __('Enable Variant Pricing') }}</label>
                                </div>

                                @if ($variant_price_enabled)
                                    <div class="mt-4 space-y-3">
                                        @foreach ($variantPrices as $index => $variant)
                                            <div class="grid grid-cols-2 gap-4 items-end border p-3 rounded">
                                                <div>
                                                    <label class="block text-sm font-semibold">Variant</label>
                                                    <input type="text"
                                                        wire:model.defer="variantPrices.{{ $index }}.name"
                                                        class="w-full border p-2 rounded"
                                                        placeholder="e.g. Small / Large" />
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold">Price</label>
                                                    <input type="number"
                                                        wire:model.defer="variantPrices.{{ $index }}.price"
                                                        class="w-full border p-2 rounded" />
                                                </div>
                                                <div class="col-span-2 flex justify-end">
                                                    <button type="button"
                                                        wire:click="removeVariant({{ $index }})"
                                                        class="px-3 py-1 bg-red-500 text-white rounded">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" wire:click="addVariant"
                                            class="px-4 py-2 bg-green-500 text-white rounded">
                                            + Add Variant
                                        </button>
                                    </div>
                                @endif
                            </div>

                            {{-- Variant Pricing end --}}

                        </div>

                        <!-- Sidebar (Right Side) -->
                        <div class="lg:w-full md:w-full w-full">
                            <!-- Product Image Section -->
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div class="flex justify-between items-center p-4 cursor-pointer border-b"
                                    data-target="productImageContent">
                                    <h5 class="font-semibold">Product Image</h5>
                                    <div>
                                        <x-heroicon-o-chevron-up class="w-5 h-5" />
                                        <x-heroicon-o-chevron-down class="w-5 h-5 hidden" />
                                    </div>
                                </div>
                                <div class="p-4" id="productImageContent">
                                    <x-input.filepond wire:model="photos" title="{{ __('Photo(s)') }}"
                                        acceptedFileTypes="['image/png', 'image/jpeg', 'image/jpg']"
                                        allowImagePreview="true" imagePreviewMaxHeight="80" grid="3"
                                        multiple="true" allowFileSizeValidation="true"
                                        maxFileSize="{{ setting('filelimit.product_image_size', 200) }}kb" />
                                    <x-input-error message="{{ $errors->first('photos') }}" />

                                </div>
                            </div>

                            <!-- Categories Section -->
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div class="flex justify-between items-center p-4 cursor-pointer border-b"
                                    data-target="categoriesContent">
                                    <h5 class="font-semibold">Categories</h5>
                                    <div>
                                        <x-heroicon-o-chevron-up class="w-5 h-5" />
                                        <x-heroicon-o-chevron-down class="w-5 h-5 hidden" />
                                        {{-- <i class="fa-solid fa-angle-up mr-2 toggle-icon-up"></i>
                                    <i class="fa-solid fa-angle-down toggle-icon-down hidden"></i> --}}
                                    </div>
                                </div>
                                <div class="p-4" id="categoriesContent"
                                    style="max-height: 300px; overflow-y: scroll;">
                                    {{-- {{$categoryoptions}} --}}
                                    @foreach ($categoryoptions as $item)
                                        <ul>
                                            <li>
                                                <div class="flex items-center">
                                                    <input type="checkbox" class="mr-2"
                                                        wire:model.defer='categories' value="{{ $item->id }}">
                                                    <span>{{ $item->name }}</span>
                                                </div>
                                                @if ($item->sub_categories)
                                                    @foreach ($item->sub_categories as $sub_category)
                                                        <ul style="margin-left: 2rem">
                                                            <li>
                                                                <div class="flex items-center">
                                                                    <input type="checkbox" class="mr-2"
                                                                        wire:model.defer='sub_categories'
                                                                        value="{{ $sub_category->id }}">
                                                                    <span>{{ $sub_category->name }}</span>
                                                                </div>
                                                                @if ($sub_category->sub_sub_categories)
                                                                    @foreach ($sub_category->sub_sub_categories as $sub_sub_category)
                                                                        <ul style="margin-left: 2.5rem">
                                                                            <li>
                                                                                <div class="flex items-center">
                                                                                    <input type="checkbox"
                                                                                        class="mr-2"
                                                                                        wire:model.defer='sub_sub_categories'
                                                                                        value="{{ $sub_sub_category->id }}">
                                                                                    <span>{{ $sub_sub_category->name }}</span>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                @endif
                                                            </li>

                                                        </ul>
                                                    @endforeach
                                                @endif
                                            </li>

                                        </ul>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Additional Options -->
                            <div class="bg-white shadow-lg rounded-lg">
                                <div class="p-4 border-b">
                                    <h5 class="font-semibold">Additional Options</h5>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="moreOptionCheck"
                                                    wire:model="plus_option">
                                                <label for="moreOptionCheck">
                                                    <span class="font-semibold">More Option</span>
                                                    <small class="block text-gray-500">Option price should be added to
                                                        product price</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="ageRestrictionCheck"
                                                    wire:model.defer="age_restricted">
                                                <label for="ageRestrictionCheck">
                                                    <span class="font-semibold">Age Restriction</span>
                                                    <small class="block text-gray-500">Customers will be informed they
                                                        must
                                                        be of legal age</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="faqCheck"
                                                    wire:model.defer="faq_visible">
                                                <label for="faqCheck">
                                                    <span class="font-semibold">Question And Answers (FAQ)</span>
                                                    <small class="block text-gray-500">FAQ</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="faqCheck"
                                                    wire:model="isActive">
                                                <label for="faqCheck">
                                                    <span class="font-semibold">Active</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="deliverableCheck"
                                                    wire:model.defer='deliverable'>
                                                <label for="deliverableCheck">
                                                    <span class="font-semibold">Can be Delivered</span>
                                                    <small class="block text-gray-500">If product can be delivered to
                                                        customers</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="commentableCheck"
                                                    wire:model.defer='commentable'>
                                                <label for="commentableCheck">
                                                    <span class="font-semibold">Commentable</span>
                                                    <small class="block text-gray-500">Commentable</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="digitalCheck"
                                                    wire:model="digital">
                                                <label for="digitalCheck">
                                                    <span class="font-semibold">Digital</span>
                                                    <small class="block text-gray-500">If product is digital and can be
                                                        downloaded</small>
                                                    @if ($digital)
                                                        <x-input.filepond wire:model="digitalFile"
                                                            allowImagePreview="false" allowFileSizeValidation="true"
                                                            maxFileSize="{{ setting('filelimit.max_product_digital_files_size', 2) }}mb" />
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <x-buttons.primary>Save</x-buttons.primary>
            </x-form>
        </div>
    @endif

    @if ($showEdit)
        {{-- update form --}}
        <div>
            <x-form confirmText="{{ __('Update') }}" action="update">
                <button type="button" wire:click="$emitUp('dismissModal'); $set('showAssign', false)"
                    class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                    ← {{ __('Back') }}
                </button>
                {{-- show all errors --}}
                <x-form-errors />
                <div class="container mx-auto">
                    {{-- <p class="text-2xl font-semibold">{{ __('Create Product') }}</p> --}}

                    <div class="grid gap-2" style="grid-template-columns: 60% 40%">
                        <!-- Main Content (Left Side) -->
                        <div class="md:col-span-2 bg-white shadow-lg rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="vendorType" class="block font-semibold">Vendor Type</label>
                                    <select id="vendorType" class="w-full border p-2 rounded"
                                        wire:model="vendor_type_id">
                                        <option value="">Select Vendor Type</option>
                                        @foreach ($vendorTypes as $vendorType)
                                            <option value="{{ $vendorType->id }}">{{ $vendorType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="vendor" class="block font-semibold">Vendor</label>
                                    <select id="vendor" class="w-full border p-2 rounded" wire:model="vendor_id">
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="productName" class="block font-semibold">Product Name</label>
                                <input type="text" id="productName" placeholder="Enter product name"
                                    class="w-full border p-2 rounded" wire:model.defer="name">
                            </div>

                            <div class="mb-4">
                                <label class="block font-semibold">Product Description</label>
                                <hr class="my-2">
                                <textarea id="summernote" class="w-full border p-2 rounded h-32" wire:model.defer='description'></textarea>
                            </div>


                            <div>
                                <label for="orderNumber" class="block font-semibold">Order Number</label>
                                <input type="number" id="orderNumber" class="w-full border p-2 rounded"
                                    wire:model.defer="in_order">
                            </div>
                            @if ($classified_visible == true)
                                <div>
                                    <label for="address" class="block font-semibold"> {{ __('Address') }} </label>
                                    <input type="text" wire:model="address" id="address"
                                        class="block w-full px-2 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter" />
                                </div>

                                <div class="grid grid-cols-12 gap-4">
                                    <label for="ad_type" class="block font-semibold"> {{ __('Ad Type') }} </label>
                                    <select wire:model="ad_type" id="ad_type"
                                        class="block w-full px-2 border rounded appearance-none bg-grey-lighter text-grey-darker border-grey-lighter">
                                        <option value="Buy">Buy</option>
                                        <option value="Sell">Sell</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>
                            @endif
                            {{-- <div class="mb-4">
                            <label for="selectedAmenities" class="block font-semibold">Amenities</label>
                            <select id="selectedAmenities" wire:model="selectedAmenities"
                                class="w-full border p-2 rounded">
                                @foreach ($amenities as $amenity)
                                <option value="{{ $amenity['id'] }}">{{ $amenity['name'] }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                            <div class="mb-4">
                                <label for="brand_id" class="block font-semibold">Brand</label>
                                <select id="brand_id" class="w-full border p-2 rounded" wire:model="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ (string) $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="sku" class="block font-semibold">SKU</label>
                                    <input type="text" id="sku" class="w-full border p-2 rounded"
                                        wire:model.defer="sku">
                                </div>
                                <div>
                                    <label for="barcode" class="block font-semibold">Barcode</label>
                                    <input type="text" id="barcode" class="w-full border p-2 rounded"
                                        wire:model.defer="barcode">
                                </div>
                            </div>


                            <div class="grid grid-cols-2 gap-4 my-4">
                            
                                @if (!$variant_price_enabled)
                                    <div>
                                        <label for="product_price" class="block font-semibold">Price</label>
                                        <input type="number" id="product_price" class="w-full border p-2 rounded"
                                            wire:model.defer="price">
                                    </div>
                                @endif

                                <div>
                                    <label for="discount_price" class="block font-semibold">Discount Price</label>
                                    <input type="number" id="discount_price" class="w-full border p-2 rounded"
                                        wire:model.defer="discount_price">
                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="capacity" class="block font-semibold">Capacity</label>
                                    <input type="number" id="capacity" class="w-full border p-2 rounded"
                                        placeholder="e.g. 15" wire:model.defer="capacity">
                                </div>
                                <div>
                                    <label for="unit" class="block font-semibold">Unit</label>
                                    <input type="text" id="unit" class="w-full border p-2 rounded"
                                        placeholder="Enter the unit of product" wire:model.defer="unit">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="capacity" class="block font-semibold">Package Count</label>
                                    <input type="number" id="capacity" class="w-full border p-2 rounded"
                                        placeholder="Number of iteams per package. Eg. 6,12"
                                        wire:model.defer="package_count">
                                </div>
                                <div>
                                    <label for="unit" class="block font-semibold">Available Quanity</label>
                                    <input type="number" id="unit" class="w-full border p-2 rounded"
                                        placeholder="Number of iteam available quantity"
                                        wire:model.defer="available_qty">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 mb-4">
                                <div>
                                    <div x-data="subscriptionForm()">
                                        <label for="subscription" class="block font-semibold">Can be
                                            Subscribed</label>
                                        <div x-data="{ subscription: @entangle('subscription') }">
                                            <label>
                                                <input type="radio" value="no" x-model="subscription"> No
                                            </label>
                                            <label class="ml-4">
                                                <input type="radio" value="yes" x-model="subscription"> Yes
                                            </label>
                                        </div>

                                        {{-- @php
                                            $periods = $selectedModel->productSubscription()->get();
                                        @endphp --}}

                                        @if ($subscription === 'yes')
                                            <div class="mt-4 border p-4 rounded space-y-4">
                                                @foreach ($periods as $index => $period)
                                                    <div class="row"
                                                        style="display: flex; gap: 1em; align-items: center;">
                                                        <div class="col-md-3">
                                                            <label>Package Name</label>
                                                            <input class="w-full border p-2 rounded" type="text"
                                                                wire:model.defer="periods.{{ $index }}.package_name"
                                                                @if ($index !== 0)  @endif />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Start Day</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.startDay"
                                                                @if ($index !== 0) readonly @endif />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>End Day</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.endDay"
                                                                wire:change="updateNextStart({{ $index }})" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Price</label>
                                                            <input class="w-full border p-2 rounded" type="number"
                                                                wire:model.defer="periods.{{ $index }}.price" />
                                                        </div>
                                                        <div class="flex space-x-2 col-md-4">
                                                            <button class="btn btn-danger" type="button"
                                                                wire:click.prevent="removePeriod({{ $index }})"
                                                                @if (count($periods) === 1) disabled @endif>-</button>
                                                            <button class="btn btn-success" type="button"
                                                                wire:click.prevent="addPeriod({{ $index }})">+</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>

                            <div class="mt-4">
                                @foreach ($customFields as $customField)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium">{{ $customField->name }}</label>

                                        {{-- Render field based on its type --}}
                                        @if ($customField->type == 'textbox')
                                            <input type="text"
                                                wire:model="customFieldValues.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'number')
                                            <input type="number"
                                                wire:model="customFieldValues.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'textarea')
                                            <textarea wire:model="customFieldValues.{{ $customField->id }}" class="block w-full px-2 border rounded"></textarea>
                                        @elseif($customField->type == 'fileinput')
                                            <input type="file"
                                                wire:model="customFieldFiles.{{ $customField->id }}"
                                                class="block w-full px-2 border rounded">
                                        @elseif($customField->type == 'radio')
                                            @if ($customField->values)
                                                @foreach ($customField->values as $value)
                                                    <label class="inline-flex items-center">
                                                        <input type="radio"
                                                            wire:model="customFieldValues.{{ $customField->id }}"
                                                            name="{{ $customField->id }}"
                                                            value="{{ $value }}" class="form-radio">
                                                        <span class="ml-2">{{ $value }}</span>
                                                    </label>
                                                @endforeach
                                            @endif
                                        @elseif($customField->type == 'checkbox')
                                            @if ($customField->values)
                                                @foreach ($customField->values as $value)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox"
                                                            wire:model="customFieldValues.{{ $customField->id }}.{{ $value }}"
                                                            class="form-checkbox">
                                                        <span class="ml-2">{{ $value }}</span>
                                                    </label>
                                                @endforeach
                                            @endif
                                        @elseif($customField->type == 'dropdown')
                                            @if ($customField->values)
                                                <select wire:model="customFieldValues.{{ $customField->id }}"
                                                    class="block w-full px-2 border rounded">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($customField->values as $value)
                                                        <option value="{{ $value }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            @if (!$digital ?? false)
                                <hr class="my-4" />
                                <div class="border p-4 rounded-sm my-4">
                                    <p class="font-semibold">{{ __('Variations/Option Groups') }}</p>
                                    <div class="space-y-2 mt-4">
                                        @foreach ($optionGroups ?? [] as $key => $optionGroup)
                                            <div class="border rounded-sm p-4 m-2">
                                                {{-- name --}}
                                                <x-input title="{{ __('Name') }}"
                                                    name="optionGroups.{{ $key }}.name" />
                                                <div class="gap-4 grid grid-cols-2">
                                                    <x-checkbox title="{{ __('Required') }}"
                                                        name="optionGroups.{{ $key }}.required" />
                                                    <x-checkbox title="{{ __('Multiple') }}"
                                                        name="optionGroups.{{ $key }}.multiple"
                                                        :defer="false" />
                                                </div>
                                                {{-- if multiple is true --}}
                                                @if ($optionGroup['multiple'] ?? false)
                                                    <x-input title="{{ __('Max Options') }}"
                                                        name="optionGroups.{{ $key }}.max_options" />
                                                @endif
                                                {{-- options --}}
                                                <div>
                                                    <table class="table w-full">
                                                        <tbody>
                                                            @foreach ($optionGroup['options'] ?? [] as $optionKey => $optionGroupOption)
                                                                <tr>
                                                                    <td>
                                                                        <x-input title="{{ __('Name') }}"
                                                                            name="optionGroups.{{ $key }}.options.{{ $optionKey }}.name" />
                                                                    </td>
                                                                    <td class="px-4">
                                                                        <x-input title="{{ __('Price') }}"
                                                                            name="optionGroups.{{ $key }}.options.{{ $optionKey }}.price" />
                                                                    </td>
                                                                    <td class="my-auto">
                                                                        <x-buttons.plain bgColor="my-auto bg-red-500"
                                                                            wireClick="removeOption('{{ $optionKey }}', '{{ $key }}')">
                                                                            <x-heroicon-o-trash class="w-5 h-5" />
                                                                        </x-buttons.plain>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <x-buttons.primary title="{{ __('Add Option') }}"
                                                        wireClick="newOption('{{ $key }}')"
                                                        type="button" />
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- add button --}}
                                    <x-buttons.primary title="{{ __('Add Option Group') }}"
                                        wireClick="newOptionGroup" type="button" />
                                </div>
                                <hr class="my-4" />
                            @endif

                            {{-- Variant Pricing --}}
                            <hr class="my-4" />
                            <div class="border p-4 rounded-sm my-4">
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" wire:model="variant_price_enabled" id="variantCheck">
                                    <label for="variantCheck"
                                        class="font-semibold">{{ __('Enable Variant Pricing') }}</label>
                                </div>

                                @if ($variant_price_enabled)
                                    <div class="mt-4 space-y-3">
                                        @foreach ($variantPrices as $index => $variant)
                                            <div class="grid grid-cols-2 gap-4 items-end border p-3 rounded">
                                                <div>
                                                    <label class="block text-sm font-semibold">Variant</label>
                                                    <input type="text"
                                                        wire:model.defer="variantPrices.{{ $index }}.name"
                                                        class="w-full border p-2 rounded"
                                                        placeholder="e.g. Small / Large" />
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold">Price</label>
                                                    <input type="number"
                                                        wire:model.defer="variantPrices.{{ $index }}.price"
                                                        class="w-full border p-2 rounded" />
                                                </div>
                                                <div class="col-span-2 flex justify-end">
                                                    <button type="button"
                                                        wire:click="removeVariant({{ $index }})"
                                                        class="px-3 py-1 bg-red-500 text-white rounded">
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" wire:click="addVariant"
                                            class="px-4 py-2 bg-green-500 text-white rounded">
                                            + Add Variant
                                        </button>
                                    </div>
                                @endif
                            </div>

                            {{-- End Variant Pricing --}}


                            {{-- <div class="flex justify-end space-x-2">
                            <button class="px-4 py-2 border rounded bg-gray-200">Close</button>
                            <button class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                        </div> --}}
                        </div>

                        <!-- Sidebar (Right Side) -->
                        <div class="lg:w-full md:w-full w-full">
                            <!-- Product Image Section -->
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div class="flex justify-between items-center p-4 cursor-pointer border-b"
                                    data-target="productImageContent">
                                    <h5 class="font-semibold">Product Image</h5>
                                    <div>
                                        <x-heroicon-o-chevron-up class="w-5 h-5" />
                                        <x-heroicon-o-chevron-down class="w-5 h-5 hidden" />
                                    </div>
                                </div>

                                <div class="p-4" id="productImageContent">
                                    @foreach ($selectedModel->getMedia() as $photo)
                                        <img src="{{ $photo->getUrl() }}" class="rounded-lg shadow-md my-2"
                                            style="height:80px;">
                                    @endforeach
                                    <x-input.filepond wire:model="photos" title="{{ __('Photo(s)') }}"
                                        acceptedFileTypes="['image/png', 'image/jpeg', 'image/jpg']"
                                        allowImagePreview="true" imagePreviewMaxHeight="80" grid="3"
                                        multiple="true" allowFileSizeValidation="true"
                                        maxFileSize="{{ setting('filelimit.product_image_size', 200) }}kb" />
                                    <x-input-error message="{{ $errors->first('photos') }}" />

                                    {{-- <div class="mt-4 text-center">
                                        <img src="/api/placeholder/400/300" alt="Product Image Preview"
                                            class="rounded-lg shadow-md mx-auto">
                                        <div class="flex justify-between mt-3">
                                            <button
                                                class="bg-gray-200 text-gray-700 px-3 py-1 rounded-lg text-sm">Replace</button>
                                            <button
                                                class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm">Remove</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Categories Section -->
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div class="flex justify-between items-center p-4 cursor-pointer border-b"
                                    data-target="categoriesContent">
                                    <h5 class="font-semibold">Categories</h5>
                                    <div>
                                        <x-heroicon-o-chevron-up class="w-5 h-5" />
                                        <x-heroicon-o-chevron-down class="w-5 h-5 hidden" />
                                        {{-- <i class="fa-solid fa-angle-up mr-2 toggle-icon-up"></i>
                                    <i class="fa-solid fa-angle-down toggle-icon-down hidden"></i> --}}
                                    </div>
                                </div>
                                <div class="p-4" id="categoriesContent"
                                    style="max-height: 300px; overflow-y: scroll;">
                                    {{-- {{$categoryoptions}} --}}
                                    @foreach ($categoryoptions as $item)
                                        <ul>
                                            <li>
                                                <div class="flex items-center">
                                                    <input type="checkbox" class="mr-2"
                                                        wire:model.defer='categories' value="{{ $item->id }}">
                                                    <span>{{ $item->name }}</span>
                                                </div>
                                                @if ($item->sub_categories)
                                                    @foreach ($item->sub_categories as $sub_category)
                                                        <ul style="margin-left: 2rem">
                                                            <li>
                                                                <div class="flex items-center">
                                                                    <input type="checkbox" class="mr-2"
                                                                        wire:model.defer='sub_categories'
                                                                        value="{{ $sub_category->id }}">
                                                                    <span>{{ $sub_category->name }}</span>
                                                                </div>
                                                                @if ($sub_category->sub_sub_categories)
                                                                    @foreach ($sub_category->sub_sub_categories as $sub_sub_category)
                                                                        <ul style="margin-left: 2.5rem">
                                                                            <li>
                                                                                <div class="flex items-center">
                                                                                    <input type="checkbox"
                                                                                        class="mr-2"
                                                                                        wire:model.defer='sub_sub_categories'
                                                                                        value="{{ $sub_sub_category->id }}">
                                                                                    <span>{{ $sub_sub_category->name }}</span>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                @endif
                                                            </li>

                                                        </ul>
                                                    @endforeach
                                                @endif
                                            </li>
                                            {{-- <li>
                                        <div class="flex items-center">
                                            <input type="checkbox" class="mr-2">
                                            <span>Electronics</span>
                                        </div>
                                    </li> --}}
                                        </ul>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Additional Options -->
                            <div class="bg-white shadow-lg rounded-lg">
                                <div class="p-4 border-b">
                                    <h5 class="font-semibold">Additional Options</h5>
                                </div>
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="moreOptionCheck"
                                                    wire:model="plus_option">
                                                <label for="moreOptionCheck">
                                                    <span class="font-semibold">More Option</span>
                                                    <small class="block text-gray-500">Option price should be added to
                                                        product price</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="ageRestrictionCheck"
                                                    wire:model.defer="age_restricted">
                                                <label for="ageRestrictionCheck">
                                                    <span class="font-semibold">Age Restriction</span>
                                                    <small class="block text-gray-500">Customers will be informed they
                                                        must
                                                        be of legal age</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="faqCheck"
                                                    wire:model.defer="faq_visible">
                                                <label for="faqCheck">
                                                    <span class="font-semibold">Question And Answers (FAQ)</span>
                                                    <small class="block text-gray-500">FAQ</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="faqCheck"
                                                    wire:model="isActive">
                                                <label for="faqCheck">
                                                    <span class="font-semibold">Active</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="deliverableCheck"
                                                    wire:model.defer='deliverable'>
                                                <label for="deliverableCheck">
                                                    <span class="font-semibold">Can be Delivered</span>
                                                    <small class="block text-gray-500">If product can be delivered to
                                                        customers</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="commentableCheck"
                                                    wire:model.defer='commentable'>
                                                <label for="commentableCheck">
                                                    <span class="font-semibold">Commentable</span>
                                                    <small class="block text-gray-500">Commentable</small>
                                                </label>
                                            </div>
                                            <div class="flex items-start mb-3">
                                                <input type="checkbox" class="mr-2 mt-1" id="digitalCheck"
                                                    wire:model="digital">
                                                <label for="digitalCheck">
                                                    <span class="font-semibold">Digital</span>
                                                    <small class="block text-gray-500">If product is digital and can be
                                                        downloaded</small>
                                                    @if ($digital)
                                                        <x-input.filepond wire:model="digitalFile"
                                                            allowImagePreview="false" allowFileSizeValidation="true"
                                                            maxFileSize="{{ setting('filelimit.max_product_digital_files_size', 2) }}mb" />
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <x-buttons.primary>Update</x-buttons.primary>
            </x-form>
        </div>
    @endif

    @if ($showAssignSubcategories)

        {{-- Assign Subcategories --}}
        <div>
            <x-modal confirmText="{{ __('Add') }}" action="assignSubcategories">
                <p class="text-xl font-semibold">{{ __('Assign To Sub-categories') }}</p>
                <p class="text-sm text-gray-500">
                    {{ __('Note: Only sub-categories of the assigned product categories will be listed here') }}</>
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    @foreach ($subCategories as $subCategory)
                        <x-checkbox title="{{ $subCategory->name }}({{ $subCategory->category->name }})"
                            name="subCategoriesIDs" value="{{ $subCategory->id }}" />
                    @endforeach
                </div>

            </x-modal>
        </div>
    @endif

    @if ($showAssign)

        {{-- Assign menus --}}
        <div>
            <x-modal confirmText="{{ __('Add') }}" action="assignMenus">
                <p class="text-xl font-semibold">{{ __('Add to Menus') }}</p>
                <p class="text-sm text-gray-500">
                    {{ __('Note: Menus of selected vendor for product will be listed here') }}</>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($menus as $menu)
                        <x-checkbox title="{{ $menu->name }}" name="menusIDs" value="{{ $menu->id }}" />
                    @endforeach
                </div>

            </x-modal>
        </div>
    @endif



    {{-- details modal --}}
    @if ($showDetails)

        <div>
            <x-baseview title="{{ $selectedModel->name ?? '' }} {{ __('Details') }}">
                <button type="button" wire:click="$emitUp('dismissModal'); $set('showDetails', false)"
                    class="mb-4 px-4 py-2 bg-gray-500 text-white rounded">
                    ← {{ __('Back') }}
                </button>
                {{-- <p class="text-xl font-semibold">{{ $selectedModel->name ?? '' }}</p> --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-details.item title="{{ __('Name') }}" text="{{ $selectedModel->name ?? '' }}" />
                    <x-details.item title="{{ __('SKU') }}" text="{{ $selectedModel->sku ?? '' }}" />
                </div>
                <x-details.item title="{{ __('Description') }}" text="">
                    {!! $selectedModel->description ?? '' !!}
                </x-details.item>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-details.item title="{{ __('Price') }}"
                        text="{{ currencyFormat($selectedModel->price ?? '') }}" />
                    <x-details.item title="{{ __('Discount Price') }}"
                        text="{{ currencyFormat($selectedModel->discount_price ?? '') }}" />


                    <x-details.item title="{{ __('Capacity') }}" text="{{ $selectedModel->capacity ?? '' }}" />
                    <x-details.item title="{{ __('Unit') }}" text="{{ $selectedModel->unit ?? '' }}" />


                    <x-details.item title="{{ __('Package Count') }}"
                        text="{{ $selectedModel->package_count ?? '0' }}" />
                    <x-details.item title="{{ __('Available Qty') }}"
                        text="{{ $selectedModel->available_qty ?? '' }}" />

                    <x-details.item title="{{ __('Vendor') }}" text="{{ $selectedModel->vendor->name ?? '' }}" />
                    <x-details.item title="{{ __('Menus') }}" text="">
                        @if ($selectedModel != null)
                            {{ implode(', ', $selectedModel->menus()->pluck('name')->toArray()) }}
                        @endif
                    </x-details.item>



                </div>
                <x-details.item title="{{ __('Photos') }}" text="">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach ($selectedModel->photos ?? [] as $photo)
                            <a href="{{ $photo }}" target="_blank"><img src="{{ $photo }}"
                                    class="w-24 h-24 mx-2 rounded-sm" /></a>
                        @endforeach
                    </div>
                </x-details.item>
                @if ($selectedModel->has_options ?? false)
                    <div>
                        <hr class="my-4" />
                        <table class="w-full table-auto border-collapse border border-slate-500">
                            <thead class="bg-slate-400">
                                <tr class="bg-slate-400">
                                    <th class="p-2 border border-slate-400 bg-gray-100">{{ __('Option Group') }}</th>
                                    <th class="p-2 border border-slate-400 bg-gray-100 w-20">{{ __('Active') }}</th>
                                    <th class="p-2 border border-slate-400 bg-gray-100">{{ __('Options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selectedModel->option_groups ?? [] as $optionGroup)
                                    <tr>
                                        <td class="p-2 border border-slate-400">{{ $optionGroup->name }}</td>
                                        <td class="p-2 border border-slate-400">
                                            @if ($optionGroup->is_active)
                                                <x-table.check />
                                            @else
                                                <x-table.close />
                                            @endif
                                        </td>
                                        <td class="p-2 border border-slate-400 wrap space-x-2">
                                            @foreach ($optionGroup->options ?? [] as $option)
                                                <span class="rounded-full bg-gray-200 px-2 text-sm">
                                                    {{ $option->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($selectedModel->digital ?? false)
                    <hr class="my-4" />
                    <x-details.item title="{{ __('File') }}" text="">
                        <div class="space-y-3">
                            @foreach ($selectedModel->digital_files ?? [] as $file)
                                <div class="flex items-center p-2 border rounded">
                                    <div class="w-full text-wrap">
                                        <p>{{ $file->name }}</p>
                                        <p>
                                            <span class="text-xs font-thin text-primary-400">
                                                {{ $file->size }} bytes
                                            </span>
                                        </p>
                                    </div>

                                    <a href="{{ $file->link }}" target="_blank"
                                        class="font-medium hover:underline text-primary-500 hover:text-primary-800 hover:font-bold">
                                        {{ __('Download') }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </x-details.item>
                @endif
                <div class="grid grid-cols-1 gap-4 pt-4 mt-4 border-t md:grid-cols-2 lg:grid-cols-3">

                    <div>
                        <x-label title="{{ __('Status') }}" />
                        <x-table.active :model="$selectedModel" />
                    </div>

                    <div>
                        <x-label title="{{ __('Plus Option') }}" />
                        <x-table.bool isTrue="{{ $selectedModel->plus_option ?? false }}" />
                    </div>

                    <div>
                        <x-label title="{{ __('Available for Delivery') }}" />
                        <x-table.bool isTrue="{{ $selectedModel->deliverable ?? false }}" />
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-4 pt-4 mt-4 border-t md:grid-cols-2 lg:grid-cols-3">





                </div>

            </x-baseview>
        </div>
    @endif



    {{-- timing form --}}
    @if ($showDayAssignment)
        <div x-data="{ open: @entangle('showDayAssignment') }">
            @include('livewire.product-timing')
        </div>
    @endif
</div>
@push('scripts')
    {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <script>
        document.addEventListener('livewire:load', function() {
            // Check if a modal-specific event was emitted
            if (@this.showCreate) {
                initializeSelect2(); // Initialize for create modal
            } else if (@this.showEdit) {
                initializeUpdateSelect2(); // Initialize for edit modal
            }
        });

        document.addEventListener('livewire:refresh', function() {
            // Reinitialize Select2 if page content changes dynamically
            $('#updateamenities').select2();
        });

        document.addEventListener('livewire:updated', function() {
            // Again, check if the modal-specific event was emitted
            if (@this.showCreate) {
                initializeSelect2();
            } else if (@this.showEdit) {
                initializeUpdateSelect2();
            }
        });

        Livewire.on('initializeSelect2', function() {
            initializeSelect2();
        });
        Livewire.on('initializeUpdateSelect2', function() {
            initializeUpdateSelect2();
        });

        function initializeSelect2() {
            const amenitiesSelect = $('#amenities');


            if (amenitiesSelect.length > 0) {
                amenitiesSelect.select2({
                    placeholder: "Select Amenities",
                    allowClear: true
                });

                amenitiesSelect.on('change', function() {
                    // Set the selected values in Livewire
                    @this.set('selectedAmenities', $(this).val());
                });
            }
        }

        function initializeUpdateSelect2() {
            const updateamenitiesSelect = $('#updateamenities');

            if (updateamenitiesSelect.length > 0) {
                updateamenitiesSelect.select2({
                    placeholder: "Select Amenities",
                    allowClear: true
                });

                updateamenitiesSelect.on('change', function() {
                    // Set the selected values in Livewire
                    @this.set('selectedAmenities', $(this).val());
                });
            }

        }

        setInterval(function() {
            if (!$('.select2').hasClass('select2-hidden-accessible')) {
                $('.select2').select2();
            }
        }, 1000);
    </script>
    <script>
        function subscriptionForm() {
            return {
                subscription: 'no',
                periods: [{
                    package_name: null,
                    startDay: null,
                    endDay: null,
                    price: null
                }],
                addPeriod(index) {
                    const current = this.periods[index];
                    let newStart = null;

                    if (current.endDay != null && current.endDay !== '') {
                        newStart = Number(current.endDay) + 1;
                    }

                    this.periods.splice(index + 1, 0, {
                        package_name: null,
                        startDay: newStart,
                        endDay: null,
                        price: null
                    });
                },
                removePeriod(index) {
                    if (this.periods.length > 1) {
                        this.periods.splice(index, 1);
                    }
                },
                updateNextStart(index) {
                    if (index < this.periods.length - 1) {
                        const currentEnd = this.periods[index].endDay;
                        if (currentEnd != null && currentEnd !== '') {
                            this.periods[index + 1].startDay = Number(currentEnd) + 1;
                            // Optionally clear endDay if less than startDay
                            if (this.periods[index + 1].endDay != null && this.periods[index + 1].endDay < this.periods[
                                    index + 1].startDay) {
                                this.periods[index + 1].endDay = null;
                            }
                        } else {
                            this.periods[index + 1].startDay = null;
                        }
                    }
                }
            }
        }
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            let pond;

            // Listen for the event from Livewire
            livewire.on('filepond-add-file', (selector, url, name) => {
                const input = document.querySelector(selector);
                if (!input) return;

                // Get existing FilePond instance or create one
                pond = FilePond.find(input) || FilePond.create(input);

                // Fetch the image and add as File object
                fetch(url)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], name || 'photo', {
                            type: blob.type
                        });
                        pond.addFile(file);
                    })
                    .catch(err => console.error('Error loading old image:', err));
            });
        });
    </script>
    <script>
        // Listen for server-side event to reload the entire page
        window.addEventListener('reloadPage', function() {
            // Use a hard reload so updated resources are fetched
            location.reload();
        });
    </script>
@endpush
