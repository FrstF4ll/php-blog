<?php

namespace Frstf4ll\PhpBlog\Controller;
use Frstf4ll\PhpBlog\PostService;

class PostController
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function list(): array
    {
        return $this->postService->get();
    }
}