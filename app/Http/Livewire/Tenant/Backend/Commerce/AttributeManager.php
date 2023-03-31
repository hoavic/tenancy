<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use App\Traits\Tenant\Backend\WithTopAction;
use App\View\Components\Tenant\BackendLayout;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeManager extends Component
{

    use WithPagination, WithTopAction, WithModal, WithDeleteConfirm;

    public $submitLabel;

    public Attribute $attribute;

    public $showAddValue = false;

    public Attribute $attributeSelected;
    public AttributeValue $attributeValue;

    protected $rules = [
        'attribute.visual' => 'required|string',
        'attribute.name' => 'required|string',
        'attribute.group' => 'nullable|string',

        'attributeValue.attribute_id' => 'nullable|integer',
        'attributeValue.label' => 'nullable|string',
        'attributeValue.value' => 'nullable|string',
    ];

    public function mount() {

        $this->attribute = new Attribute();
    }

    public function create() {
        $this->submitLabel = 'Thêm mới';
        $this->showModal();
        $this->attribute = new Attribute();
    }

    public function edit($id)
    {
        $this->submitLabel = 'Cập nhật';
        $this->showModal();
        $this->attribute = Attribute::find($id);
    }

    public function store() 
    {
        $this->validate();
        $this->attribute->save();
        session()->flash('success', 'Thành công');
        $this->submitLabel = 'Cập nhật';
        $this->hideModal();
        try {    

        } catch (\Exception $ex) {
            session()->flash('error', 'Hieern thij xlooi'.$ex);
        }
    }

    public function delete() {
        Attribute::destroy($this->deleteId);
        $this->hideConfirmModal();
        session()->flash('success', 'Xóa thành công!');
    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire..tenant.backend.commerce.attribute-manager', [
            'attributes' => Attribute::where('name','like', $search)->paginate($this->perPage),
        ])->layout(BackendLayout::class);
    }

    protected function validateMultiple($fields){
        foreach($fields as $field){
            $this->validateOnly( $field);
        }
    }

    //Value
    public function addValue($id)
    {
        $this->attributeValue = new AttributeValue();
        $this->showAddValue = true;
        $this->attributeSelected = Attribute::find($id);
        $this->attributeValue->attribute_id = $id;
    }

    public function storeValue()
    {
        $this->attributeValue->save();
        $this->showAddValue = false;
    }
}
