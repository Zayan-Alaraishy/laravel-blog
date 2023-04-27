<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentsController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // Display the form to create a new comment

    // public function create($commentable_id, $commentable_type)
    // {
    //     $commentable = $commentable_type::find($commentable_id);

    //     return view('comments.create', compact('commentable'));
    // }

    // Store a new comment in the database
    public function store(CommentRequest $request, $commentable_id, $commentable_type)
    {
        $this->commentService->addComment($request, $commentable_id, $commentable_type);

        return back();
        // $commentable = $commentable_type::find($commentable_id);

        // $comment = new Comment();
        // $comment->body = $request['body'];
        // $comment->user_id = auth()->user()->id;
        // $comment->commentable_id = $commentable_id;
        // $comment->commentable_type = $commentable_type;
        // $comment->save();

        // return back();


        // Comment::create([
        //     'body' => $request->input('body'),
        //     'user_id' => auth()->user()->id,
        //     'commentable_id' => $request->input('commentable_id'),
        //     'commentable_type' => 'App\Models\Post'
        // ]);

        // return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}