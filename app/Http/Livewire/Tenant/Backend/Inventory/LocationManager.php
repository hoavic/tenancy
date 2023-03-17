<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\iNVENTORY\Location;
use App\View\Components\TenAppLayout;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;
use Livewire\Component;

class LocationManager extends Component
{

    public $locations;
    public $location;
    public $isOpen = false;

    public $provinces;
    public $districts;
    public $wards;

    public $submitLabel;

    protected $rules = [
        'location.name'     => 'required|string',
        'location.type'     => 'required|string',

        'location.address'    => 'nullable|string',
        'location.province_id'   => 'nullable|integer',
        'location.district_id'     => 'nullable|integer',
        'location.ward_id'     => 'nullable|integer',

        'location.phone'     => 'nullable|string',
        'location.note'     => 'nullable|string',
        'location.operating_time'     => 'nullable|string',
    ];

    public function mount() {
        $this->loadLocations();
        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->districts = collect();
        $this->wards = collect();
    }

    public function loadLocations()
    {
        $this->locations = Location::all();
    }

/*     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    public function updatedLocationProvinceId($value)
    {
        $this->validateOnly($value);
        $this->districts = District::where('province_id', $value)->get();
    }

    public function updatedLocationDistrictId($value)
    {
        $this->validateOnly($value);
        $this->wards = Ward::where('district_id', $value)->get();
    }

    public function render()
    {
        return view('livewire..tenant.backend.inventory.location-manager')->layout(TenAppLayout::class);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetLocationFields(){
        $this->reset('location'); 
    }

    public function create()
    {
        $this->resetLocationFields();
        $this->openModal();
        $this->submitLabel = "Thêm mới";
        $this->location = new Location();
        /* $this->location->type = '{"value": "shop", "label": "Cửa hàng"}'; */
    }

    public function store()
    {
        $this->validate();

        try {
            $this->location->save();
            $this->closeModal();
            $this->resetLocationFields();
            session()->flash('success', $this->submitLabel.' địa điểm thành công!');
            $this->loadLocations();
        } catch (\Exception $ex) {
            session()->flash('error', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại.'.$ex);
        }
    }

    public function edit($id)
    {
        $this->resetLocationFields();
        $this->submitLabel = "Cập nhật";
        $this->openModal();
        $this->location = Location::findOrFail($id);
    }

    public function delete($id)
    {
        if($id === 1) {
            session()->flash('warning', 'Không thể xóa địa điểm mặc định.');
            return;
        }
        $deleted_location = Location::find($id);
        $deleted_location->delete();
        session()->flash('success', 'Xóa địa điểm '.$deleted_location->name.' thành công!');
        $this->loadLocations();
    }
}
