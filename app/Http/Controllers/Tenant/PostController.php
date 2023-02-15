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
        $posts = Post::all();

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
       $data = Category::all();
        return view('tenant.backend.posts.create', compact('data'));
    }

    protected function getCategoriesTree()
    {
        $categories = Category::where('parent_id',0)->get();

        if($categories->count())
        {
            foreach ($categories as $category) 
            {
                $categories_tree[$category->id] = $this->getChildCategories($category);
            }
        }

        return $categories_tree;
    }

    private function getChildCategories($category)
    {
        $sub_categories = [];

        $childs = Category::where('parent_id', $category->id)->get();

        $sub_categories = $category;

        $sub_categories['sub_categories'] = [];

        if($childs->count())
        {
            $sub_categories['sub_categories'] = $childs;
        }

        return $sub_categories;
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

        $request->user()->posts()->create($validated);

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
