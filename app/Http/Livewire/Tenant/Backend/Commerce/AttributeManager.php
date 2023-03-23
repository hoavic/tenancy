<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\View\Components\TenAppLayout;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeManager extends Component
{

    use WithPagination;

    public $attributes;
    public Attribute $attribute;
    public Attribute $attributeBeingDeleted;

    public $showAddValue = false;
    public $showEditModal = false;
    public Attribute $attributeSelected;
    public AttributeValue $attributeValue;

    protected $rules = [
        'attribute.visual' => 'required|string',
        'attribute.name' => 'required|string',
        'attribute.group' => 'nullable|string',

        'attributeValue.label' => 'nullable|string',
        'attributeValue.value' => 'required|string',
    ];

    public function mount() {
        $this->loadAttributes();
        $this->attribute = new Attribute();
    }

    public function loadAttributes()
    {
        $this->attributes = Attribute::all();
    }

    public function showCreateModal()
    {

    }

    public function create() {
        $this->save();
        $this->attribute = new Attribute();
    }

    public function edit($id)
    {
        $this->attribute = Attribute::find($id);
        $this->showEditModal = true;
    }

    public function save() 
    {
        $this->validate();
        try {    
            $this->attribute->save();
            $this->loadAttributes();
            session()->flash('success', 'Thành công');

        } catch (\Exception $ex) {
            session()->flash('error', 'Hieern thij xlooi'.$ex);
        }

    }
    
    public function delete($id) {
        Attribute::destroy($id);
        $this->loadAttributes();
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
        $this->validateOnly($this->attributeValue);
        $this->attributeValue->save();
        $this->showAddValue = false;
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.attribute-manager')->layout(TenAppLayout::class);
    }
}
