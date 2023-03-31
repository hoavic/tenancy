<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Models\Tenant\Backend\Inventory\Purchase;
use App\Models\Tenant\Backend\Inventory\Stock;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use App\Traits\Tenant\Backend\WithTopAction;
use App\View\Components\Tenant\BackendLayout;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseManager extends Component
{

    use WithModal, WithDeleteConfirm, WithPagination, WithTopAction;

    public $purchase;

    public $submitLabel;

    public $suppliers;
    public $stocks;

    protected $rules = [

        'purchase.status'   => 'nullable|string',
        'purchase.update_by'   => 'nullable|string',
        'purchase.sub_total'    => 'required|numeric',
        'purchase.tax'     => 'required|integer',
        'purchase.shipping'     => 'required|integer',

        'purchase.promo'   => 'nullable|string',
        'purchase.discount'     => 'nullable|numeric',
        'purchase.grand_total'     => 'required|numeric',

        'purchase.supplier_id'       => 'required|integer',
        'purchase.stock_id'       => 'required|integer',

    ];

    protected $listeners = ['refreshPurchase'];

    public function mount() {
        $this->suppliers = Supplier::all();
        $this->stocks = Stock::all();
    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire..tenant.backend.inventory.purchase-manager', [
            'purchases' => Purchase::where('id','like', $search)->paginate($this->perPage),
        ])->layout(BackendLayout::class);
    }

    public function create()
    {

        $this->showModal();
        $this->submitLabel = "Thêm mới";
        $this->purchase = new Purchase();
        $this->purchase->status = 'draft';
        $this->purchase->update_by = 'Admin';
        $this->purchase->tax = 10;
        $this->purchase->shipping = 0;
        $this->purchase->sub_total = 0;
        $this->purchase->grand_total = 0;

        $this->purchase->supplier_id = 1;
        $this->purchase->stock_id = 1;

        $this->purchase->save();
    }

    public function edit($id)
    {
        $this->submitLabel = "Cập nhật";
        $this->showModal();
        $this->purchase = Purchase::findOrFail($id);
        $this->calculateGrandTotal();
    }

    public function calculateGrandTotal()
    {
        $this->purchase->sub_total = $this->purchase->getTotalAmount();

        $tax = 0;
        $shipping = 0;
        $discount = 0;

        if($this->purchase->sub_total > 0) {
            if($this->purchase->tax != 0) {
                $tax = ($this->purchase->sub_total*$this->purchase->tax)/100;
            }
    
            if($this->purchase->shipping != 0) {
                $tax = ($this->purchase->sub_total*$this->purchase->tax)/100;
            }
        }

        $this->purchase->grand_total = $this->purchase->sub_total + $tax + $shipping - $discount;
    }

    public function store()
    {
        $this->validate();

        try {
            $this->purchase->status = 'new';
            $this->calculateGrandTotal();
            $this->purchase->save();
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
        $deleted_purchase = Purchase::find($id);
        $deleted_purchase->delete();
        session()->flash('success', 'Xóa nhà cung cấp '.$deleted_purchase->name.' thành công!');
    }

    public function refreshPurchase()
    {
        $this->purchase->refresh();
        $this->calculateGrandTotal();
        $this->emit('refreshComponent');
    }

}
