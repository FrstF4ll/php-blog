<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;
use Frstf4ll\PhpBlog\Core\BaseController;

class PostController extends BaseController
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function checkEditPermission($postId, $post, $userId): bool
    {

        if (!$postId) {
            $this->flashAndRedirect('error', "Can't get post id", '?pages=manage');
            return false;
        }

        if (!$post) {
            $this->flashAndRedirect('error', 'Post not found.', '?pages=manage');
            return false;
        }

        if ($userId === null || ((int)$post->user_id !== (int)$userId && !$this->isAdmin())) {
            $this->flashAndRedirect('error', 'You are not allowed to edit this post.', '?pages=home');
            return false;
        }
        return true;
    }

    public function createPost(): void
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $date = date('Y-m-d');
        $userId = $_SESSION['id'] ?? null;
        $catId = $_POST['category'] ?? 1;
        $image = $_FILES['image'] ?? null;

        if (empty($userId)) {
            $this->flashAndRedirect('error', "Error : Can't get user id", "?pages=create");
            return;
        }

        try {
            $this->postService->create($title, $content, $date, $userId, $catId, $image);

            $this->flashAndRedirect('success', 'Post created !', '?pages=home');
        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=home');
        }
    }

    public function editPost(): void
    {
        $postId = $_GET['id'] ?? null;
        $title = $_POST['title'] ?? null;
        $content = $_POST['content'] ?? null;
        $userId = $_SESSION['id'] ?? null;
        $file = $_FILES['image'] ?? null;

        $post = $this->postService->getSingle((int)$postId);


        if (!$this->checkEditPermission($postId, $post, $userId)) return;

        $data = new PostDTO(
            title: $title ?? $post->title,
            content: $content ?? $post->content,
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

}