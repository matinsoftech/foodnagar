<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Tag;
use App\Models\AppModule;
use App\Models\VendorType;
use Illuminate\Support\Facades\DB;

class TagLivewire extends BaseLivewireComponent
{

    //
    public $model = Tag::class;
    public $name;
    public $vendor_type_id;
    public $types = [];


    protected $rules = [
        "name" => "required|string",
    ];
    public function goBack()
    {
        $this->reset(['showCreate', 'showEdit']);
    }

    public function resetForm()
    {
        $this->reset(['name', 'vendor_type_id']);
    }

    public function render()
    {
        // if (empty($this->types)) {
        //     $this->types = VendorType::distinct()->whereNotIn('slug', ['parcel', 'package', 'taxi'])->get();
        // }
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
        if (empty($this->types)) {
            $this->types =$mVendorTypes;
        }
        return view('livewire.tag');
    }

    public function save()
    {
        //validate
        $this->validate();

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model = new Tag();
            $model->name = $this->name;
            $model->vendor_type_id = $this->vendor_type_id;
            $model->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Tag") . " " . __('created successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Tag") . " " . __('creation failed!'));
        }
    }

    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->name = $this->selectedModel->name;
        $this->vendor_type_id = $this->selectedModel->vendor_type_id;
        $this->emit('showEditModal');
    }

    public function update()
    {
        //validate
        $this->validate();

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model = $this->selectedModel;
            $model->name = $this->name;
            $model->vendor_type_id = $this->vendor_type_id;
            $model->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Tag") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Tag") . " " . __('updated failed!'));
        }
    }
}
