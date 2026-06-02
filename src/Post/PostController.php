<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;
use Frstf4ll\PhpBlog\Core\BaseController;

class PostController extends BaseController
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

    public function createPost(): void
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $date = date('Y-m-d');
        $user_id = $_SESSION['id'] ?? null;

        if (empty($user_id)) {
            $this->flashAndRedirect('error', "Error : Can't identify user", "?pages=create");
            return;
        }

        try {
            $this->postService->create($title, $content, $user_id, $date);

            $this->flashAndRedirect('success', 'Post created !', '?pages=home');
        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=home');
        }
    }

    public function editPost(): void
    {
        $postId = $_GET['id'] ?? null;
        if (!$postId) {
            $this->flashAndRedirect('error', 'Missing post id.', '?pages=manage');
            return;
        }

        $post = $this->postService->getSingle((int)$postId);
        if (!$post) {
            $this->flashAndRedirect('error', 'Post not found.', '?pages=manage');
            return;
        }

        $userId = $_SESSION['id'] ?? null;
        if ($userId === null || ((int)$post->user_id !== (int)$userId && !$this->isAdmin())) {
            $this->flashAndRedirect('error', 'You are not allowed to edit this post.', '?pages=home');
            return;
        }

        $file = $_FILES['image'] ?? null;
        $data = new PostDTO(
            title: $_POST['title'] ?? $post->title,
            content: $_POST['content'] ?? $post->content,
            created_at: $post->created_at,
            user_id: $post->user_id,
            image: $post->image,
            id: $post->id
        );
        try {
            $this->postService->update($data, $file);
            $this->flashAndRedirect('success', 'Post updated !', '?pages=manage');
        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=home');
        }
    }

    public function resolveCurrentPost()
    {
        $postId = $_GET['id'] ?? null;
        return [
            'post' => $postId ? $this->show((int)$postId) : null,
            'posts' => $this->list(),
        ];
    }
}