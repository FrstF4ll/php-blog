<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;
use Frstf4ll\PhpBlog\BaseController;

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

    public function createPost(array $postData): void
    {
        $title = $postData['title'];
        $content = $postData['content'];
        $date = date('Y-m-d');
        $user_id = $_SESSION['id'];
        try {
            $this->postService->create($title, $content, $user_id, $date);

            $this->flash('success', 'Post created !');
            $this->redirect('?pages=home');
        } catch (ServiceException $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('?pages=home');
        }
    }

    public function editPost(PostDTO $post, ?array $file): void
    {
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

            $this->flash('success', 'Successfully updated post');
            $this->redirect('?pages=manage');
        } catch (ServiceException $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('?pages=home');
        }
    }
}