<?php

namespace App\Traits\Tenant\Backend;

trait WithDeleteConfirm {

    public $modalDeleteShowed = false;
    public $deleteId;

    public function confirmDelete($id)
    {
        $this->showConfirmModal();
        $this->deleteId = $id;
    }

    public function showConfirmModal()
    {
        $this->modalDeleteShowed = true;
    }

    public function hideConfirmModal()
    {
        $this->modalDeleteShowed = false;
    }

}