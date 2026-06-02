<?php

namespace Frstf4ll\PhpBlog;

use Frstf4ll\PhpBlog\Core\BaseController;

class PageController extends BaseController
{
    public function __construct(private PageService $pageService)
    {
    }

    public function not_found(): void
    {
        http_response_code(403);
        require __DIR__ . '/../views/pages/not_found.php';
    }

    public function forbidden(): void
    {
        http_response_code(403);
        require __DIR__ . '/../views/pages/forbidden.php';
    }

    public function home(): void
    {
        $posts = $this->viewData['posts'] ?? [];
        $user = $this->viewData['user'] ?? null;

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
        $posts = $this->viewData['posts'] ?? [];
        $user = $this->viewData['user'] ?? null;

        require __DIR__ . '/../views/pages/manage_posts.php';
    }

    public function edit(): void
    {
        if ($this->isAdmin()) {
        $posts = $this->viewData['posts'] ?? [];
        }

        $post = $this->viewData['post'] ?? null;
        require __DIR__ . '/../views/pages/edit_post.php';
    }

    public function post(): void
    {
        $post = $this->viewData['post'] ?? null;
        require __DIR__ . '/../views/pages/post.php';
    }

    public function profile(): void
    {
        $user = $this->viewData['user'] ?? null;
        if(!$user){
            $this->flashAndRedirect('error', 'You must be logged in to access this page.', '?pages=login');
            return;
        }
        require __DIR__ . '/../views/pages/profile.php';
    }

}