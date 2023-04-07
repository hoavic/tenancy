<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Order;
use App\Models\Tenant\Backend\Inventory\Stock;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use App\Traits\Tenant\Backend\WithTopAction;
use App\View\Components\Tenant\BackendLayout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderManager extends Component
{

    use WithModal, WithDeleteConfirm, WithPagination, WithTopAction;

    public $order;

    public $submitLabel;

    public $stocks;

    protected $rules = [

        'order.stock_id' => 'required|integer',
        'order.tax'     => 'required|integer',
        'order.shipping'     => 'required|integer',

        'order.promo'   => 'nullable|string',
        'order.discount'     => 'nullable|numeric',

    ];

    protected $listeners = ['refreshOrder'];

    public function mount() {
        $this->stocks = Stock::all();
    }

    public function create()
    {

        $this->showModal();
        $this->submitLabel = "Thêm mới";
        $this->order = new Order();
        $this->order->status = 'draft';
        $this->order->tax = 10;
        $this->order->shipping = 0;
        $this->order->sub_total = 0;
        $this->order->grand_total = 0;

        $this->order->stock_id = 1;
        $this->order->save();
    }

    public function edit($id)
    {
        $this->submitLabel = "Cập nhật";
        $this->showModal();
        $this->order = Order::findOrFail($id);
        $this->calculateGrandTotal();
    }

    public function calculateGrandTotal()
    {
        $this->order->sub_total = $this->order->getTotalAmount();

        $tax = 0;
        $shipping = 0;
        $discount = 0;

        if($this->order->sub_total > 0) {
            if($this->order->tax != 0) {
                $tax = ($this->order->sub_total*$this->order->tax)/100;
            }
    
            if($this->order->shipping != 0) {
                $tax = ($this->order->sub_total*$this->order->tax)/100;
            }
        }

        $this->order->grand_total = $this->order->sub_total + $tax + $shipping - $discount;
    }

    public function store()
    {
        $this->validate();

        try {
            $this->order->status = 'new';
            $this->calculateGrandTotal();
            $this->order->save();
            $this->hideModal();
            session()->flash('success', $this->submitLabel.' nhà cung cấp thành công!');
        } catch (\Exception $ex) {
            session()->flash('error', 'Đã có lỗi xảy ra. Vui lòng kiểm tra lại.'.$ex);
        }
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
    }

    public function refreshOrder()
    {
        $this->order->refresh();
        $this->calculateGrandTotal();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire..tenant.backend.commerce.order-manager', [
            'orders' => Order::where('id','like', $search)->paginate($this->perPage),
        ])->layout(BackendLayout::class);
    }

}
