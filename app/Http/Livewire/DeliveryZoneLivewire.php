<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\DeliveryZone;
use App\Models\DeliveryZonePoint;
use App\Traits\GoogleMapApiTrait;
use Illuminate\Support\Facades\DB;

class DeliveryZoneLivewire extends BaseLivewireComponent
{

    use GoogleMapApiTrait;

    public $model = DeliveryZone::class;
    public $name;
    public $delivery_fee;
    public $is_active;
    public $coordinates;
    public $coordinateCollection;
    public $delivery_fee_type = 'base';

    protected $rules = [
        "name" => "required",
        "delivery_fee" => "nullable|numeric",
        "coordinates" => "required",
    ];

    public $delivery_fee_rules = [
        'below_100' => 40,
        'between_101_200' => 20,
        'above_300' => 0,
    ];


    public function getListeners()
    {
        return $this->listeners + [
            'selectedCoordinates' => 'selectedCoordinates',
        ];
    }

    public function goBack()
    {
        $this->reset(['showCreate', 'showEdit']);
    }
    public function render()
    {
        return view('livewire.delivery_zones');
    }


    public function selectedCoordinates($coordinates)
    {
        $this->coordinateCollection = $coordinates;
        $this->coordinates = "";
        //
        foreach ($coordinates as $coordinate) {
            $this->coordinates .= "(" . $coordinate['lat'] . "," . $coordinate['lng'] . "), ";
        }
    }


    //
    function save()
    {

        $this->validate();

        try {

            //
            if ($this->coordinateCollection == null || empty($this->coordinateCollection)) {
                $this->showErrorAlert(__("Coordinates is required"));
                return;
            }

            //
            $centerCoordinate = $this->getCenter($this->coordinateCollection);
            $centerCoordinateDistance = $this->getLinearDistance(
                "" . $centerCoordinate[0] . "," . $centerCoordinate[1] . "",
                "" . $this->coordinateCollection[0]['lat'] . "," . $this->coordinateCollection[0]['lng'] . "",
            );

            DB::beginTransaction();
            $deliveryZone = new DeliveryZone();
            $deliveryZone->name = $this->name;
            $deliveryZone->delivery_fee = $this->delivery_fee;

            $deliveryZone->latitude = $centerCoordinate[0];
            $deliveryZone->longitude = $centerCoordinate[1];
            $deliveryZone->radius = $centerCoordinateDistance;
            //
            $deliveryZone->is_active = $this->is_active ?? false;

            if ($this->delivery_fee_type == 'base') {
                $deliveryZone->delivery_fee = 40; // fixed base
                $deliveryZone->delivery_fee_rules = null;
            } else {
                $deliveryZone->delivery_fee = null;
                $deliveryZone->delivery_fee_rules = json_encode($this->delivery_fee_rules);
            }
            $deliveryZone->save();
            //points
            foreach ($this->coordinateCollection as $coordinate) {
                $deliveryZonePoint = new DeliveryZonePoint();
                $deliveryZonePoint->delivery_zone_id = $deliveryZone->id;
                $deliveryZonePoint->lat = $coordinate['lat'];
                $deliveryZonePoint->lng = $coordinate['lng'];
                $deliveryZonePoint->save();
            }

            DB::commit();
            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Delivery Zone") . " " . __('created successfully!'));
            $this->emit('resetMap');
            $this->emit('refreshTable');
        } catch (\Exception $ex) {
            DB::rollback();
            logger("Error", [$ex]);
            $this->showErrorAlert($ex->getMessage() ?? __("Delivery Zone") . " " . __('creation failed!'));
        }
    }


    //
    public function initiateEdit($id)
    {
        $this->selectedModel = $this->model::find($id);
        $this->name = $this->selectedModel->name;
        $this->delivery_fee = $this->selectedModel->delivery_fee;
        $this->is_active = $this->selectedModel->is_active;
        // $this->delivery_fee_type = $this->selectedModel->delivery_fee_type;
        $this->delivery_fee_type = $this->selectedModel->delivery_fee_rules ? 'tiered' : 'base';

        $this->delivery_fee_rules = json_decode($this->selectedModel->delivery_fee_rules, true) ?? $this->delivery_fee_rules;
        //
        $coordinates = [];
        foreach ($this->selectedModel->points as $point) {
            $coordinates[] = [
                "lat" => (float) $point->lat,
                "lng" => (float) $point->lng,
            ];
        }

        $this->selectedCoordinates($coordinates);
        $this->emit('initiateEditMap', $coordinates);
        $this->showEditModal();
    }


    function update()
    {

        $this->validate();

        try {

            //
            $centerCoordinate = $this->getCenter($this->coordinateCollection);
            $centerCoordinateDistance = $this->getLinearDistance(
                "" . $centerCoordinate[0] . "," . $centerCoordinate[1] . "",
                "" . $this->coordinateCollection[0]['lat'] . "," . $this->coordinateCollection[0]['lng'] . "",
            );


            DB::beginTransaction();
            $deliveryZone = $this->selectedModel;
            $deliveryZone->name = $this->name;

            $deliveryZone->latitude = $centerCoordinate[0];
            $deliveryZone->longitude = $centerCoordinate[1];
            $deliveryZone->radius = $centerCoordinateDistance;


            $deliveryZone->is_active = $this->is_active ?? false;

            // handle fees again — no delivery_fee_type column written!
            if ($this->delivery_fee_type === 'base') {
                $deliveryZone->delivery_fee = 40;
                $deliveryZone->delivery_fee_rules = null;
            } else {
                $deliveryZone->delivery_fee = null;
                $deliveryZone->delivery_fee_rules = json_encode($this->delivery_fee_rules);
            }

            $deliveryZone->save();
            //
            $deliveryZone->points()->delete();
            // //points
            foreach ($this->coordinateCollection as $coordinate) {
                $deliveryZonePoint = new DeliveryZonePoint();
                $deliveryZonePoint->delivery_zone_id = $deliveryZone->id;
                $deliveryZonePoint->lat = $coordinate['lat'];
                $deliveryZonePoint->lng = $coordinate['lng'];
                $deliveryZonePoint->save();
            }

            DB::commit();
            $this->dismissModal();
            $this->reset();
            $this->showSuccessAlert(__("Delivery Zone") . " " . __('created successfully!'));
            $this->emit('refreshTable');
            $this->emit('resetMap');
        } catch (\Exception $ex) {
            DB::rollback();
            logger("Error", [$ex]);
            $this->showErrorAlert($ex->getMessage() ?? __("Delivery Zone") . " " . __('creation failed!'));
        }
    }
}
