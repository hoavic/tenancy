<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Tenant\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    //
    public function index() {
        $medias = Media::all();

        return view('tenant.backend.includes.media-popup', [
            'medias' => $medias,
        ]);
    }

    public function byFile(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $title = now()->timestamp;

        $custom_data = [
            'title' => $title,
            'name' => $title,
            'status' => 'public',
            'type' => 'image',
            'guid' => tenant('id').'/'.$title,
        ];
        $user = auth()->user();
        $custom_data['user_id']=$user->id;

        $post = Post::create($custom_data);

        $image = $post->addMediaFromRequest('image')->toMediaCollection('images');

        $response = array(
            "success" => 1,
            "file"     =>  array(
                "url"   => $image->original_url
            ),
        );

        return response(json_encode($response), Response::HTTP_CREATED);

    }
}
