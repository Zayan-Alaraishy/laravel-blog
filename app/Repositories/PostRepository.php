<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\IPostRepository;

class PostRepository implements IPostRepository
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post
            ->get();
    }

    public function getById($id)
    {
        $post = new $this->post;
        return $post->findOrFail($id);
    }

    public function save($details)
    {
        $post = new $this->post;

        $post->title = $details['title'];
        $post->text = $details['text'];
        $post->user_id = auth()->user()->id;

        $post->save();

        return $post->fresh();
    }

    public function update($id, $newDetails)
    {

        $post = $this->post->find($id);

        $post->title = $newDetails['title'];
        $post->text = $newDetails['text'];

        $post->update();

        return $post;
    }

    public function delete($id)
    {
        $post = $this->post->find($id);
        $post->delete();
    }

}