<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\View\Components\TenAppLayout;
use Attribute;
use Livewire\Component;

class AttributeValueManager extends Component
{

    public Attribute $attribute;
    public AttributeValue $attributeValue;
    public bool $showCreateOptionModal = false;
    public Attribute $attributeValueBeingDeleted;
    public bool $confirmingAttributeValueDeletion = false;

    protected $rules = [
        'attributeValue.value' => 'required|string',
        'attributeValue.label' => 'required|string',
    ];

    public function createAttributeValue()
    {
        $this->attributeValue = new AttributeValue();
        $this->showCreateOptionModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->attribute()->attribute_options()->save($this->attributeValue);
        $this->showCreateOptionModal = false;
        $this->product->refresh();
    }

    public function confirmOptionDeletionFor(AttributeValue $attributeValue)
    {
        $this->confirmingAttributeValueDeletion = true;
        $this->attributeValueBeingDeleted = $attributeValue;
    }

    public function delete()
    {

        $this->confirmingAttributeValueDeletion = false;

    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.attribute-value-manager')->layout(TenAppLayout::class);
    }
}
