<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Item;
use App\Models\Tenant\Backend\Order;
use App\View\Components\TenAppLayout;
use Livewire\Component;

class PurchaseOrderManager extends Component
{
    public $orders;
    public $order;
    public $isOpen = false;

    public $submitLabel;

    public $items;

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
        'order.sub_total'    => 'required|numeric',
        'order.item_discount'   => 'required|numeric',
        'order.tax'     => 'required|numeric',
        'order.shipping'     => 'required|numeric',

        'order.total'    => 'required|numeric',
        'order.promo'   => 'nullable|string',
        'order.discount'     => 'required|numeric',
        'order.grand_total'     => 'required|numeric',

        'search'        => 'nullable|string',

    ];

    protected $listeners = ['hideItemAdded'];

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

        $this->setOrderField();

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

        $this->nullSearch();
        $this->product_selected = null;
        $this->isShowAddItem = true;
        $this->order->save();

    }

    public function selectProduct($id)
    {

        $this->product_selected = Product::find($id);
        $this->emit('setItemData');
        $this->nullSearch();
    }

    public function nullSearch()
    {
        $this->search = null;
        $this->product_searches = null;
        $this->error = '';
    }

    public function hideItemAdded()
    {
        $this->reset('product_selected');
        $this->setOrderField();
        $this->isShowAddItem = false;
    }

    public function edit($id)
    {
        $this->resetOrderFields();
        $this->submitLabel = "Cập nhật";
        $this->openModal();
        $this->order = Order::findOrFail($id);
        $this->setOrderField();
    }

    public function setOrderField()
    {
        $this->items = Item::where('order_id', '=', $this->order->id)->get();
        $this->order->sub_total = (int)Item::where('order_id', '=', $this->order->id)->sum('price');
        $this->order->item_discount = (int)Item::where('order_id', '=', $this->order->id)->sum('discount');
        $this->order->tax = 10;
        $this->order->shipping = 0;
        $this->order->total = (int) ($this->order->sub_total * ((100 + $this->order->tax) / 100) + $this->order->shipping);
        $this->order->discount = 0;
        $this->order->grand_total = $this->order->total - $this->order->discount;
        /* dd($this->order->total); */
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
