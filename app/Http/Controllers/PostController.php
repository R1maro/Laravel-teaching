<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostSaveRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }


    public function CreateOrUpdate(PostSaveRequest $request, Post $post)
    {

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = str_replace(' ', '-', $post->title);
        if ($request->hasFile('img')) {
            $request->File('img')->storePubliclyAs("/public/posts/",$post->slug.'.jpg');
            $post->image = "/public/posts/".$post->slug.'.jpg';
        }
        $post->save();
        return $post;

    }

    public function index()
    {
        //
        $posts = Post::latest()->paginate(12);
        return view('post.postList', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('post.postForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostSaveRequest $request)
    {
        //
        $post = new Post();
        $this->CreateOrUpdate($request, $post);
        return redirect()->route('post.index')->with([['message' => 'Post inserted']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('post.post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //

        return view('post.postForm',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostSaveRequest $request, Post $post)
    {
        //
        $this->CreateOrUpdate($request, $post);
        return redirect()->route('post.index')->with([['message' => 'Post inserted']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $title = $post->title;
        $post->delete();
        return redirect()->route('post.index')->with(['message' => 'Post "' . $title . '" deleted']);
    }
}
