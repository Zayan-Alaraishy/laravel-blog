<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function savePostData($data)
    {

        $this->postRepository->save($data);
    }
    public function getPostsWithComments()
    {

        $posts = $this->postRepository->getAll();
        $posts->load('comments');
        $posts = $posts->sortByDesc('created_at');
        return $posts;
    }
    public function updatePost($data, $id)
    {
        $this->postRepository->update($data, $id);

    }
    public function deletePostById($id)
    {
        $this->postRepository->delete($id);

    }


}