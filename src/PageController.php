<?php

namespace Frstf4ll\PhpBlog;

use Frstf4ll\PhpBlog\Core\BaseController;
use Frstf4ll\PhpBlog\Post\PostService;
use Frstf4ll\PhpBlog\User\UserService;
use Frstf4ll\PhpBlog\Post\PostDTO;

class PageController extends BaseController
{
    public function __construct(private PostService $postService, private UserService $userService)
    {
    }

    public function not_found(): void
    {
        http_response_code(404);
        require __DIR__ . '/../views/pages/not_found.php';
    }

    public function forbidden(): void
    {
        http_response_code(403);
        require __DIR__ . '/../views/pages/forbidden.php';
    }

    public function postExists(): ?PostDTO
    {
        $id = (int)($_GET['id'] ?? 0);
        $post = $this->postService->getSingle($id);
        if (!$post) {
            $this->not_found();
            return null;
        }
        return $post;
    }

    public function home(): void
    {
        $posts = $this->postService->getAll();
        require __DIR__ . '/../views/pages/home.php';
    }

    public function login(): void
    {
        require __DIR__ . '/../views/pages/login.php';
    }

    public function logout(): void
    {
        $this->userService->deleteSession();
        require __DIR__ . '/../views/pages/logout.php';
    }

    public function register(): void
    {
        require __DIR__ . '/../views/pages/register.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../views/pages/create_post.php';
    }

    public function manage(): void
    {
        $posts = $this->postService->getAll();
        require __DIR__ . '/../views/pages/manage_posts.php';
    }

    public function edit(): void
    {
        $post = $this->postExists();
        if (!$post) return;
        require __DIR__ . '/../views/pages/edit_post.php';
    }

    public function post(): void
    {
        $post = $this->postExists();
        if (!$post) return;
        require __DIR__ . '/../views/pages/post.php';
    }

    public function profile(): void
    {
        $userId = $_SESSION['id'] ?? null;

        $user = $this->userService->getSingleUser($userId);

        if (!$user) {
            $this->flashAndRedirect('error', 'You must be logged in to access this page.', '?pages=login');
            return;
        }
        require __DIR__ . '/../views/pages/profile.php';
    }

}