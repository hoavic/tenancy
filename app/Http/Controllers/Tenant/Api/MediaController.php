<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    //
    public function byFile(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $title = now()->timestamp.".{$request->file->getClientOriginalName()}";

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

        $image = $post->addMediaFromRequest('file')->toMediaCollection('images');

        return response($image, Response::HTTP_CREATED);

    }
}
