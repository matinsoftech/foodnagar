<?php

namespace App\Http\Livewire\Component;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class AutocompleteInput extends Component
{

    public $title;
    public $name;
    public $placeholder;
    public $column = "name";
    public $model;
    public $dataList = [];
    public $extraQueryData = [];
    public $selectedData;
    public $emitFunction;
    public $initialEmit = "initialEmit";
    public $preselectedDeliveryBoyEmit;
    public $queryClause;
    public $customQuery = null;
    public $updateQueryClauseName = 'updateQueryClause';
    public $clear = false;
    public $showClear = false;
    public $disable;
    public $selectedId = null;


    protected function getListeners()
    {
        return [
            $this->updateQueryClauseName => 'updateQueryClause',
            $this->initialEmit => 'initialEmit',
            // listen for preselected events but only prefill if the event is for this model
            'preselectedVendorEmit' => 'prefillVendorName',
            'preselectedCategoryEmit' => 'prefillCategoryName',
        ];
    }

    public function prefillName($value)
    {
        $this->name = $value; // sets the input value
    }

    /**
     * Only prefill when this component is handling a Vendor model
     */
    public function prefillVendorName($value)
    {
        if (class_basename($this->model) === 'Vendor') {
            $this->name = $value;
        }
    }

    /**
     * Only prefill when this component is handling a Category model
     */
    public function prefillCategoryName($value)
    {
        if (class_basename($this->model) === 'Category') {
            $this->name = $value;
        }
    }


    public function mount()
    {
        $this->model = "App\\Models\\" . $this->model;

        // If editing and selectedId is provided
        if ($this->selectedId && class_exists($this->model)) {
            $record = $this->model::find($this->selectedId);
            if ($record && isset($record[$this->column])) {
                $this->name = $record[$this->column]; // Prefill the name on mount
            }
        }
    }

    public function render()
    {
        return view('livewire.component.autocomplete-input');
    }

    public function initialEmit($name = null)
    {
        $this->name = $name;
    }

    public function updateQueryClause($clause)
    {
        $this->queryClause = $clause;
        $this->dataList = [];
        $this->name = "";
    }

    public function updatedName($value)
    {

        if ($this->customQuery != null && !empty($this->customQuery)) {

            switch ($this->customQuery) {
                case 'driver':
                    $this->dataList = User::whereHas('roles', function ($query) {
                        return $query->where('name', "driver");
                    })->where("name", "like", "%" . $value . "%")->limit(10)->get()->toArray();
                    break;
                case 'fleet-driver':
                    $this->dataList = User::whereHas('roles', function ($query) {
                        return $query->where('name', "driver");
                    })
                        ->where("name", "like", "%" . $value . "%")
                        ->whereHas('fleets', function ($query) {
                            return $query->where('id', User::find(Auth::id())->fleet()->id ?? null);
                        })->limit(10)->get()->toArray();
                    break;
                case 'city-admin-products':
                    $this->dataList = Product::with('vendor')->whereHas("vendor", function ($query) {
                        return $query->where('creator_id', Auth::id());
                    })->where("name", "like", "%" . $value . "%")->limit(10)->get()->toArray();
                    break;
                case 'vendor_type':
                    $this->dataList = Vendor::with('vendor_type')->whereHas("vendor_type", function ($query) {
                        return $query->where('slug', $this->extraQueryData[0] ?? "");
                    })->where("name", "like", "%" . $value . "%")->limit(10)->get()->toArray();
                    break;
                case 'vendor_type_service':
                    $this->dataList = Category::with('vendor_type')->whereHas("vendor_type", function ($query) {
                        return $query->where('slug', $this->extraQueryData[0] ?? "");
                    })->where("name", "like", "%" . $value . "%")->limit(10)->get()->toArray();
                    break;

                case 'vendor_vendor_typecategories':
                    $vendorId = Auth::user()->vendor_id ?? null;
                    $vendorTypeId = Vendor::find($vendorId)->vendor_type_id ?? null;
                    $this->dataList = Category::with('vendor_type')
                        ->when($vendorId, function ($q) use ($vendorId) {
                            return $q->orWhereHas("vendors", function ($query) use ($vendorId) {
                                return $query->where('id', $vendorId);
                            });
                        })
                        ->when($vendorTypeId, function ($q) use ($vendorTypeId) {
                            return $q->orWhereHas("vendor_type", function ($query) use ($vendorTypeId) {
                                return $query->where('id', $vendorTypeId);
                            });
                        })
                        ->where("name", "like", "%" . $value . "%")
                        ->limit(10)
                        ->get()
                        ->toArray();
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            $this->dataList = $this->model::where("" . $this->column . "", "like", "%" . $value . "%")->when($this->queryClause, function ($q) {
                return $q->where($this->queryClause);
            })->limit(10)->get()->toArray();
        }
    }

    // public function optionSelected($key)
    // {
    //     if (!array_key_exists($key, $this->dataList)) {
    //         return;
    //     }

    //     //
    //     if (!empty($this->emitFunction)) {
    //         $this->emitUp($this->emitFunction, $this->dataList[$key]);
    //     }
    //     if ($this->clear) {
    //         $this->name = "";
    //     } else {
    //         $this->name = $this->dataList[$key]["name"];
    //     }
    //     $this->dataList = [];
    // }
    public function optionSelected($key)
    {
        if (!array_key_exists($key, $this->dataList)) return;

        $selected = $this->dataList[$key];

        $this->selectedId = $selected['id'];  // store selected ID
        $this->name = $selected['name'];
        $this->dataList = [];

        if (!empty($this->emitFunction)) {
            $this->emitUp($this->emitFunction, $selected);
        }
    }


    public function clearAutocompleteFieldsEvent()
    {
        $this->name = "";
        $this->dataList = [];
    }
}
