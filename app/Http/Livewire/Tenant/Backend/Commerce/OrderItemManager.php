<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Order;
use App\Models\Tenant\Backend\Commerce\OrderItem;
use Livewire\Component;
use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;

class OrderItemManager extends Component
{
    use WithModal, WithDeleteConfirm;

    public Order $order;
    public Supplier $supplier;

    public OrderItem $orderItem;
    public $orderItemPurcharseQuantity;

    public $orderItems;

    public $searchItem;
    public $error;

    public $itemSearches;
    public $itemSearchSelected;

    protected $rules = [
        'orderItem.order_id' => 'required|integer',
        'orderItem.item_id' => 'required|integer',
        'orderItem.price' => 'required|integer',
        'orderItem.quantity' => 'required|integer',
        'searchItem'        => 'nullable|string',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->loadOrderItems();
    }

    public function loadOrderItems()
    {
        $this->orderItems = OrderItem::where('order_id', $this->order->id)->get();
    }

    public function updatedSearchItem($value) {

        if(strlen($value) < 3) {
            $this->error =  'Nhập tối thiểu 3 ký tự';
            return;
        }
        
        $itemResults = Item::where('SKU', '=', $value)
                                    ->orWhereHas('product', function ($query) use ($value) {
                                        return $query->where('name', 'like', '%'.$value.'%');
                                    })
                                    ->get();

        if(count($itemResults) === 0) {
            $this->itemSearches = null;
            $this->error =  'Không tìm thấy sản phẩm phù hợp.';
            return;
        }

        $this->itemSearches = $itemResults;
        $this->error = '';
        
    }

    public function nullSearch()
    {
        $this->searchItem = null;
        $this->itemSearches = null;
        $this->error = '';
    }

    public function updatedOrderItemQuantity($value) {

        if($value > $this->itemSearchSelected->currentQuantity()) {
            session()->flash('warnning', 'Số lượng bán lớn hơn Tồn kho.');
            $this->orderItem->quantity = $this->itemSearchSelected->getTotalPurchaseQuantity();
        }
    }

    public function create()
    {
        $this->showModal();
        $this->nullSearch();
    }

    public function selectItem($id)
    {
/*         $item = Item::find($id); */
        $this->itemSearchSelected = Item::find($id);
        $this->orderItem = new OrderItem();
        $this->orderItem->item_id = $this->itemSearchSelected->id;
        $this->orderItem->order_id = $this->order->id;
        $this->orderItem->price = $this->itemSearchSelected->price;
        $this->orderItem->quantity = 1;
        $this->nullSearch();
    }

    public function saveAndContinue()
    {
        $this->store();
    }

    public function saveAndClose()
    {
        $this->store();
        $this->hideModal();
    }

    public function store()
    {
        $this->orderItem->save();
        $this->emitUp('refreshOrder');
        $this->loadOrderItems();
        $this->orderItem = new OrderItem();
        $this->nullSearch();
        $this->itemSearchSelected = null;
    }

    public function delete() 
    {
        OrderItem::destroy($this->deleteId);
        $this->hideConfirmModal();
        session()->flash('success', 'Xóa thành công!');
        $this->loadOrderItems();
        $this->emit('refreshComponent');
    }
   
    public function render()
    {
        return view('livewire..tenant.backend.commerce.order-item-manager');
    }
}
