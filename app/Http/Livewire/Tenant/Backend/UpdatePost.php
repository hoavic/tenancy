<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdatePost extends Component
{
    public $post;

    protected $rules = [
        'post.title'     => 'required|string|max:255',
        'post.content'   =>  'nullable|string',
        'post.excerpt'   =>  'nullable|string',
        'post.status'    =>  'string|max:255',
        'post.password'  =>  'nullable|string',
        'post.name'      =>  'nullable|string',
        'post.parent'    =>  'nullable|integer',
        'post.updated_at' => 'date:Y-m-d H:i:s',
    ];

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function updatePost()
    {

        try {

            $this->post->save();

            session()->flash('success','Post Update Successfully!!');

        } catch (\Exception $ex) {
            session()->flash('error','update: Something goes wrong!!');
        }
       
    }

    public function render()
    {
        return view('livewire..tenant.backend.update-post');
    }
}
