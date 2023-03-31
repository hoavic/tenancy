<?php

namespace App\Traits\Tenant\Backend;

trait WithTopAction {

    public $selectedEles = [];
    public $actionType = '';

    public $search = '';
    public $perPage = 5;

    public function topAction() {

        $this->validateMultiple(['selectedEles', 'actionType']);

        if(empty($this->selectedEles) || empty($this->actionType)) { return;}

        if ($this->actionType === 'delete') 
        {
            foreach($this->selectedEles as $ele)
            {
                $this->deleteId = $ele;
                $this->delete();
            }  
        }
    }

    public function updatingSearch()
    {
        $this->resetPage('commentsPage');
    }

}