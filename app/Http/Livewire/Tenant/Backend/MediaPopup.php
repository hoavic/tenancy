<?php

namespace App\Http\Livewire\Tenant\Backend;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Tenant\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaPopup extends Component
{

    use WithFileUploads;

    public $show;
    public $medias;
    public $photo;
    public $tab = 'upload';
    public $path;
    public $current_attachment_id = '';
    public $attachment_seted;
    public $featured;

    public function mount() {
        $this->show = false;
    }

    protected $rules = [
        'photo' => 'image|max:2048'
    ];

    protected $listeners = ['openUpload'];
    
    public function loadMedias() {
        $this->medias = Media::orderBy('updated_at', 'desc')->get();
    }

    public function doShow() {
        $this->show = true;
        $this->loadMedias();
    }

    public function openUpload() {
        $this->tab = 'upload';
        $this->doShow();
    }

    public function openGrid() {
        $this->tab = 'grid';
        $this->doShow();
    }

    public function doClose() {
        $this->show = false;
    }

    public function upload()
    {
        
        $this->validate(); // 2MB Max)

        session()->flash('path','toi day');

        $imageTitle = now()->timestamp;

        $custom_data = [
            'title' => $imageTitle,
            'name' => $imageTitle,
            'status' => 'public',
            'type' => 'image',
            'guid' => tenant('id').'/'.$imageTitle,
        ];

        $user = auth()->user();
        $custom_data['user_id']=$user->id;

        $postImage = Post::create($custom_data);

        $postImage->addMedia($this->photo)->toMediaCollection('images');

        $this->loadMedias();

        $this->tab = 'grid';

    }

    public function setAttachment() {

        $this->featured = Media::where('id', (int)$this->current_attachment_id)->first();
        /* dd($attachment); */
        $this->attachment_seted = $this->featured->getUrl('medium');
        $this->emit('updateFeaturedByEmit', json_encode($this->featured));
        $this->doClose();
    }
   
    public function render()
    {
        return view('livewire..tenant.backend.media-popup');
    }
}
