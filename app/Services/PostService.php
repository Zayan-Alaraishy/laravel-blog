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
        return $this->postRepository->save($data);
    }
    public function getPostsWithComments()
    {
        $posts = $this->postRepository->getAll();
        $posts->load('comments');
        $posts = $posts->sortByDesc('created_at');
        return $posts;
    }
    public function getPostById($id)
    {
        return $this->postRepository->getById($id);
    }
    public function updatePostById($newDetails, $id)
    {
        return $this->postRepository->update($id, $newDetails);
    }
    public function deletePostById($id)
    {
        $this->postRepository->delete($id);

    }


}