<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\View\Components\Tenant\BackendLayout;
use App\View\Components\TenAppLayout;
use Livewire\Component;
use Livewire\WithPagination;

class AttributeManager extends Component
{

    use WithPagination;

    public $submitLabel;
    public $selectedEles = [];
    public $actionType = '';

    public $search = '';
    public $perPage = 5;

    public Attribute $attribute;

    public $showAddValue = false;
    public $modalShowed = false;

    public $modalDeleteShowed = false;

    public Attribute $attributeSelected;
    public AttributeValue $attributeValue;

    protected $rules = [

        'selectedEles.*' => 'integer',
        'actionType'    => 'string',
        'search' => 'string',
        'perPage' => 'integer',

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

    public function topAction() {

        $this->validateMultiple(['selectedEles', 'actionType']);

        if(empty($this->selectedEles) || empty($this->actionType)) { return;}

        if ($this->actionType === 'delete') 
        {
            foreach($this->selectedEles as $ele)
            {
                $this->delete($ele);
            }  
        }
    }

    protected function validateMultiple($fields){
        foreach($fields as $field){
            $this->validateOnly( $field);
        }
    }

    public function updatingSearch()
    {
        $this->resetPage('commentsPage');
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

    public function showModal()
    {
        $this->modalShowed = true;
    }

    public function hideModal()
    {
        $this->modalShowed = false;
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

    public function confirmDelete()
    {
        $this->modalDeleteShowed = true;
    }
    
    public function delete($id) {
        Attribute::destroy($id);
        session()->flash('success', 'Xóa thành công!');
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

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire..tenant.backend.commerce.attribute-manager', [
            'attributes' => Attribute::where('name','like', $search)->paginate($this->perPage),
        ])->layout(BackendLayout::class);
    }
}
