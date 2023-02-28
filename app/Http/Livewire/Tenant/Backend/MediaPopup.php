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

    public function mount() {
        $this->show = false;
    }

    protected $rules = [
        'photo' => 'image|max:2048'
    ];

    public function doShow() {
        $this->show = true;
        $this->medias = Media::all();
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

        try {
    
            $postImage->addMedia($this->photo)->toMediaCollection('images');
    
            $this->tab = 'grid';

        } catch (\Exception $ex) {
            session()->flash('path',$ex);
        }

/*         try {
    
            $postImage->addMediaFromRequest($this->photo)->toMediaCollection();
    
            $this->tab = 'grid';

        } catch (\Exception $ex) {
            session()->flash('path',$ex);
        } */

    }
   
    public function render()
    {
        return view('livewire..tenant.backend.media-popup');
    }
}
