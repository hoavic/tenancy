<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Product;
use App\View\Components\Tenant\BackendLayout;
use App\View\Components\TenAppLayout;
use Carbon\Carbon;
use Livewire\Component;

class InventoryManager extends Component
{

    public $products;

    public $beginning;
    public $ending;
    public $during;

    public $beginning_items;
    public $ending_items;
    public $during_items;

    protected $rules = [
        'beginning'     => 'nullable|date',
        'ending'     => 'nullable|date',

    ];

    public function mount()
    {
        $this->beginning = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');

        $this->ending = Carbon::now()->format('Y-m-d H:i:s');

/*         $this->products = Product::with(['items' => function (Builder $query) {
            $query->whereDate('created_at', '>=', $this->beginning)
                ->whereDate('created_at', '<=', $this->ending);
        }])->get(); */

        $this->productFillter();
        
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function allTime()
    {
        $this->beginning = '';
        $this->ending = '';
    }

    public function productFillter() 
    {
        try{

            $this->validate();

            if (empty($this->beginning)) {
                $this->products = Product::with('items')->get();
                return;
            }

            $this->products = Product::whereHas('items', function ($query) {
                return $query->whereDate('created_at', '>=', $this->beginning)
                    ->whereDate('created_at', '<=', $this->ending);
            })->get();
        } catch (\Exception $ex) {
            session()->flash('error', $ex);
        }

    }

    public function render()
    {
        return view('livewire..tenant.backend.inventory.inventory-manager')->layout(BackendLayout::class);
    }
}
