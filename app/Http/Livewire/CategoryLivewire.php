<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Category;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Support\Facades\DB;

class CategoryLivewire extends BaseLivewireComponent
{

    //
    public $model = Category::class;

    //
    public $name;
    public $color;
    public $isActive;
    public $vendor_type_id;
    public $banner;
    public $bannerInfo;
    public $priority;



    public $categories;
    public $vendorTypes;

    protected $rules = [
        "name" => "required|string",
    ];
    public function goBack()
    {
        // Add logic to go back, e.g., reset the form or change visibility flags
        $this->showCreate = false;
        $this->showEdit = false;
    }
    public function resetForm()
    {
        $this->reset(['name', 'color', 'vendor_type_id', 'photo', 'banner', 'isActive']);
    }
    public function render()
    {
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
        $this->vendorTypes = $mVendorTypes;
        return view('livewire.categories');
    }



    public function save()
    {
        //validate
        $rules = $this->rules;
        $rules["photo"] = "nullable|sometimes|image|max:" . setting("filelimit.category", 300) . "";
        $this->validate($rules);


        try {

            DB::beginTransaction();
            $model = new Category();
            $model->name = $this->name;
            $model->color = $this->color ?? "#000000";
            $model->is_active = $this->isActive ?? false;
            $model->vendor_type_id = $this->vendor_type_id ?? $this->vendorTypes->first()->id;
            $model->priority = $this->priority ?? 0;
            $model->save();

            if ($this->photo) {

                $model->clearMediaCollection();
                $model->addMedia($this->photo->getRealPath())->toMediaCollection();
                $this->photo = null;
            }

            // Handle Banner upload
            if ($this->banner) {
                $model->clearMediaCollection('banner');
                $model->addMedia($this->banner->getRealPath())->toMediaCollection('banner');
                $this->banner = null;
            }

            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Category") . " " . __('created successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Category") . " " . __('creation failed!'));
        }
    }

    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->name = $this->selectedModel->name;
        $this->color = $this->selectedModel->color;
        $this->isActive = $this->selectedModel->is_active;
        $this->vendor_type_id = $this->selectedModel->vendor_type_id ?? $this->vendorTypes->first()->id ?? '';
        $this->priority = $this->selectedModel->priority ?? 0;
        $this->emit('showEditModal');
    }
    public function updatedBanner()
    {
        if ($this->banner) {
            $this->bannerInfo = [
                "size" => number_format($this->banner->getSize() / 1024 / 1024, 2),
                "extension" => $this->banner->getClientOriginalExtension(),
            ];
        }
    }


    public function update()
    {
        //validate
        $rules = $this->rules;
        $rules["photo"] = "nullable|sometimes|image|max:" . setting("filelimit.category", 300) . "";
        $this->validate($rules);

        try {

            DB::beginTransaction();
            $model = $this->selectedModel;
            $model->name = $this->name;
            $model->color = $this->color ?? "#000000";
            $model->is_active = $this->isActive ?? false;
            $model->vendor_type_id = $this->vendor_type_id;
            $model->priority = $this->priority ?? 0;
            $model->save();

            if ($this->photo) {

                $model->clearMediaCollection();
                $model->addMedia($this->photo->getRealPath())->toMediaCollection();
                $this->photo = null;
            }

            if ($this->banner) {
                $model->clearMediaCollection('banner');
                $model->addMedia($this->banner->getRealPath())->toMediaCollection('banner');
                $this->banner = null;
            }

            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Category") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Category") . " " . __('updated failed!'));
        }
    }
}
