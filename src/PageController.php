<?php

namespace Frstf4ll\PhpBlog;

use Frstf4ll\PhpBlog\{
    Core\BaseController,
    Post\PostService,
    User\UserService,
    Category\CategoryService,
    Post\PostDTO,
};

class PageController extends BaseController
{
    public function __construct(private PostService $postService, private UserService $userService, private CategoryService $categoryService)
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

    private function postExists(): ?PostDTO
    {
        $id = (int)($_GET['id'] ?? 0);
        $post = $this->postService->getSingle($id);
        if (!$post) {
            $this->flashAndRedirect('error', "Can't find your post.", "?pages=not_found");
        }
        return $post;
    }

    private function isConnected(): void
    {
        $connectedUserId = $_SESSION['id'] ?? null;
        if (empty($connectedUserId)) {
            $this->flashAndRedirect('error', "You need to connect to see this page.", "?pages=login");
        }
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
        $this->isConnected();
        $categories = $this->categoryService->getAllCategories();
        require __DIR__ . '/../views/pages/create_post.php';
    }

    public function manage(): void
    {
        $this->isConnected();

        if (isset($_POST['action_delete'])) {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                $this->flashAndRedirect('error', 'Invalid CSRF token.', '?pages=manage');
            }
            try {
                $postId = (int) $_POST['id'];
                $post = $this->postService->getSingle($postId);
                if (!$post) {
                    $this->flashAndRedirect('error', 'Post not found.', '?pages=manage');
                }
                if ((int)$post->user_id !== (int)$_SESSION['id'] && !$this->isAdmin()) {
                    $this->flashAndRedirect('error', 'You are not allowed to delete this post.', '?pages=manage');
                }
                $this->postService->removeSinglePost($postId);
                $this->flashAndRedirect('success', 'Post deleted!', '?pages=manage');
            } catch (ServiceException $e) {
                $this->flashAndRedirect('error', $e->getMessage(), '?pages=manage');
            }
        }

        $posts = $this->postService->getAll();
        require __DIR__ . '/../views/pages/manage_posts.php';
    }

    public function edit(): void
    {
        $this->isConnected();
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
        $this->isConnected();
        $userId = $_SESSION['id'];
        $user = $this->userService->getSingleUser($userId);

        if (!$user) {
            $this->flashAndRedirect('error', 'You must be logged in to access this page.', '?pages=login');
            return;
        }
        require __DIR__ . '/../views/pages/profile.php';
    }

}