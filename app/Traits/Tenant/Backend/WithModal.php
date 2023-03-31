<?php

namespace App\Traits\Tenant\Backend;

trait WithModal {

    public $modalShowed = false;

    public function showModal()
    {
        $this->modalShowed = true;
    }

    public function hideModal()
    {
        $this->modalShowed = false;
    }

}