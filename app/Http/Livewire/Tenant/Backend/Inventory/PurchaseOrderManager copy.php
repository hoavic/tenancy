<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Item;
use App\Models\Tenant\Backend\Order;
use App\View\Components\TenAppLayout;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;
use Livewire\Component;

class PurchaseOrderManager extends Component
{
    public $orders;
    public $order;
    public $isOpen = false;

    public $submitLabel;

    public $items;
    public Item $item_creating;
    public $isShowAddItem = false;

    public $search;
    public $showSearchBox = false;
    public $product_searches;
    public $product_selected;
    public $error;

    protected $rules = [

        'order.id'          =>  'required|integer',
        'order.status'   => 'nullable|string',
        'order.status_update_by'   => 'nullable|string',
        'order.sub_total'    => 'required|integer',
        'order.item_discount'   => 'required|integer',
        'order.tax'     => 'required|integer',
        'order.shipping'     => 'required|integer',

        'order.total'    => 'required|integer',
        'order.promo'   => 'nullable|string',
        'order.discount'     => 'required|integer',
        'order.grand_total'     => 'required|integer',

        'search'        => 'string',

        'item_creating.product_id'  => 'nullable|integer',
        'item_creating.order_id'  => 'nullable|integer',
        'item_creating.SKU'  => 'nullable|string',

        'item_creating.MRP'  => 'nullable|integer',
        'item_creating.price'  => 'nullable|integer',
        'item_creating.discount'  => 'nullable|integer',
        'item_creating.quantity'  => 'nullable|integer',
        'item_creating.note'  => 'nullable|string',
    ];

    public function mount() {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::all();
    }

/*     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    public function render()
    {
        return view('livewire..tenant.backend.inventory.purchase-order-manager')->layout(TenAppLayout::class);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetOrderFields(){
        $this->reset('order'); 
    }

    public function create()
    {
        $this->resetOrderFields();
        $this->openModal();
        $this->submitLabel = "Thêm mới";
        $this->order = new Order();
        $this->order->status = 'draft';
        $this->order->status_update_by = 'Admin';
        
        $this->orders = array();

    }

    public function store()
    {
        $this->validate();

        try {
            $this->order->save();
            $this->closeModal();
            $this->resetOrderFields();
            session()->flash('success', $this->submitLabel.' nhà cung cấp thành công!');
            $this->loadOrders();
        } catch (\Exception $ex) {
            session()->flash('error', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại.'.$ex);
        }
    }

    public function updatedSearch($value) {

        if(strlen($value) < 3) {
            $this->error =  'Nhập tối thiểu 3 ký tự';
            return;
        }
        
        $products_result = Product::where('SKU', '=', $value)
                                    ->orWhere('supplier_product_id', '=', $value)
                                    ->orWhere('name', 'like', '%'.$value.'%')
                                    ->get();

        if(count($products_result) === 0) {
            $this->product_searches = null;
            $this->error =  'Không tìm thấy sản phẩm phù hợp.';
            return;
        }

        $this->product_searches = $products_result;
        $this->error = '';
        
    }

    public function showAddItem() {
        $this->isShowAddItem = true;
        $this->order->save();
    }

    public function selectProduct($id)
    {
        $this->product_selected = Product::find($id);
        /* dd($this->product_selected); */
        $this->item_creating = new Item();
        $this->item_creating->product_id = $this->product_selected->id;
        $this->item_creating->order_id = $this->order->id;
        $this->item_creating->SKU = $this->product_selected->SKU;
    }

    public function addItem()
    {
        
        $this->item_creating->save();
        $this->items[] = $this->item_creating;
        $this->isShowAddItem = false;
    }


    public function edit($id)
    {
        $this->resetOrderFields();
        $this->submitLabel = "Cập nhật";
        $this->openModal();
        $this->order = Order::findOrFail($id);
    }

    public function delete($id)
    {
        if($id === 1) {
            session()->flash('warning', 'Không thể xóa nhà cung cấp mặc định.');
            return;
        }
        $deleted_order = Order::find($id);
        $deleted_order->delete();
        session()->flash('success', 'Xóa nhà cung cấp '.$deleted_order->name.' thành công!');
        $this->loadOrders();
    }

}
