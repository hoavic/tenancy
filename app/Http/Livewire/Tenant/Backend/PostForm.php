<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostForm extends Component
{
    public $post;
    public $categories;
    public $category_ids;
    public Media $featured_image;

    protected $rules = [
        'post.title'     => 'required|string|max:255',
        'post.content'   =>  'nullable|string',
        'post.excerpt'   =>  'nullable|string',
        'post.status'    =>  'string|max:255',
        'post.password'  =>  'nullable|string',
        'post.slug'      =>  'nullable|string',
        'post.parent'    =>  'nullable|integer',
        'post.parent'    =>  'nullable|integer',
        'post.featured'  => 'nullable|integer',
        'post.updated_at' => 'date:Y-m-d H:i:s',
        'category_ids' => 'required|array|',
        'category_ids.*' => 'integer',
    ];

    protected $listeners = ['storePost', 'showPostMeta', 'updateFeaturedByEmit'];

    public function mount() {

        if(empty($this->post)) {

            $this->post = new Post();
            $this->post->status = 'publish';
            $this->post->title = '';
            $this->category_ids = array(1);

        } else {

            $this->post['status'] = 'publish';

            $category_ids = array();
            foreach($this->post->categories as $post_category) {
                $category_ids[] = $post_category->id;
            }
    
            $this->category_ids = $category_ids;

            if(!empty($this->post->featured)) {
                $this->featured_image = Media::find($this->post->featured);
            }

        }
    }

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function updateFeaturedByEmit(Media $value) {
        $this->featured_image = $value;
        $this->post->featured = $this->featured_image->id;
    }

    public function storePost()
    {

        $this->validate();

        try {

            if (empty($this->post->title)) {
                $this->post->title = 'Chưa nhập tiêu đề...';
            }

            if (empty($this->post->slug)) {
                $this->post->slug = $this->post->title;
            }
    
            if (empty($this->post->excerpt) && !empty($this->post->content)) {
                $this->post->excerpt = $this->post->content;
            }

            if (empty($this->post->user_id)) {
                $this->post->user_id = Auth::user('id')->id;
            }
    
            $this->post->guid = tenant('id').'/'.$this->post->slug;

            $this->post->save();
            
            $this->post->categories()->sync($this->category_ids);

            session()->flash('success','Post Update Successfully!!');

            return $this->post;

        } catch (\Exception $ex) {
            session()->flash('error','update: Something goes wrong!!\n'.$ex);
        }
       
    }

    
    public function showPostMeta() {
        if(empty($this->post->id)) {
            $this->storePost();
        }
        $this->emit('parentCreate', $this->post->id);
    }

    public function render()
    {
        return view('livewire.tenant.backend.post-form');
    }
}
