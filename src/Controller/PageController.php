<?php

namespace Frstf4ll\PhpBlog\Controller;

class PageController
{
    private array $pages = [
        'home' => __DIR__ . '/../../views/pages/home.php',
        'login' => __DIR__ . '/../../views/pages/login.php',
        'register' => __DIR__ . '/../../views/pages/register.php',
        'create' => __DIR__ . '/../../views/pages/create_post.php',
        'manage' => __DIR__ . '/../../views/pages/manage_posts.php',
        'edit' => __DIR__ . '/../../views/pages/edit_post.php',
        'post' => __DIR__ . '/../../views/pages/blog_post.php',
    ];

    private function render(string $page): void
    {
        $path = $this->pages[$page] ?? null;
        if ($path === null) {
            http_response_code(404);
            echo '<h1>404 - Not found</h1>';
            echo '<p>The page you requested does not exist.</p>';
            return;
        }

        include $path;
    }

    public function home(): void
    {
        $this->render('home');
    }

    public function login(): void
    {
        $this->render('login');
    }

    public function register(): void
    {
        $this->render('register');
    }

    public function create(): void
    {
        $this->render('create');
    }

    public function manage(): void
    {
        $this->render('manage');
    }

    public function edit(): void
    {
        $this->render('edit');
    }

    public function post(): void
    {
        $this->render('post');
    }
}