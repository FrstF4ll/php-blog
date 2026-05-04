<?php

namespace Frstf4ll\PhpBlog\Controller;

use Frstf4ll\PhpBlog\PostDTO;
use Frstf4ll\PhpBlog\PostService;

class PostController
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function list(): array
    {
        $posts = $this->postService->getAll();
        return $this->formatPosts($posts);
    }

    public function show(int $id): ?PostDTO
    {
        return $this->postService->getSingle($id);
    }

    private function formatPosts(array $posts): array
    {
        return array_map(function ($post) {
            $post['created_at'] = date('d M. Y', strtotime($post['created_at']));
            return $post;
        }, $posts);
    }
}