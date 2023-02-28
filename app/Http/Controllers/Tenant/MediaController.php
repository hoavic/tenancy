<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Tenant\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $medias = Media::all();
        return view('tenant.backend.media.index', [
            'medias' => $medias,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tenant.backend.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
/*         $validated = $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]); */
 
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

        $post->addMediaFromRequest('file')->toMediaCollection('images');

        return redirect(route('ten.media.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $media = Media::find($id);
        return view('tenant.backend.media.edit', [
            'media' => $media,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
