<?php

namespace App\Http\Livewire\Tenant\Backend;

use App\Models\Tenant\Post;
use App\Models\Tenant\PostMeta;
use Livewire\Component;

class PostMetaManager extends Component
{


    public Post $post;
    public PostMeta $postMeta;
    public bool $showCreateModal = false;
    public PostMeta $postMetaBeingDeleted;
    public bool $confirmingPostMetaDeletion = false;

    protected $rules = [
        'postMeta.visual' => 'required|string',
        'postMeta.key' => 'required|string',
    ];

    protected $listeners = ['parentCreate'];

    public function create()
    {
        if(empty($this->post->id)) {
           $this->emitUp('showPostMeta');
        } else {
            $this->postMeta = new PostMeta();
            $this->showCreateModal = true;
        }
    }

    public function parentCreate(Post $post)
    {
        $this->post = $post;
        $this->postMeta = new PostMeta();
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->post->postMetas()->save($this->postMeta);
        $this->showCreateModal = false;
        $this->post->refresh();
    }

    public function confirmOptionDeletionFor(PostMeta $postMeta)
    {
        $this->confirmingPostMetaDeletion = true;
        $this->postMetaBeingDeleted = $postMeta;
    }

    public function delete()
    {
        $this->postMetaBeingDeleted->postMetaValues()->delete();
        $this->postMetaBeingDeleted->delete();
        $this->confirmingPostMetaDeletion = false;
        $this->post->refresh();
    }

    public function render()
    {
        return view('livewire..tenant.backend.postmeta-manager');
    }
}
