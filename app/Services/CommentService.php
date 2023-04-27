<?php
namespace App\Services;

// CommentService.php
use App\Repositories\CommentRepository;
use App\Models\Comment;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment($data, $commentable_id, $commentable_type)
    {
        $this->commentRepository->save($data, $commentable_id, $commentable_type);

        // $comment = new Comment();
        // $comment->body = $data['body'];
        // $comment->user_id = auth()->user()->id;
        // $comment->commentable_id = $commentable_id;
        // $comment->commentable_type = $commentable_type;

        // $this->commentRepository->save($comment);
    }
}