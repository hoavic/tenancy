<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Models\Tenant\Backend\Inventory\Purchase;
use App\Models\Tenant\Backend\Inventory\PurchaseItem;
use App\Traits\Tenant\Backend\WithModal;
use App\Traits\Tenant\Backend\WithTopAction;
use App\View\Components\Tenant\BackendLayout;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseManager extends Component
{

    use WithModal, WithPagination, WithTopAction;

    public $purchase;

    public $submitLabel;

    public $purchase_items;

    public $isShowAddItem = false;

    public $searchItem;
    public $showSearchBox = false;
    public $product_searchItemes;
    public $product_selected;
    public $error;

    public $suppliers;
    public $supplier_id;

    public $locations;
    public $location_id;

    protected $rules = [

        'purchase.id'          =>  'required|integer',
        'purchase.status'   => 'nullable|string',
        'purchase.status_update_by'   => 'nullable|string',
        'purchase.sub_total'    => 'required|integer',
        'purchase.item_discount'   => 'required|integer',
        'purchase.tax'     => 'required|integer',
        'purchase.shipping'     => 'required|integer',

        'purchase.total'    => 'required|integer',
        'purchase.promo'   => 'nullable|string',
        'purchase.discount'     => 'required|integer',
        'purchase.grand_total'     => 'required|integer',

        'supplier_id'       => 'required|integer',
        'location_id'       => 'required|integer',

        'searchItem'        => 'nullable|string',

    ];

    protected $listeners = ['hideItemAdded'];

    public function mount() {
        $this->suppliers = Supplier::all();
        $this->locations = Location::all();
    }

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire..tenant.backend.inventory.purchase-manager', [
            'purchases' => Purchase::where('id','like', $search)->paginate($this->perPage),
        ])->layout(BackendLayout::class);
    }

    public function getSupplierId()
    {
        /* dd($this->purchase->purchase_items->first()); */
        if(!empty($this->purchase->purchase_items->first()->supplier_id)) {
            return $this->purchase->purchase_items->first()->supplier_id;
        }
    }

    public function updatedSupplierId($value)
    {
        if(!empty($this->getSupplierId())) {
            $this->supplier_id = $this->getSupplierId();
        } 
        $this->validateOnly('supplier_id');
    }

    public function getLocationId()
    {
        /* dd($this->purchase->purchase_items->first()); */
        if(!empty($this->purchase->purchase_items->first()->location_id)) {
            return $this->purchase->purchase_items->first()->location_id;
        }
    }

    public function updatedLocationId($value)
    {
        $this->validateOnly($value);
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

        if(empty($this->supplier_id))
        {
            session()->flash('warning', 'Bạn phải chọn Nhà cung cấp trước!');
            $this->validateOnly('supplier_id');
            return;
        }

        $this->nullSearch();
        $this->product_selected = null;
        $this->isShowAddItem = true;
        $this->purchase->save();

    }

    public function hideItemAdded()
    {
        $this->reset('product_selected');
        $this->setPurchaseField();
        $this->isShowAddItem = false;
    }

    public function selectProduct($id)
    {

        $this->product_selected = Product::find($id);
        $this->emit('setItemData');
        $this->nullSearch();
    }

    public function nullSearch()
    {
        $this->searchItem = null;
        $this->product_searches = null;
        $this->error = '';
    }

    public function setPurchaseField()
    {

        $this->purchase_items = PurchaseItem::where('purchase_id', '=', $this->purchase->id)->get();
        $this->purchase->sub_total = $this->purchase->getTotalPrice();
        $this->purchase->item_discount = $this->purchase->getTotalDiscount();
        $this->purchase->tax = 10;
        $this->purchase->shipping = 0;
        $this->purchase->total = (int) ($this->purchase->sub_total * ((100 + $this->purchase->tax) / 100) + $this->purchase->shipping);
        $this->purchase->discount = 0;
        $this->purchase->grand_total = $this->purchase->total - $this->purchase->discount;
        /* dd($this->purchase->total); */
    }

    private function resetPurchaseFields(){
        $this->reset('purchase'); 
    }

    public function create()
    {
        $this->resetPurchaseFields();
        $this->showModal();
        $this->submitLabel = "Thêm mới";
        $this->purchase = new Purchase();
        $this->purchase->status = 'draft';
        $this->purchase->status_update_by = 'Admin';

        $this->setPurchaseField();

        $this->supplier_id = 1;
        $this->location_id = 1;
    }

    public function edit($id)
    {
        $this->resetPurchaseFields();
        $this->submitLabel = "Cập nhật";
        $this->openModal();
        $this->purchase = Purchase::findOrFail($id);
        $this->setPurchaseField();
        $this->supplier_id = $this->getSupplierId();
        $this->location_id = $this->getLocationId();
    }

    public function store()
    {
        $this->validate();

        try {
            $this->purchase->status = 'new';
            if($this->getLocationId() != $this->location_id) {
                foreach ($this->purchase->purchase_items as $item)
                {
                    $item->location_id = $this->location_id;
                    $item->save();
                }
            }
            $this->purchase->save();
            $this->closeModal();
            $this->resetPurchaseFields();
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

}
