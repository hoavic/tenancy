<?php

namespace App\Http\Livewire\Tenant\Backend;

use Livewire\Component;

class GlobalSetting extends Component
{

    public $tab;

    protected $rules = [
        'tab' => 'string',
    ];

    public function mount()
    {
        $this->tab = 'general';
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function setTab($tabName)
    {
        try {
            $this->tab = $tabName;
            session()->flash('success', 'Cập nhật thành công!');
        } catch (\Exception $ex) {
            session()->flash('error', $ex);
        }
        
    }

    public function render()
    {
        return view('livewire..tenant.backend.global-setting')->layout(\App\View\Components\TenAppLayout::class);
    }
}
