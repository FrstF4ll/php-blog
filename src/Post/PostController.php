<?php

namespace Frstf4ll\PhpBlog\Post;

class PostController
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function handleResultRedirect($result, $redirect)
    {

        if ($result['success']) {
            $_SESSION['notification'] = $result['message'];
            header("Location: $redirect");
            exit;
        }

        return $result['error'] ?? null;
    }

    public
    function list(): array
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

    public function createPost(array $postData): array
    {
        $title = $postData['title'];
        $content = $postData['content'];
        $date = date('Y-m-d');
        $user_id = 1;

        return $this->postService->create($title, $content, $user_id, $date);
    }

    public function editPost(PostDTO $dto, $file): array
    {
        return $this->postService->update($dto, $file);
    }
}