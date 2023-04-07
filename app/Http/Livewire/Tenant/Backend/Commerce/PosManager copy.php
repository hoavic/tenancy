<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Customer;
use App\Models\Tenant\Backend\Commerce\Order;
use App\Models\Tenant\Backend\Commerce\OrderItem;
use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Inventory\Stock;
use App\View\Components\Tenant\BackendFullLayout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PosManager extends Component
{
    
    use WithPagination;

    public $search;
    
    public Order $order;

    public $customers;

    public $stocks;

    protected $rules = [
        'order.customer_id'     =>  'nullable|integer',
        'order.stock_id'     =>  'nullable|integer',
        'order.tax'         => 'required|integer',
        'order.discount'         => 'nullable|integer',
        'order.sub_total'         => 'nullable|integer',
        'order.grand_total'         => 'nullable|integer',
    ];

    public function mount()
    {
        $this->customers = Customer::all();
        $this->stocks = Stock::all();
        $this->createNewOrder();
    }

    public function createNewOrder()
    {
        $this->order = new Order();
        $this->order->type = 'pos';
        $this->order->status = 'draft';
        $this->order->update_by = Auth::id();
        $this->order->stock_id = 1;
        $this->order->tax = 10;
        $this->order->sub_total = 0;
        $this->order->grand_total = 0;
    }

    public function updatingSearch()
    {
        $this->resetPage('commentsPage');
    }

    public function select($id)
    {
        
        if(empty($this->order->id)) {
            $this->store();
            /* dd($this->order->id); */
        }

        if($this->order->checkItemExists($id)) {
            /* dd($this->order->checkItemExists($id)); */
            $itemExists = $this->order->checkItemExists($id);
            $itemExists->quantity = $itemExists->quantity + 1;
            $itemExists->save();
            $itemExists = null;
        } else {
            OrderItem::create([
                'order_id' => $this->order->id,
                'item_id'   => $id,
                'price'     => Item::find($id)->price,
                'quantity' => 1,
            ]);
        }
        
        $this->order->refresh();
        $this->updateData();
    }

    public function updateData()
    {
        $this->order->sub_total = $this->order->getTotalAmount();

        $this->order->grand_total = $this->order->sub_total - $this->order->discount - $this->order->tax*$this->order->sub_total/100;
    }

/*     public function hold()
    {
        return;
    } */

    public function resetOrder()
    {
        $this->order->delete();
        $this->createNewOrder();
    }

    public function payOrder()
    {
        $this->order->status = 'paid';
        $this->store();
    }

    public function store() {
       /*  $this->validate(); */
       $this->order->save();
    }
    
    public function render()
    {
        $search = $this->search;
        return view('livewire..tenant.backend.commerce.pos-manager', [
            'items' => Item::where('SKU', '=', $search)
                                ->orWhereHas('product', function ($query) use ($search) {
                                        return $query->where('name', 'like', '%'.$search.'%');
                                 })
                                ->paginate(20),
        ])->layout(BackendFullLayout::class);
    }
}
