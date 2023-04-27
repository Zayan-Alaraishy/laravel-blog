<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{

    /**
     * @var Comment
     */
    protected $comment;

    /**
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function save($data, $commentable_id, $commentable_type)
    {

        $comment = new $this->comment;

        $comment->body = $data['body'];
        $comment->user_id = auth()->user()->id;
        $comment->commentable_id = $commentable_id;
        $comment->commentable_type = $commentable_type;

        $comment->save();

        return $comment->fresh();
    }
}