<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Inventory\Supplier;
use App\View\Components\Tenant\BackendLayout;
use App\View\Components\TenAppLayout;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;
use Livewire\Component;

class SupplierManager extends Component
{

    public $suppliers;
    public $supplier;
    public $isOpen = false;

    public $provinces;
    public $districts;
    public $wards;

    public $submitLabel;

    protected $rules = [
        'supplier.company_name'     => 'required|string',

        'supplier.field'     => 'nullable|string',
        'supplier.ranking'     => 'nullable|string',

        'supplier.contact_name'     => 'required|string',
        'supplier.contact_title'     => 'nullable|string',

        'supplier.address'    => 'nullable|string',
        'supplier.province_id'   => 'nullable|integer',
        'supplier.district_id'     => 'nullable|integer',
        'supplier.ward_id'     => 'nullable|integer',

        'supplier.phone'     => 'nullable|string',
        'supplier.email'     => 'nullable|string',
        'supplier.website'     => 'nullable|string',
        'supplier.note'     => 'nullable|string',
    ];

    public function mount() {
        $this->loadSuppliers();
        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->districts = collect();
        $this->wards = collect();
    }

    public function loadSuppliers()
    {
        $this->suppliers = Supplier::all();
    }

/*     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    public function updatedsupplierProvinceId($value)
    {
        $this->validateOnly($value);
        $this->districts = District::where('province_id', $value)->get();
    }

    public function updatedsupplierDistrictId($value)
    {
        $this->validateOnly($value);
        $this->wards = Ward::where('district_id', $value)->get();
    }

    public function render()
    {
        return view('livewire..tenant.backend.inventory.supplier-manager')->layout(BackendLayout::class);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetsupplierFields(){
        $this->reset('supplier'); 
    }

    public function create()
    {
        $this->resetsupplierFields();
        $this->openModal();
        $this->submitLabel = "Thêm mới";
        $this->supplier = new Supplier();
        /* $this->supplier->type = '{"value": "shop", "label": "Cửa hàng"}'; */
    }

    public function store()
    {
        $this->validate();

        try {
            $this->supplier->save();
            $this->closeModal();
            $this->resetsupplierFields();
            session()->flash('success', $this->submitLabel.' nhà cung cấp thành công!');
            $this->loadSuppliers();
        } catch (\Exception $ex) {
            session()->flash('error', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại.'.$ex);
        }
    }

    public function edit($id)
    {
        $this->resetsupplierFields();
        $this->submitLabel = "Cập nhật";
        $this->openModal();
        $this->supplier = Supplier::findOrFail($id);
    }

    public function delete($id)
    {
        if($id === 1) {
            session()->flash('warning', 'Không thể xóa nhà cung cấp mặc định.');
            return;
        }
        $deleted_supplier = Supplier::find($id);
        $deleted_supplier->delete();
        session()->flash('success', 'Xóa nhà cung cấp '.$deleted_supplier->name.' thành công!');
        $this->loadSuppliers();
    }

}
