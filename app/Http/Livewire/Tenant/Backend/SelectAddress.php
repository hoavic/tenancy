<?php

namespace App\Http\Livewire\Tenant\Backend;

use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;
use Livewire\Component;

class SelectAddress extends Component
{

    public $provinces;
    public $selectedProvince = null;

    public $districts;
    public $selectedDistrict = null;

    public $wards;
    public $selectedWard = null;

    protected $rules = [
        'provinces' => 'string',
        'selectedProvince' => 'nullable|string',
        'districts' => 'string',
        'selectedDistrict' => 'string',
        'wards' => 'string',
    ];

    public function mount() 
    {
        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->districts = collect();
        $this->wards = collect();
    }

    public function render()
    {
        return view('livewire..tenant.backend.select-address');
    }

    public function updatedSelectedProvince($value)
    {
        $this->validateOnly($value);
        if (!is_null($value)) {
            $value = json_decode($value);
            /* dd($value->id); */
            $this->districts = District::where('province_id', $value->id)->get();
        }
    }

    public function updatedSelectedDistrict($value)
    {
        $this->validateOnly($value);
        if (!is_null($value)) {
            $value = json_decode($value);
            /* dd($value->id); */
            $this->wards = Ward::where('district_id', $value->id)->get();
        }
    }

}
