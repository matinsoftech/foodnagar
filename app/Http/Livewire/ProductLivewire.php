<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Tag;
use App\Models\Menu;
use App\Models\User;
use App\Models\Brand;
use App\Models\Option;
use App\Models\Vendor;
use App\Models\Amenity;
use App\Models\Product;
use App\Models\Category;
use App\Models\AppModule;
use App\Models\VendorType;
use App\Models\CustomField;
use App\Models\OptionGroup;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class ProductLivewire extends ProductTimingLivewire
{
    use WithFileUploads;

    //
    public $model = Product::class;
    public $showDayAssignment = false;
    public $showNewDayAssignment = false;

    //
    public $name;
    public $description;
    public $price;
    public $sku;
    public $barcode;
    public $discount_price = 0;
    public $capacity;
    public $unit;
    public $package_count;
    public $available_qty;
    public $vendorID;
    public $vendor;
    public $plus_option;
    public $digital;
    public $deliverable = 1;
    public $isActive = 1;
    public $in_order = 1;
    public $age_restricted = 0;
    public $brand_id;
    public $vendor_type_id;
    public $vendor_id;

    //
    public $menusIDs = [];
    public $categoriesIDs;
    public $subCategoriesIDs = [];
    public $photos = [];
    public $digitalFile;
    //
    public $showAssignSubcategories = false;
    public $subCategories = [];
    public $categorySearchClause = [];

    //tags
    public $tagList = [];
    public $selectedTagIds = [];
    public $selectedTags;
    //menu
    public $selectedMenuIds = [];
    public $selectedMenus;
    // subcategories
    public $selectedSubcategoryIds = [];
    public $selectedSubcategories;

    public $subSubCategoriesIDs = [];
    public $selectedSubSubcategories;

    //option groups + options
    public $optionGroups = [];

    public $brands;
    public $selectedVendorId;
    public $vendorTypes = [];
    public $vendors;
    public $customFields;
    public $customFieldValues;
    public $customFieldFiles = [];

    public $amenities = [];
    public $selectedAmenities = [];
    public $editing = false;
    public $ad_type;
    public $address;
    public $faq_visible;
    public $commentable;
    public $expiry_date;

    public $category;
    public $sub_category;
    public $sub_sub_category;

    public $categories = [];
    public $sub_categories = [];
    public $sub_sub_categories = [];

    public $categoryoptions = [];
    // public $subcategoryoption = [];
    // public $subsubcategoryoption = [];
    public $startDay = [];
    public $endDay = [];
    public $subscription_price = [];

    public $variant_price_enabled = false; // Checkbox toggle
    public $variantPrices = []; // Stores all variant prices


    public $classified_visible = false;

    protected $rules = [
        "name" => "required|string",
        "price" => "nullable|numeric",
        "vendor_id" => "required|exists:vendors,id",
        "photos" => "nullable|array",
    ];


    protected $messages = [
        "vendorID.exists" => "Invalid vendor selected",
    ];

    public $subscription = 'no';
    public $periods = [
        ['startDay' => null, 'endDay' => null, 'price' => null, 'package_name' => null]
    ];

    public function addPeriod($index)
    {
        $current = $this->periods[$index];
        $newStart = null;

        if (!empty($current['endDay'])) {
            $newStart = $current['endDay'] + 1;
        }

        array_splice($this->periods, $index + 1, 0, [[
            'startDay' => $newStart,
            'endDay' => null,
            'price' => null,
            'package_name' => null
        ]]);
    }

    public function removePeriod($index)
    {
        if (count($this->periods) > 1) {
            unset($this->periods[$index]);
            $this->periods = array_values($this->periods); // re-index array keys
        }
    }

    public function updateNextStart($index)
    {
        if ($index < count($this->periods) - 1) {
            $currentEnd = $this->periods[$index]['endDay'];
            if (!empty($currentEnd)) {
                $this->periods[$index + 1]['startDay'] = $currentEnd + 1;

                if (!empty($this->periods[$index + 1]['endDay']) && $this->periods[$index + 1]['endDay'] < $this->periods[$index + 1]['startDay']) {
                    $this->periods[$index + 1]['endDay'] = null;
                }
            } else {
                $this->periods[$index + 1]['startDay'] = null;
            }
        }
    }

    public function mount()
    {

        $this->categoryoptions = Category::select('id', 'name')
            ->where('is_active', 1)
            ->with([
                'sub_categories:id,name,category_id',
                'sub_categories.sub_sub_categories:id,name,sub_category_id'
            ])
            ->get();

        $moduleConfig = AppModule::first(); // Retrieve the first AppModule configuration

        if ($moduleConfig && $moduleConfig->module_type == 'single') {
            // Fetch vendor types filtered by the selected module type
            $mVendorTypes = VendorType::active()
                ->where('id', $moduleConfig->vendor_types_id)
                ->get();
        } else {
            // Fetch all active vendor types if no specific module type is configured
            $mVendorTypes = VendorType::active()->get();
        }
        $this->brands = Brand::get();

        $this->vendorTypes = $mVendorTypes;
        $this->vendors = [];
        $this->customFields = collect([]);
        $this->customFieldValues = collect([]);
        $this->amenities = [];

        // if ($productId) {
        //     $product = Product::with('subscriptions')->find($productId);

        //     if ($product) {
        //         $this->subscription = $product->subscription ?? 'no';

        //         if ($this->subscription === 'yes' && $product->subscriptions->count() > 0) {
        //             $this->periods = $product->subscriptions->map(function($sub) {
        //                 return [
        //                     'startDay' => $sub->startDay,
        //                     'endDay' => $sub->endDay,
        //                     'price' => $sub->price,
        //                 ];
        //             })->toArray();
        //         }
        //     }
        // }

        if ($this->editing && $this->productId) {
            $product = Product::with(['variants', 'optionGroups.options'])->find($this->productId);

            if ($product) {

                // Load variants into Livewire property
                if ($this->variant_price_enabled) {
                    $this->variantPrices = $product->variants->map(function ($v) {
                        return [
                            'name' => $v->name,
                            'price' => $v->price,
                        ];
                    })->toArray();
                }
            }
        }

        if ($this->editing && $this->productId) {
            $product = Product::find($this->productId);
            if ($product) {
                $this->brand_id = $product->brand_id; // preselect
            }
        }
        if ($this->editing) {
            $this->emit('initializeUpdateSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }

    public function getListeners()
    {
        return $this->listeners + [
            'setOutOfStock' => 'setOutOfStock',
            'tag_idUpdated' => "tagSelected",
            'menu_idUpdated' => "menuSelected",
            'subcategory_idUpdated' => "subcategorySelected",
            'changeProductTiming' => 'changeProductTiming',
        ];
    }

    // public function updatedCategory($value)
    // {
    //     // Fetch subcategories when a category is selected
    //     $this->subcategoryoption = Subcategory::where('category_id', $value)->get();

    //     // Reset sub-category and sub-sub-category when category changes
    //     $this->sub_category = null;
    //     $this->subsubcategoryoption = [];
    //     $this->sub_sub_category = null;
    // }

    // public function updatedSubCategory($value)
    // {
    //     // Fetch sub-subcategories when a subcategory is selected
    //     $this->subsubcategoryoption = SubSubCategory::where('sub_category_id', $value)->get();

    //     // Reset sub-sub-category when sub-category changes
    //     $this->sub_sub_category = null;
    // }

    public function render()
    {
        if (!$this->brands) {
            $this->brands = Brand::all(); // Fallback initialization
        }
        if (!$this->categoryoptions) {
            $this->categoryoptions = Category::where('is_active', 1)->latest('id')->get(); // Fallback initialization
        }

        // $this->subcategoryoption = SubCategory::where('category_id', $this->category)->get();
        // $this->subsubcategoryoption = SubSubCategory::where('sub_category_id', (int) $this->sub_category)->get();

        $moduleConfig = AppModule::first(); // Retrieve the first AppModule configuration

        if ($moduleConfig && $moduleConfig->module_type == 'single') {
            // Fetch vendor types filtered by the selected module type
            $mVendorTypes = VendorType::active()
                ->where('id', $moduleConfig->vendor_types_id)
                ->get();
        } else {
            // Fetch all active vendor types if no specific module type is configured
            $mVendorTypes = VendorType::active()->get();
        }

        if (!$this->vendorTypes) {
            $this->vendorTypes = $mVendorTypes; // Fallback initialization
        }

        if (!$this->vendors || $this->vendors->isEmpty()) {
            if ($this->vendor_type_id) {
                $this->vendors = Vendor::where('vendor_type_id', $this->vendor_type_id)->get();
            } else {
                $this->vendors = []; // Fallback initialization
            }
        }

        if (!$this->customFields || $this->customFields->isEmpty()) {
            if ($this->vendor_type_id) {
                $this->customFields = CustomField::whereHas('vendorType', function ($query) {
                    $query->where('vendor_type_id', $this->vendor_type_id); // Target the 'vendor_type_id' in the pivot table
                })->get();
            } else {
                $this->customFields = [];
            }
        }

        if ($this->amenities || count($this->amenities) == 0) {
            if ($this->vendor_type_id) {
                $this->amenities = Amenity::where('vendor_type_id', $this->vendor_type_id)->get(['name', 'id'])->toArray();
            } else {
                $this->amenities = [];
            }
        }

        if ($this->vendor_type_id && $this->vendor_type_id == 9) {
            $this->classified_visible = true;
        } else {
            $this->classified_visible = false;
        }

        return view('livewire.products', [
            "vendors" => [],
            "menus" => Menu::active()->where('vendor_id', $this->vendorID)->get(),
            "categories" => [],
            "subcategories" => [],
            "brands" => $this->brands,
            "vendorTypes" => $this->vendorTypes,
            "vendors" => $this->vendors,
            "customFields" => $this->customFields,
            "customFieldValues" => $this->customFieldValues,
            "amenities" => $this->amenities,
            'selectedAmenities' => $this->selectedAmenities,
            "classified_visible" => $this->classified_visible,
            "categoryoptions" => $this->categoryoptions,
        ]);
    }

    //for tag select
    public function tagSelected($value)
    {
        //
        if ($value == null || !$value) {
            return;
        }
        //
        $this->selectedTagIds ??= [];
        //if is not array
        if (!is_array($this->selectedTagIds)) {
            $this->selectedTagIds = [];
        }
        $tagId = $value['value'];
        //add to array if not already added
        if (!in_array($tagId, $this->selectedTagIds)) {
            $this->selectedTagIds[] = $tagId;
        }
        //
        $this->selectedTags = Tag::whereIn('id', $this->selectedTagIds)->get();
        //emit to clear selection
        $this->emitUp('tag_idUpdated', null);
    }
    public function removeSelectedTag($id)
    {
        $this->selectedTags = $this->selectedTags->reject(function ($element) use ($id) {
            return $element->id == $id;
        });

        //
        $this->selectedTagIds = $this->selectedTags->pluck('id') ?? [];
    }

    //for menu select
    public function menuSelected($value)
    {
        //
        if ($value == null || !$value) {
            return;
        }
        //
        $this->selectedMenuIds ??= [];
        //if is not array
        if (!is_array($this->selectedMenuIds)) {
            $this->selectedMenuIds = [];
        }
        $tagId = $value['value'];
        //add to array if not already added
        if (!in_array($tagId, $this->selectedMenuIds)) {
            $this->selectedMenuIds[] = $tagId;
        }
        //
        $this->selectedMenus = Menu::whereIn('id', $this->selectedMenuIds)->get();
        //emit to clear selection
        $this->emitUp('menu_idUpdated', null);
    }

    public function updatedCustomFieldValues($value, $fieldId)
    {
        // Check if the updated field is a file
        if (is_object($value)) {
            // This means it's a file, so store it separately in customFieldFiles
            $this->customFieldFiles[$fieldId] = $value;
            $this->customFieldValues[$fieldId] = null; // Temporarily null out the wire:model value, it's a file
        }
    }

    public function removeSelectedMenu($id)
    {
        $this->selectedMenus = $this->selectedMenus->reject(function ($element) use ($id) {
            return $element->id == $id;
        });

        //
        $this->selectedMenuIds = $this->selectedMenus->pluck('id') ?? [];
    }

    //category selected
    public function autocompleteCategorySelected($item)
    {
        parent::autocompleteCategorySelected($item);
        $this->loadSubcategoriesSelector();
    }
    public function loadSubcategoriesSelector()
    {
        //
        $this->emit('category_idUpdated', [
            'value' => json_encode($this->categoriesIDs),
            "name" => "category_id",
        ]);
    }

    public function removeSelectedCategory($id)
    {
        parent::removeSelectedCategory($id);
        //get all the subcategories of the removed category from the selected subcategories
        if ($this->selectedSubcategories != null) {
            $toBeRemovedSubcategories = $this->selectedSubcategories->filter(function ($subcategory) use ($id) {
                return $subcategory->category_id == $id;
            });
        } else {
            $toBeRemovedSubcategories = [];
        }
        //remove the subcategories
        foreach ($toBeRemovedSubcategories as $subcategory) {
            $this->removeSelectedSubcategory($subcategory->id);
        }
    }


    //for subcategory select
    public function subcategorySelected($value)
    {
        //
        if ($value == null || !$value) {
            return;
        }
        //
        $this->selectedSubcategoryIds ??= [];
        //if is not array
        if (!is_array($this->selectedSubcategoryIds)) {
            $this->selectedSubcategoryIds = [];
        }
        $tagId = $value['value'];
        //add to array if not already added
        if (!in_array($tagId, $this->selectedSubcategoryIds)) {
            $this->selectedSubcategoryIds[] = $tagId;
        }
        //
        $this->selectedSubcategories = Subcategory::whereIn('id', $this->selectedSubcategoryIds)->get();
        $this->subCategoriesIDs = $this->selectedSubcategoryIds;
        //emit to clear selection
        $this->emitUp('subcategory_idUpdated', null);
    }

    public function removeSelectedSubcategory($id)
    {
        $this->selectedSubcategories = $this->selectedSubcategories->reject(function ($element) use ($id) {
            return $element->id == $id;
        });

        //
        $this->selectedSubcategoryIds = $this->selectedSubcategories->pluck('id') ?? [];
        $this->subCategoriesIDs = $this->selectedSubcategoryIds;
    }

    public function newOptionGroup()
    {
        $this->optionGroups[] = [
            "id" => null,
            'name' => '',
            'required' => false,
            'multiple' => false,
            'max_options' => null,
            'options' => []
        ];
        // get index
        $index = count($this->optionGroups) - 1;
        $this->newOption($index);
    }

    public function newOption($index)
    {
        $this->optionGroups[$index]['options'][] = [
            "id" => null,
            'name' => '',
            'price' => null,
        ];
    }

    public function removeOption($optionKey, $optionGroupKey)
    {
        unset($this->optionGroups[$optionGroupKey]['options'][$optionKey]);
        //reindex the array
        $this->optionGroups[$optionGroupKey]['options'] = array_values($this->optionGroups[$optionGroupKey]['options']);
    }


    //
    public function showCreateModal()
    {
        $this->reset();
        $this->showCreate = true;
        $this->plus_option = true;
        $this->editing = false;
        $this->emit('preselectedVendorEmit', \Auth::user()->vendor->name ?? "");
        $this->emit('loadSummerNote', "newContent", "");
        $this->emit('initializeSelect2');
    }


    public function updatedSelectedAmenities($value)
    {
        if ($this->editing == true) {
            $this->emit('initializeUpdateSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }


    public function save()
    {
        $this->validatePhotos();
        if (empty($this->vendorID)) {
            $this->vendorID = \Auth::user()->vendor_id;
        }
        //validate
        $this->validate();

        try {
            DB::beginTransaction();
            $model = new Product();
            $model->name = $this->name;
            $model->sku = $this->sku ?? null;
            $model->barcode = $this->barcode ?? null;
            $model->description = $this->description;
            $model->price = $this->price;
            $model->discount_price = $this->discount_price;
            $model->capacity = $this->capacity;
            $model->unit = $this->unit;
            $model->package_count = $this->package_count;
            $model->available_qty = !empty($this->available_qty) ? $this->available_qty : null;
            $model->vendor_id = $this->vendor_id ?? \Auth::user()->vendor_id;
            $model->vendor_type_id = $this->vendor_type_id;
            $model->featured = false;
            $model->plus_option = $this->plus_option ?? false;
            $model->digital = $this->digital ?? false;
            $model->deliverable = $this->digital ? false : $this->deliverable;
            $model->is_active = $this->isActive;
            $model->in_order = $this->in_order;
            $model->age_restricted = $this->age_restricted;
            $model->brand_id = $this->brand_id;
            $model->address = $this->address;
            $model->ad_type = $this->ad_type;
            $model->commentable = $this->commentable;
            $model->faq_visible = $this->faq_visible;
            $model->expiry_date = $this->expiry_date;
            $model->subscription = $this->subscription ?? 'no';

            $amenityIds = collect($this->amenities)->pluck('id')->toArray();

            $model->amenities = json_encode($amenityIds);
            $customFieldValues = $this->customFieldValues;

            // Handle file uploads
            foreach ($this->customFieldFiles as $fieldId => $file) {
                if ($file) {
                    $filePath = $file->store('custom_field_files', 'public'); // Store file
                    $customFieldValues[$fieldId] = $filePath; // Update with file path
                }
            }
            $model->custom_field_values = json_encode($this->customFieldValues);
            $model->save();
            $model->categories()->sync($this->categories);
            $model->sub_categories()->sync($this->sub_categories);
            $model->sub_sub_categories()->sync($this->sub_sub_categories);


            if ($this->photos) {
                $model->clearMediaCollection('default'); // Clear old media

                foreach ($this->photos as $photo) {
                    // Move Livewire's temporary file to a permanent location
                    $filePath = $photo->getRealPath(); // Get temporary file path

                    $model->addMedia($filePath) // Use real path for Spatie Media Library
                        ->usingFileName($photo->getClientOriginalName()) // Keep original name
                        ->toMediaCollection('default'); // Store in 'default' collection
                }

                $this->photos = null; // Clear after upload
            }


            if ($this->digitalFile && $this->digital) {

                $model->clearDigitalFiles();
                $model->saveDigitalFile($this->digitalFile);
                $this->digitalFile = null;
            }
            //remove null values from the array
            $categories = Category::whereIn('id', $this->categoriesIDs ?? [])->get();
            $this->categoriesIDs = $categories->pluck('id')->toArray();
            $subCategories = Subcategory::whereIn('id', $this->subCategoriesIDs ?? [])->get();
            $this->subCategoriesIDs = $subCategories->pluck('id')->toArray();
            //
            $model->categories()->attach($this->categoriesIDs);
            $model->sub_categories()->attach($this->subCategoriesIDs);
            $model->tags()->sync($this->selectedTags);
            $model->menus()->sync($this->selectedMenus);

            //loop through the option groups
            $vendorId = $model->vendor_id;
            foreach ($this->optionGroups as $mOptionGroup) {
                $optionGroup = OptionGroup::updateOrCreate([
                    "id" => $mOptionGroup['id'],
                    "vendor_id" => $vendorId,
                ], [
                    "name" => $mOptionGroup['name'],
                    "multiple" => $mOptionGroup['multiple'],
                    "required" => $mOptionGroup['required'],
                    "max_options" => $mOptionGroup['max_options'] ?? null,
                ]);
                //sync the options
                $mOptionGroupOptions = collect($mOptionGroup['options']);
                foreach ($mOptionGroupOptions as $mOptionGroupOption) {
                    $option = Option::updateOrCreate([
                        "id" => $mOptionGroupOption['id'],
                        "vendor_id" => $vendorId,
                    ], [
                        "name" => $mOptionGroupOption['name'],
                        "price" => $mOptionGroupOption['price'],
                        "product_id" => $model->id,
                        "is_active" => true,
                    ]);
                    //sync the option with the option group
                    $option->option_group_id = $optionGroup->id;
                    $option->save();
                    //sync the option with the product
                    $option->products()->syncWithoutDetaching($model->id);
                }
            }

            // Save variant prices if enabled
            if ($this->variant_price_enabled && !empty($this->variantPrices)) {
                // Optional: delete old variants if editing
                if ($this->editing) {
                    $model->variants()->delete();
                }

                foreach ($this->variantPrices as $variant) {
                    // Skip empty variants
                    if (!empty($variant['name']) && $variant['price'] !== null) {
                        $model->variants()->create([
                            'name'  => $variant['name'],
                            'price' => $variant['price'],
                        ]);
                    }
                }
            }

            // Store subscription periods if "yes"
            if ($this->subscription === 'yes' && !empty($this->periods)) {
                foreach ($this->periods as $period) {
                    if (!empty($period['startDay']) && !empty($period['endDay'])) {
                        \App\Models\ProductSubscription::create([
                            'product_id' => $model->id,
                            'startDay'  => $period['startDay'],
                            'endDay'    => $period['endDay'],
                            'price'      => $period['price'] ?? 0,
                            'package_name' => $period['packageName'] ?? '',
                        ]);
                    }
                }
            }

            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Product") . " " . __('created successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Product") . " " . __('creation failed!'));
        }
    }

    // Updating model
    public function initiateEdit($id)
    {


        $this->brands = Brand::all();
        $this->editing = true;
        $this->selectedModel = $this->model::find($id);
        $this->name = $this->selectedModel->name;
        $this->sku = $this->selectedModel->sku;
        $this->barcode = $this->selectedModel->barcode;
        $this->description = $this->selectedModel->description;
        $this->price = $this->selectedModel->price;
        $this->discount_price = $this->selectedModel->discount_price;
        $this->capacity = $this->selectedModel->capacity;
        $this->unit = $this->selectedModel->unit;
        $this->package_count = $this->selectedModel->package_count;
        $this->available_qty = $this->selectedModel->available_qty;
        $this->vendorID = $this->selectedModel->vendor_id;
        $this->vendor = $this->selectedModel->vendor;
        $this->plus_option = $this->selectedModel->plus_option ?? true;
        $this->digital = $this->selectedModel->digital;
        $this->deliverable = $this->selectedModel->deliverable;
        $this->isActive = $this->selectedModel->is_active;
        $this->in_order = $this->selectedModel->in_order;
        $this->age_restricted = $this->selectedModel->age_restricted;
        $this->brand_id = $this->selectedModel->brand_id;
        $this->vendor_id = $this->selectedModel->vendor_id;
        $this->vendor_type_id = $this->selectedModel->vendor_type_id;
        $this->address = $this->selectedModel->address;
        $this->ad_type = $this->selectedModel->ad_type;
        $this->faq_visible = $this->selectedModel->faq_visible;
        $this->commentable = $this->selectedModel->commentable;
        $this->expiry_date = $this->selectedModel->expiry_date;
        $this->subscription = $this->selectedModel->subscription;

        $this->variant_price_enabled = $this->selectedModel->variants->count() > 0;

        if ($this->variant_price_enabled) {
            $this->variantPrices = $this->selectedModel->variants->map(function ($variant) {
                return [
                    'name' => $variant->name,
                    'price' => $variant->price,
                ];
            })->toArray();
        } else {
            $this->variantPrices = []; // ensure it's at least an empty array
        }

        // dd($this->selectedModel->productSubscription()->get());

        $this->periods = $this->selectedModel->productSubscription()
            ->get()
            ->map(function ($item) {
                return [
                    'startDay' => $item->startDay,
                    'endDay'   => $item->endDay,
                    'price'    => $item->price,
                    'package_name' => $item->package_name
                ];
            })
            ->toArray();


        if (!$this->customFields || $this->customFields->isEmpty()) {
            if ($this->vendor_type_id) {
                $this->customFields = CustomField::whereHas('vendorType', function ($query) {
                    $query->where('vendor_type_id', $this->vendor_type_id); // Filter based on vendor type
                })->get();
            } else {
                $this->customFields = []; // Fallback to empty if no vendor type
            }
        }

        // Load custom field values from the product
        if (isset($this->selectedModel->custom_field_values)) {
            $customFieldValues = json_decode($this->selectedModel->custom_field_values, true);

            // Initialize customFieldValues if the product has any custom fields
            $this->customFieldValues = [];

            // Iterate through each custom field to assign its value
            foreach ($this->customFields as $customField) {
                if (isset($customFieldValues[$customField->id])) {
                    // Assign the value from decoded JSON to the custom field value
                    $this->customFieldValues[$customField->id] = $customFieldValues[$customField->id];
                } else {
                    // Default to null or empty array if no value exists for this field
                    $this->customFieldValues[$customField->id] = $customField->type == 'checkbox' || $customField->type == 'radio' ? [] : null;
                }
            }
        } else {
            // Initialize customFieldValues with default values if no custom field values exist
            $this->customFieldValues = [];
            foreach ($this->customFields as $customField) {
                // Default value initialization based on the field type
                if ($customField->type == 'checkbox' || $customField->type == 'radio') {
                    $this->customFieldValues[$customField->id] = []; // For multiple options
                } else {
                    $this->customFieldValues[$customField->id] = null; // Default for text, dropdown, etc.
                }
            }
        }

        //load option groups
        $this->optionGroups = [];
        $optionGroups = $this->selectedModel->optionGroups;
        foreach ($optionGroups as $optionGroup) {
            $optionGroupOptions = [];

            foreach ($optionGroup->options as $option) {
                $optionGroupOptions[] = [
                    "id" => $option->id,
                    'name' => $option->name,
                    'price' => $option->price,
                ];
            }

            $this->optionGroups[] = [
                "id" => $optionGroup->id,
                'name' => $optionGroup->name,
                'required' => $optionGroup->required,
                'multiple' => $optionGroup->multiple,
                'max_options' => $optionGroup->max_options,
                'options' => $optionGroupOptions,
            ];
        }


        $this->vendorID = $this->selectedModel->vendor_id;
        $this->emit('preselectedVendorEmit', $this->selectedModel->vendor->name ?? "");
        // categories
        $this->categoriesIDs = $this->selectedModel->categories()->pluck('category_id')->map(fn($id) => (int)$id);
        $this->selectedCategories = Category::whereIn('id', $this->categoriesIDs)->get();
        $this->loadSubcategoriesSelector();
        //subcategories
        $this->subCategoriesIDs = $this->selectedModel->sub_categories()->pluck('subcategory_id')->map(fn($id) => (int)$id);
        $this->selectedSubcategories = Subcategory::whereIn('id', $this->subCategoriesIDs)->get();
        //sub sub categories
        $this->subSubCategoriesIDs = $this->selectedModel->sub_sub_categories()->pluck('sub_sub_category_id')->map(fn($id) => (int)$id);
        $this->selectedSubSubcategories = SubSubCategory::whereIn('id', $this->subSubCategoriesIDs)->get();
        $this->selectedSubcategoryIds = $this->subCategoriesIDs;
        // $this->selectedSubcategories = $this->selectedModel->sub_sub_categories()->pluck('id');

        // ✅ Add these lines to populate the Livewire-bound arrays
        $this->categories = $this->categoriesIDs->toArray();
        $this->sub_categories = $this->subCategoriesIDs->toArray();
        $this->sub_sub_categories = $this->subSubCategoriesIDs->toArray();

        //tags
        $this->selectedTagIds = $this->selectedModel->tags->pluck('id');
        $this->selectedTags = Tag::whereIn('id', $this->selectedTagIds)->get();
        //menus
        $this->selectedMenuIds = $this->selectedModel->menus->pluck('id');
        $this->selectedMenus = Menu::whereIn('id', $this->selectedMenuIds)->get();
        $this->selectedAmenities = json_decode($this->selectedModel->amenities, true);
        //clear filepond
        $this->emit('filePondClear');
        //load photos and emit event to show them in filepond
        $mPhotos = $this->selectedModel->getMedia();
        foreach ($mPhotos as $photo) {
            $this->emit('filepond-add-file', "#editProductInput", $photo->getUrl(), $photo->file_name);
        }
        // $this->photos = [];
        $this->showEdit = true;
        //load summernote with selected product description
        $this->emit('showEditModal');
        $this->emit('loadSummerNote', "editContent", $this->description);
        // $this->emit('initializeUpdateSelect2');
        $this->emit('initializeUpdateSelect2');
        $payload = [
            "value" => $this->vendorID,
            "name" => 'vendor_id',
        ];
        $this->emit('vendor_idUpdated', $payload);
    }

    public function update()
    {
        //validate
        $this->validate(
            [
                "name" => "required|string",
                "price" => "nullable|numeric",
                "vendorID" => "required|exists:vendors,id",
            ]
        );

        $this->validatePhotos();

        try {

            DB::beginTransaction();
            $model = $this->selectedModel;
            $model->name = $this->name;
            $model->sku = $this->sku ?? null;
            $model->barcode = $this->barcode ?? null;
            $model->description = $this->description;
            $model->price = $this->price;
            $model->discount_price = $this->discount_price;
            $model->capacity = $this->capacity;
            $model->unit = $this->unit;
            $model->package_count = $this->package_count;
            $model->available_qty = $this->available_qty; //!empty($this->available_qty) ? $this->available_qty : null;
            $model->vendor_id = $this->vendorID;
            $model->vendor_type_id = $this->vendor_type_id;
            $model->plus_option = $this->plus_option ?? true;
            $model->digital = $this->digital;
            $model->deliverable = $this->digital ? false : $this->deliverable;
            $model->is_active = $this->isActive;
            $model->in_order = $this->in_order;
            $model->age_restricted = $this->age_restricted;
            $model->address = $this->address;
            $model->ad_type = $this->ad_type;
            $model->commentable = $this->commentable;
            $model->faq_visible = $this->faq_visible;
            $model->expiry_date = $this->expiry_date;
            $model->subscription = $this->subscription ?? 'no';

            foreach ($this->customFieldFiles as $fieldId => $file) {
                if ($file) {
                    $filePath = $file->store('custom_field_files', 'public'); // Store file
                    $this->customFieldValues[$fieldId] = $filePath;
                }
            }

            $model->custom_field_values = json_encode($this->customFieldValues);
            $model->brand_id = $this->brand_id;
            $amenityIds = collect($this->amenities)->pluck('id')->toArray();
            $model->amenities = json_encode($amenityIds);

            $model->save();
            // $model->categories()->sync($this->categories);
            // $model->sub_categories()->sync($this->sub_categories);
            // $model->sub_sub_categories()->sync($this->sub_sub_categories);
            $model->categories()->sync($this->categories);
            $model->sub_categories()->sync($this->sub_categories);
            $model->sub_sub_categories()->sync($this->sub_sub_categories);
            $model->tags()->sync($this->selectedTags);
            $model->menus()->sync($this->selectedMenus);

            // Handle variant prices
            if ($this->variant_price_enabled && !empty($this->variantPrices)) {
                // Remove old variants for this product
                $model->variants()->delete();

                // Save the new/updated variants
                foreach ($this->variantPrices as $variant) {
                    // Skip empty variants
                    if (!empty($variant['name']) && $variant['price'] !== null) {
                        $model->variants()->create([
                            'name'  => $variant['name'],
                            'price' => $variant['price'],
                        ]);
                    }
                }
            } else {
                // If variant pricing disabled, remove any existing variants
                $model->variants()->delete();
            }


            if ($this->photos) {

                $model->clearMediaCollection();
                foreach ($this->photos as $photo) {
                    $model->addMedia($photo)
                        ->usingFileName(genFileName($photo))
                        ->toMediaCollection();
                }
                $this->photos = null;
            }

            if ($this->digitalFile && $this->digital) {

                $model->clearDigitalFiles();
                $model->saveDigitalFile($this->digitalFile);
                // collect($this->digitalFiles)->each(
                //     function ($digitalFile)use ($model) {
                //         $model->saveDigitalFile($digitalFile);
                //     }
                // );
                $this->digitalFile = null;
            }
            //remove null values from the array
            // $categories = Category::whereIn('id', $this->categoriesIDs)->get();
            // $this->categoriesIDs = $categories->pluck('id')->toArray();
            // $subCategories = Subcategory::whereIn('id', $this->subCategoriesIDs)->get();
            // $this->subCategoriesIDs = $subCategories->pluck('id')->toArray();
            //
            // $model->categories()->sync($this->categoriesIDs);
            // $model->sub_categories()->sync($this->subCategoriesIDs);
            // $model->tags()->sync($this->selectedTags);
            // $model->menus()->sync($this->selectedMenus);

            //loop through the option groups
            $vendorId = $model->vendor_id;
            // foreach ($this->optionGroups as $mOptionGroup) {
            //     $optionGroup = OptionGroup::updateOrCreate([
            //         "id" => $mOptionGroup['id'],
            //         "vendor_id" => $vendorId,
            //     ], [
            //         "name" => $mOptionGroup['name'],
            //         "multiple" => $mOptionGroup['multiple'],
            //         "required" => $mOptionGroup['required'],
            //         "max_options" => $mOptionGroup['max_options'] ?? null,
            //     ]);
            //     //sync the options
            //     $mOptionGroupOptions = collect($mOptionGroup['options']);
            //     foreach ($mOptionGroupOptions as $mOptionGroupOption) {
            //         $option = Option::updateOrCreate([
            //             "id" => $mOptionGroupOption['id'],
            //             "vendor_id" => $vendorId,
            //         ], [
            //             "name" => $mOptionGroupOption['name'],
            //             "price" => $mOptionGroupOption['price'],
            //             "product_id" => $model->id,
            //             "is_active" => true,
            //         ]);
            //         //sync the option with the option group
            //         $option->option_group_id = $optionGroup->id;
            //         $option->save();
            //         //sync the option with the product
            //         $option->products()->syncWithoutDetaching($model->id);
            //     }
            // }

            foreach ($this->optionGroups as $mOptionGroup) {
                $optionGroup = OptionGroup::updateOrCreate(
                    [
                        "id" => $mOptionGroup['id'],
                        "vendor_id" => $vendorId,
                    ],
                    [
                        "name" => $mOptionGroup['name'],
                        "multiple" => $mOptionGroup['multiple'],
                        "required" => $mOptionGroup['required'],
                        "max_options" => $mOptionGroup['max_options'] ?? null,
                    ]
                );

                // Get current option IDs from UI
                $currentOptionIds = collect($mOptionGroup['options'])
                    ->pluck('id')
                    ->filter() // remove nulls for new options
                    ->toArray();

                // Delete old options that are not in current options
                Option::where('option_group_id', $optionGroup->id)
                    ->whereNotIn('id', $currentOptionIds)
                    ->delete();

                // Create/update current options
                foreach ($mOptionGroup['options'] as $mOptionGroupOption) {
                    $option = Option::updateOrCreate(
                        [
                            "id" => $mOptionGroupOption['id'] ?? null,
                            "vendor_id" => $vendorId,
                        ],
                        [
                            "name" => $mOptionGroupOption['name'],
                            "price" => $mOptionGroupOption['price'],
                            "product_id" => $model->id,
                            "is_active" => true,
                        ]
                    );

                    $option->option_group_id = $optionGroup->id;
                    $option->save();

                    $option->products()->syncWithoutDetaching($model->id);
                }
            }


            // Store subscription periods if "yes"
            // if ($this->subscription === 'yes' && !empty($this->periods)) {
            //     foreach ($this->periods as $period) {
            //         if (!empty($period['startDay']) && !empty($period['endDay'])) {
            //             \App\Models\ProductSubscription::create([
            //                 'product_id' => $model->id,
            //                 'startDay'  => $period['startDay'],
            //                 'endDay'    => $period['endDay'],
            //                 'price'      => $period['price'] ?? 0,
            //                 'package_name' => $period['packageName'] ?? '',
            //             ]);
            //         }
            //     }
            // }
            if ($this->subscription === 'yes' && !empty($this->periods)) {
                // Remove old subscription periods first
                \App\Models\ProductSubscription::where('product_id', $model->id)->delete();

                foreach ($this->periods as $period) {
                    if (!empty($period['startDay']) && !empty($period['endDay'])) {
                        \App\Models\ProductSubscription::create([
                            'product_id'   => $model->id,
                            'startDay'     => $period['startDay'],
                            'endDay'       => $period['endDay'],
                            'price'        => $period['price'] ?? 0,
                            'package_name' => $period['package_name'] ?? '', // make sure name matches Alpine.js
                        ]);
                    }
                }
            } else {
                // If subscription = no, remove any existing subscription periods
                \App\Models\ProductSubscription::where('product_id', $model->id)->delete();
            }


            DB::commit();

            $this->dismissModal();
            // $this->reset();
            // $this->resetExcept([
            //     'filters',
            // ]);
            $this->showSuccessAlert(__("Product") . " " . __('updated successfully!'));
            // ensure any table components refresh
            $this->emit('refreshTable');
            // dispatch a browser event so the client can reload the page
            $this->dispatchBrowserEvent('reloadPage');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Product") . " " . __('updated failed!'));
        }
    }

    public function validatePhotos()
    {
        //check the length of the selected photos
        $maxPhotoCount = (int) setting('filelimit.max_product_images', 3);
        if ($this->photos != null && count($this->photos) > $maxPhotoCount) {
            $errorMsg = __("You can only select") . " " . $maxPhotoCount . " " . __("photos");
            $this->addError('photos', $errorMsg);
            return;
        }
    }

    //
    public function textAreaChange($data)
    {
        $this->description = $data;
    }

    public function updatedVendorTypeId($value)
    {
        $this->customFields = CustomField::whereHas('vendorType', function ($query) {
            $query->where('vendor_type_id', $this->vendor_type_id);
        })->get();

        $this->customFieldValues = [];
        foreach ($this->customFields as $customField) {
            // Initialize values to null or default value based on field type
            if ($customField->type == 'checkbox' || $customField->type == 'radio') {
                $this->customFieldValues[$customField->id] = []; // For multiple options like checkbox/radio
            } else {
                $this->customFieldValues[$customField->id] = null;  // Default for text or dropdown
            }
        }
        $this->vendors = Vendor::where('vendor_type_id', $value)->get();

        if ($value) {
            $this->amenities = Amenity::where('vendor_type_id', $value)->pluck('id')->toArray();
        } else {
            $this->amenities = [];
        }

        if ($this->editing == true) {
            $this->emit('initializeUpdatedSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }

    public function updatedVendorId($value)
    {
        if ($this->editing == true) {
            $this->emit('initializeUpdatedSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }

    public function updatedBrandId($value)
    {
        if ($this->editing == true) {
            $this->emit('initializeUpdatedSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }

    public function updatedPhotos($value)
    {
        if ($this->editing == true) {
            $this->emit('initializeUpdatedSelect2');
        } else {
            $this->emit('initializeSelect2');
        }
    }

    public function vendorChange($data)
    {
        $this->vendorID = $data;
        $this->vendor = Vendor::find($this->vendorID);
        $vendor = $this->vendor;
        if (!empty($vendor) && !empty($vendor->vendor_type_id)) {
            $this->categorySearchClause = ['vendor_type_id' => $vendor->vendor_type_id];
            $this->emit('categoryQueryClasueUpdate', $this->categorySearchClause);
        }
    }

    public function autocompleteVendorSelected($vendor)
    {
        $this->vendorID = $vendor["id"];
        $this->vendor = Vendor::find($this->vendorID);
        $this->emit('vendor_idUpdated', [
            'value' => $this->vendorID,
            "name" => "vendor_id",
        ]);
        //
        $this->emit('vendor_type_idUpdated', [
            'value' => $this->vendor->vendor_type->id ?? "",
            "name" => "vendor_type_id",
        ]);

        $this->vendor_type_id = $this->vendor->vendor_type->id ?? null;

        // Optionally filter the vendors list after selection
        if ($this->vendor_type_id) {
            // Update the vendors list to show only vendors of the selected type
            $this->vendors = Vendor::where('vendor_type_id', $this->vendor_type_id)->get();
        }
    }


    //
    public function photoSelected($photos)
    {
        $this->photos = $photos;
    }


    public function getVendors()
    {
        $vendors = [];
        if (User::find(Auth::id())->hasRole('admin')) {
            $this->vendorID = Vendor::active()->first()->id ?? null;
            $vendors = Vendor::where('vendor_type_id', $this->vendor_type_id)->active()->get();
        } else {
            $this->vendorID = Auth::user()->vendor_id;
            $vendors = Vendor::where('vendor_type_id', $this->vendor_type_id)->where('id', $this->vendorID)->get();
        }
        return $vendors;
    }

    public function getCategories()
    {
        $selectedVendor = Vendor::find($this->vendorID);
        return Category::where('vendor_type_id', $selectedVendor->vendor_type_id ?? "")->get();
    }

    public function setOutOfStock($id)
    {
        try {

            DB::beginTransaction();
            $product = Product::find($id);
            $product->available_qty = 0;
            $product->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Product") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Product") . " " . __('updated failed!'));
        }
    }

    public function showForm()
    {
        return view('livewire.bulk-upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();

        $rows = array_map('str_getcsv', file($path));
        $header = array_map('trim', $rows[0]);
        unset($rows[0]);

        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                $data = array_combine($header, $row);

                $model = new Product();
                $model->name = $data['name'];
                $model->sku = $data['sku'] ?? null;
                $model->barcode = $data['barcode'] ?? null;
                $model->description = $data['description'];
                $model->price = $data['price'];
                $model->discount_price = $data['discount_price'];
                $model->capacity = $data['capacity'];
                $model->unit = $data['unit'];
                $model->package_count = $data['package_count'];
                $model->available_qty = $data['available_qty'] ?? null;
                $model->vendor_id = $data['vendor_id'] ?? auth()->user()->vendor_id;
                $model->vendor_type_id = $data['vendor_type_id'];
                $model->featured = filter_var($data['featured'], FILTER_VALIDATE_BOOLEAN);
                $model->plus_option = filter_var($data['plus_option'], FILTER_VALIDATE_BOOLEAN);
                $model->digital = filter_var($data['digital'], FILTER_VALIDATE_BOOLEAN);
                $model->deliverable = $model->digital ? false : filter_var($data['deliverable'], FILTER_VALIDATE_BOOLEAN);
                $model->is_active = $data['is_active'];
                $model->in_order = filter_var($data['in_order'], FILTER_VALIDATE_BOOLEAN);
                $model->age_restricted = filter_var($data['age_restricted'], FILTER_VALIDATE_BOOLEAN);
                $model->brand_id = $data['brand_id'];
                $model->address = $data['address'];
                $model->ad_type = $data['ad_type'];
                $model->commentable = filter_var($data['commentable'], FILTER_VALIDATE_BOOLEAN);
                $model->faq_visible = filter_var($data['faq_visible'], FILTER_VALIDATE_BOOLEAN);
                $model->expiry_date = $data['expiry_date'];
                $model->subscription = $data['subscription'] ?? 'no';

                $amenities = json_decode($data['amenities'], true) ?? [];
                $model->amenities = json_encode($amenities);
                $model->custom_field_values = null; // no custom field here

                $model->save();

                // sync categories/subcategories/tags/menus
                $model->categories()->sync(json_decode($data['categories'], true) ?? []);
                $model->sub_categories()->sync(json_decode($data['sub_categories'], true) ?? []);
                $model->sub_sub_categories()->sync(json_decode($data['sub_sub_categories'], true) ?? []);
                $model->tags()->sync(json_decode($data['tags'], true) ?? []);
                $model->menus()->sync(json_decode($data['menus'], true) ?? []);

                // handle option groups
                $vendorId = $model->vendor_id;
                $optionGroups = json_decode($data['option_groups'], true) ?? [];
                foreach ($optionGroups as $mOptionGroup) {
                    $optionGroup = OptionGroup::updateOrCreate(
                        [
                            "name" => $mOptionGroup['name'],
                            "vendor_id" => $vendorId,
                        ],
                        [
                            "multiple" => $mOptionGroup['multiple'],
                            "required" => $mOptionGroup['required'],
                            "max_options" => $mOptionGroup['max_options'] ?? null,
                        ]
                    );

                    foreach ($mOptionGroup['options'] as $mOptionGroupOption) {
                        $option = Option::updateOrCreate(
                            [
                                "name" => $mOptionGroupOption['name'],
                                "vendor_id" => $vendorId,
                                "product_id" => $model->id,
                            ],
                            [
                                "price" => $mOptionGroupOption['price'],
                                "is_active" => true,
                            ]
                        );
                        $option->option_group_id = $optionGroup->id;
                        $option->save();
                        $option->products()->syncWithoutDetaching($model->id);
                    }
                }

                // handle subscription periods
                if ($data['subscription'] === 'yes') {
                    $periods = json_decode($data['periods'], true) ?? [];
                    foreach ($periods as $period) {
                        \App\Models\ProductSubscription::create([
                            'product_id' => $model->id,
                            'startDay' => $period['startDay'],
                            'endDay' => $period['endDay'],
                            'price' => $period['price'] ?? 0,
                            'package_name' => $period['packageName'] ?? '',
                        ]);
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Bulk products uploaded successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return back()->with('error', $ex->getMessage());
        }
    }

    public function addVariant()
    {
        $this->variantPrices[] = [
            'name' => '',
            'price' => 0,
        ];
    }

    // Remove variant row
    public function removeVariant($index)
    {
        unset($this->variantPrices[$index]);
        $this->variantPrices = array_values($this->variantPrices); // reindex
    }
}
