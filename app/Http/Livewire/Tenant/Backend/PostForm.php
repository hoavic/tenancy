<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostForm extends Component
{

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

    public function storePost() {

        $validatedData = $this->validate();

        try {
            if (empty($validatedData['name'])) {
                $validatedData['name'] = $validatedData['title'];
            }
    
            if (empty($validatedData['excerpt']) && !empty($validatedData['content'])) {
                $validatedData['excerpt'] = $validatedData['content'];
            }
    
            $validatedData['user_id'] = Auth::user('id')->id;
    
            $validatedData['guid'] = tenant('id').'/'.$validatedData['name'];
    
            if (empty($validvalidatedDataated['name'])) {
                $validatedData['name'] = $validatedData['title'];
            }
    
            $post = Post::create($validatedData);

            session()->flash('success','Post Created Successfully!!');

            return redirect(route('ten.posts.edit', $post));
    
            /* $post->addMediaFromRequest('featured_image')->toMediaCollection('images'); */
    
            /* return redirect(route('ten.posts.create'))->withErrors(['msg', 'Content Created Successfully.']); */
    

        } catch (\Exception $ex) {
            session()->flash('error','store: Something goes wrong!!');
        }
       
    }

    public function render()
    {
        return view('livewire.tenant.backend.post-form');
    }
}
