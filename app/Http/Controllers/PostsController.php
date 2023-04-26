<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('blog.index')
        //     ->with('posts', Post::orderBy('updated_at', 'DESC')->get());

        //eager loading
        $posts = Post::with('comments')->orderBy('created_at', 'desc')->get();
        $commentable = new Post();
        return view('blog.index', compact('posts', 'commentable'));

        // $posts = Post::all();
        // return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // $request->validate();

        Post::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/posts')
            ->with('message', 'Your post has been added!');

        // $validated = $request->validated();

        // $post = new Post();
        // $post->title = $validated['title'];
        // $post->text = $validated['text'];
        // $post->user_id = 1; // assuming there's a relationship between post and user

        // $post->save();

        // return response()->json([
        //     'message' => 'Post created successfully!',
        //     'data' => new PostResource($post),
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('blog.show')
            ->with('post', Post::where('id', $id)->first());

        // $post = Post::findOrFail($id);
        // return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('blog.edit')
            ->with('post', Post::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {

        Post::where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'text' => $request->input('text'),
                'user_id' => auth()->user()->id
            ]);

        return redirect('/posts')
            ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::where('id', $id);
        $post->delete();

        // request from the same page >> back

        return back()
            ->with('message', 'Your post has been deleted!');
    }
}
