<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\VendorType;
use App\Models\DeliveryZone;
use Illuminate\Support\Facades\DB;

class VendorTypeLivewire extends BaseLivewireComponent
{

    //
    public $model = VendorType::class;

    //
    public $name;
    public $color;
    public $description;
    public $isActive;
    public $slug;
    public $types = [];
    public $deliveryZonesIDs;
    public $deliveryZones;


    public function getListeners()
    {
        return $this->listeners + [
            "deliveryZonesChange" => "deliveryZonesChange",
        ];
    }
    public function goBack()
    {
        $this->reset(['showCreate', 'showEdit']);
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'color',
            'isActive',
            'slug',
            'photo',
            'secondPhoto',
            'deliveryZonesIDs',
        ]);

        // Optionally, you can reset validation errors
        $this->showCreate = false;
    }


    public function render()
    {
        if (empty($this->types)) {
            $this->types = VendorType::distinct()->whereNotIn('slug', ['parcel', 'package', 'taxi'])->get(['slug'])->pluck('slug');
        }
        // provide delivery zones so Blade can render select options server-side
        if (empty($this->deliveryZones)) {
            $this->deliveryZones = DeliveryZone::active()->get();
        }
        return view('livewire.vendor_types');
    }


    public function showCreateModal()
    {
        parent::showCreateModal();
        $this->updateDeliveryZoneSelector();
    }

    public function updateDeliveryZoneSelector()
    {
        $deliveryZones = DeliveryZone::active()->get();
        if ($this->showCreate) {
            // pass null for options to avoid client-side JS clearing server-rendered options
            $this->showSelect2("#deliveryZonesSelect2", $this->deliveryZonesIDs, "deliveryZonesChange", null);
        } else {
            $this->showSelect2("#editDeliveryZonesSelect2", $this->deliveryZonesIDs, "deliveryZonesChange", null);
        }
    }

    public function deliveryZonesChange($data)
    {
        $this->deliveryZonesIDs = $data;
    }

    // Updating model
    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->name = $this->selectedModel->name;
        $this->color = $this->selectedModel->color;
        $this->description = $this->selectedModel->description ?? "";
        $this->isActive = $this->selectedModel->is_active;
        $this->deliveryZonesIDs = $this->selectedModel->delivery_zones()->pluck('delivery_zone_id')->toArray();
        // ensure the edit modal flag is set so the view renders the edit select element
        $this->showEditModal();
        // now initialize the select2 for the edit element
        $this->updateDeliveryZoneSelector();
    }

    public function save()
    {
        //validate
        $this->validate(
            [
                "name" => "required|string",
                "description" => "nullable|sometimes|string",
                "photo" => "nullable|sometimes|image|max:" . setting("filelimit.vendor_type", 1024) . "",
                "secondPhoto" => "nullable|sometimes|image|max:" . setting("filelimit.vendor_type", 1024) . "",
            ]
        );

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model = new VendorType();
            $model->name = $this->name;
            $model->color = $this->color ?? "#000000";
            $model->description = $this->description;
            $model->is_active = $this->isActive;
            $model->slug = $this->slug ?? "food";
            $model->save();

            //
            $model->delivery_zones()->sync($this->deliveryZonesIDs);

            if ($this->photo) {

                $model->clearMediaCollection("logo");
                $model->addMedia($this->photo->getRealPath())->toMediaCollection("logo");
                $this->photo = null;
            }

            if ($this->secondPhoto) {

                $model->clearMediaCollection("website_header");
                $model->addMedia($this->secondPhoto->getRealPath())->toMediaCollection("website_header");
                $this->secondPhoto = null;
            }

            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Vendor Type") . " " . __('created successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Vendor Type") . " " . __('creation failed!'));
        }
    }

    public function update()
    {
        //validate
        $this->validate(
            [
                "name" => "required|string",
                "description" => "nullable|sometimes|string",
                "photo" => "nullable|sometimes|image|max:" . setting("filelimit.vendor_type", 1024) . "",
                "secondPhoto" => "nullable|sometimes|image|max:" . setting("filelimit.vendor_type", 1024) . "",
            ]
        );

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model = $this->selectedModel;
            $model->name = $this->name;
            $model->color = $this->color ?? "#000000";
            $model->description = $this->description;
            $model->is_active = $this->isActive;
            $model->save();

            //
            $model->delivery_zones()->sync($this->deliveryZonesIDs);

            if ($this->photo) {

                $model->clearMediaCollection("logo");
                $model->addMedia($this->photo->getRealPath())->toMediaCollection("logo");
                $this->photo = null;
            }

            if ($this->secondPhoto) {

                $model->clearMediaCollection("website_header");
                $model->addMedia($this->secondPhoto->getRealPath())->toMediaCollection("website_header");
                $this->secondPhoto = null;
            }

            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Vendor Type") . " " . __('updated successfully!'));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? __("Vendor Type") . " " . __('updated failed!'));
        }
    }
}
