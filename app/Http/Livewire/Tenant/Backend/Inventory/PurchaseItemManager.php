<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Inventory\Purchase;
use App\Models\Tenant\Backend\Inventory\PurchaseItem;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use Livewire\Component;

class PurchaseItemManager extends Component
{
    use WithModal, WithDeleteConfirm;

    public Purchase $purchase;
    public Supplier $supplier;

    public PurchaseItem $purchaseItem;

    public $purchaseItems;

    public $searchItem;
    public $error;

    public $itemSearches;
    public $itemSearchSelected;

    protected $rules = [
        'purchaseItem.purchase_id' => 'required|integer',
        'purchaseItem.item_id' => 'required|integer',
        'purchaseItem.price' => 'required|integer',
        'purchaseItem.quantity' => 'required|integer',
        'searchItem'        => 'nullable|string',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->loadPurchaseItems();
    }

    public function loadPurchaseItems()
    {
        $this->purchaseItems = PurchaseItem::withTrashed()->where('purchase_id', $this->purchase->id)->get();
    }

    public function updatedSearchItem($value) {

        if(strlen($value) < 3) {
            $this->error =  'Nhập tối thiểu 3 ký tự';
            return;
        }
        
        $itemResults = Item::where('SKU', 'like', '%'.$value.'%')
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
        $this->itemSearchSelected = null;
    }

    public function create()
    {
        $this->showModal();
        $this->nullSearch();
    }

    public function selectItem($id)
    {
        $this->purchaseItem = new PurchaseItem();
        $this->purchaseItem->item_id = $id;
        $this->purchaseItem->purchase_id = $this->purchase->id;
        $this->purchaseItem->price = 0;
        $this->purchaseItem->quantity = 1;
        $this->nullSearch();
        $this->itemSearchSelected = Item::find($id);
    }

    public function saveAndContinue()
    {
        $this->purchaseItem->save();
        $this->emitUp('refreshPurchase');
        $this->loadPurchaseItems();
        $this->purchaseItem = new PurchaseItem();
        $this->nullSearch();
    }

    public function saveAndClose()
    {
        $this->purchaseItem->save();
        $this->emitUp('refreshPurchase');
        $this->loadPurchaseItems();
        $this->purchaseItem = new PurchaseItem();
        $this->hideModal();
    }

    public function delete() 
    {
        PurchaseItem::destroy($this->deleteId);
        $this->hideConfirmModal();
        session()->flash('success', 'Xóa thành công!');
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire..tenant.backend.inventory.purchase-item-manager');
    }
}
