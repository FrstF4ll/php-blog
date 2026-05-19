<?php

namespace Frstf4ll\PhpBlog;


class PageController
{
    private array $pages = [
        'home' => __DIR__ . '/../views/pages/home.php',
        'login' => __DIR__ . '/../views/pages/login.php',
        'logout' => __DIR__ . '/../views/pages/logout.php',
        'register' => __DIR__ . '/../views/pages/register.php',
        'create' => __DIR__ . '/../views/pages/create_post.php',
        'manage' => __DIR__ . '/../views/pages/manage_posts.php',
        'edit' => __DIR__ . '/../views/pages/edit_post.php',
        'post' => __DIR__ . '/../views/pages/post.php',
        'not_found' => __DIR__ . '/../views/pages/not_found.php'
    ];

    private array $viewData = [];

    public function __construct(private PageService $pageService)
    {
    }

    public function setViewData(array $data): void
    {
        $this->viewData = $data;
    }


    private function render(string $page): void
    {
        $path = $this->pages[$page] ?? null;
        if ($path === null) {
            http_response_code(404);
            echo '<h1>404 - Not found</h1>';
            echo '<p>The page you requested does not exist.</p>';
            return;
        }

        extract($this->viewData);
        include $path;
    }

    private function guestRender($page): void
    {
        empty($_SESSION['id']) ?   $this->render('login') : $this->render($page);
    }

    public function home(): void
    {
        $this->render('home');
    }

    public function login(): void
    {
        $this->render('login');
    }

    public function logout(): void
    {
        $this->guestRender('logout');
    }

    public function register(): void
    {
        $this->render('register');
    }

    public function create(): void
    {
        $this->guestRender('create');
    }

    public function manage(): void
    {
        $this->guestRender('manage');
    }

    public function edit(): void
    {
        $this->guestRender('edit');
    }

    public function post(): void
    {
        $this->render('post');
    }

    public function not_found(): void
    {
        $this->render('not_found');
    }
}