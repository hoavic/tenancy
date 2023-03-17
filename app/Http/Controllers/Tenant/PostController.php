<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Category;
use App\Models\Tenant\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::with('categories')->where('type', '=', 'post')->get();

        return view('tenant.backend.posts.index', [
            'posts' => $posts,
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
       /*  $categories_tree = $this->getCategoriesTree(); */
        $categories = Category::where('parent_id', '=', 0)->get();
        return view('tenant.backend.posts.create', [
            'categories' => $categories,
        ]);
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
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   =>  'nullable|string',
            'excerpt'   =>  'nullable|string',
            'status'    =>  'required|string|max:255',
            'password'  =>  'nullable|string',
            'name'      =>  'nullable|string',
            'parent'    =>  'nullable|integer',
        ]);

        if (empty($validated['name'])) {
            $validated['name'] = $validated['title'];
        }

        if (empty($validated['excerpt']) && !empty($validated['content'])) {
            $validated['excerpt'] = $validated['content'];
        }

        $validated['author'] = Auth::user('id');

        $validated['guid'] = tenant('id').'/'.$validated['name'];

        if (empty($validated['name'])) {
            $validated['name'] = $validated['title'];
        }

        $post = $request->user()->posts()->create($validated);

        if (!empty($validated['category_id'])) {
            $post->categories()->sync([$validated['category_id']], false);
        }

        $post->addMediaFromRequest('featured_image')->toMediaCollection('images');

        return redirect(route('ten.posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::where('parent_id', '=', 0)->get();
        return view('tenant.backend.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
