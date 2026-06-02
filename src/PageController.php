<?php

namespace Frstf4ll\PhpBlog;

use Frstf4ll\PhpBlog\Core\BaseController;
use Frstf4ll\PhpBlog\Post\PostService;
use Frstf4ll\PhpBlog\User\UserService;

class PageController extends BaseController
{
    public function __construct(private PostService $postService , private UserService $userService, private PageService $pageService)
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
        $this->pageService->deleteSession();
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
        $post = $this->postService->getSingle((int)$_GET['id']);
        require __DIR__ . '/../views/pages/edit_post.php';
    }

    public function post(): void
    {
        $post = $this->postService->getSingle((int)$_GET['id']);
        require __DIR__ . '/../views/pages/post.php';
    }

    public function profile(): void
    {
        $user = $this->userService->getSingleUser((int)$_SESSION['id']);

        if (!$user) {
            $this->flashAndRedirect('error', 'You must be logged in to access this page.', '?pages=login');
            return;
        }
        require __DIR__ . '/../views/pages/profile.php';
    }

}