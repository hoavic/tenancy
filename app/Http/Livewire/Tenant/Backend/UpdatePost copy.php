<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdatePost extends Component
{
    public $post;
    public $title;
    public $content;
    public $excerpt;
    public $status;
    public $password;
    public $name;
    public $parent;

    protected $rules = [
        'title'     => 'required|string|max:255',
        'content'   =>  'nullable|string',
        'excerpt'   =>  'nullable|string',
        'status'    =>  'string|max:255',
        'password'  =>  'nullable|string',
        'name'      =>  'nullable|string',
        'parent'    =>  'nullable|integer',
    ];

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function updatePost()
    {

        if ($this->title != $this->post->title) {
            $this->post->title = $this->title;
            $this->updateProperties();
        }
       
    }

    public function updateProperties() {
        try {
            $this->post->save();

            session()->flash('success','Post Update Successfully!!');

            /* return redirect(route('ten.posts.edit', $this->post->id)); */
    
            /* $post->addMediaFromRequest('featured_image')->toMediaCollection('images'); */
    
            /* return redirect(route('ten.posts.create'))->withErrors(['msg', 'Content Created Successfully.']); */

        } catch (\Exception $ex) {
            session()->flash('error','update: Something goes wrong!!');
        }
    }

    public function render()
    {
        try {
            if( !$this->post) {
                session()->flash('error','Post not found');
            } else {
                $this->title = $this->post->title;
                $this->content = $this->post->content;
                $this->id = $this->post->id;
                $this->excerpt = $this->post->excerpt;
                $this->status = $this->post->status;
                $this->password = $this->post->password;
                $this->name = $this->post->name;
                $this->parent = $this->post->parent;

            }
        } catch (\Exception $ex) {
            session()->flash('error','render: Something goes wrong!!');
        }
        return view('livewire..tenant.backend.update-post');
    }
}
