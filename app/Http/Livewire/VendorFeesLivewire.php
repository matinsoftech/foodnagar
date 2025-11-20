<?php
namespace App\Http\Livewire;

use Exception;
use App\Models\Fee;
use Illuminate\Support\Facades\DB;

class VendorFeesLivewire extends BaseLivewireComponent
{

    //
    public $model = Fee::class;

    //
    public $name;
    public $value;
    public $percentage;
    public $for_admin;
    public $is_active;

    public $rules = [
        "name"  => "required",
        "value" => "required|numeric",
    ];

    public function goBack()
    {
        $this->reset(['showCreate', 'showEdit']);
    }
    public function resetForm()
    {
        // Reset all form-related properties here
        $this->name       = '';
        $this->value      = '';
        $this->for_admin  = false;
        $this->percentage = false;
        $this->is_active  = false;

        // Optionally reset any other properties you might be using
    }
    public function render()
    {
        return view('livewire.fees');
    }

    public function save()
    {
        //validate
        $this->validate();

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model             = new Fee();
            $model->name       = $this->name;
            $model->value      = $this->value;
            $model->is_active  = $this->is_active ?? false;
            $model->percentage = $this->percentage ?? false;
            $model->for_admin  = $this->for_admin ?? false;
            $model->save();
            DB::commit();
            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Fee") . " " . __("created successfully!"));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? (__("Fee") . " " . __("creation failed!")));
        }
    }

    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->name          = $this->selectedModel->name;
        $this->value         = $this->selectedModel->value;
        $this->is_active     = $this->selectedModel->is_active;
        $this->percentage    = $this->selectedModel->percentage;
        $this->for_admin     = $this->selectedModel->for_admin;
        $this->emit('showEditModal');
    }

    public function update()
    {
        //validate
        $this->validate();

        try {
            $this->isDemo();
            DB::beginTransaction();
            $model             = $this->selectedModel;
            $model->name       = $this->name;
            $model->value      = $this->value;
            $model->is_active  = $this->is_active ?? false;
            $model->percentage = $this->percentage ?? false;
            $model->for_admin  = $this->for_admin ?? false;
            $model->save();
            DB::commit();

            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Fee") . " " . __("updated successfully!"));
            $this->emit('refreshTable');
        } catch (Exception $error) {
            DB::rollback();
            $this->showErrorAlert($error->getMessage() ?? (__("Fee") . " " . __("updated failed!")));
        }
    }
}
