<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostForm extends Component
{

    public $post;
    
    public $categories;
    public $category_ids;
    public $autoslug = true;


    protected $rules = [
        'post.title'     => 'required|string|max:255',
        'post.content'   =>  'nullable|string',
        'post.excerpt'   =>  'nullable|string',
        'post.status'    =>  'string|max:255',
        'post.password'  =>  'nullable|string',
        'post.parent'    =>  'nullable|integer',
        'category_ids'      => 'nullable|array',
    ];

    public function mount() {
        $this->post = new Post();
        $this->post->status = 'publish';
        $this->post->title = '';
        $this->category_ids = array(1);
    }

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function storePost() {

        $this->validate();

        try {

            if (empty($this->post->title)) {
                $this->post->title = 'Chưa nhập tiêu đề...';
            }

            if (empty($this->post->name)) {
                $this->post->name = $this->post->title;
            }
    
            if (empty($this->post['excerpt']) && !empty($this->post->content)) {
                $$this->pos['excerpt'] = $this->post->content;
            }
    
            $this->post->user_id = Auth::user('id')->id;
    
            $this->post->guid = tenant('id').'/'.$this->post->name;
    
            $post = $this->post->save();

            $post->categories()->sync( $this->category_ids, false);

            session()->flash('success','Post Created Successfully!!');

            return redirect(route('ten.posts.edit', $post));
    
            /* $post->addMediaFromRequest('featured_image')->toMediaCollection('images'); */
    
            /* return redirect(route('ten.posts.create'))->withErrors(['msg', 'Content Created Successfully.']); */
    

        } catch (\Exception $ex) {
            session()->flash('error','store: Something goes wrong!!'.$ex);
        }
       
    }

    public function showPostMeta() {
        $this->storePost();
        $this->emit('create');
    }

    public function render()
    {
        return view('livewire.tenant.backend.post-form');
    }
}
