<?php
$pdo = require __DIR__ . '/../config/db.php';

use Frstf4ll\PhpBlog\{
    PageController,
    Core\Router,
    Category\CategoryController,
    Category\CategoryRepository,
    Category\CategoryService,
    Post\PostController,
    Post\PostFileUploader,
    Post\PostRepository,
    Post\PostService,
    Post\PostValidation,
    User\UserController,
    User\UserRepository,
    User\UserService
};

$postValidator = new PostValidation();
$postFileUploader = new PostFileUploader();

$postRepository = new PostRepository($pdo);
$postService = new PostService($postValidator, $postRepository, $postFileUploader);
$postController = new PostController($postService);


$userRepository = new UserRepository($pdo);
$userService = new UserService($userRepository);
$userController = new UserController($userService);

$categoryRepository = new CategoryRepository($pdo);
$categoryService = new CategoryService($categoryRepository);
$categoryController = new CategoryController($categoryService);
$pageController = new PageController($postService, $userService, $categoryService);
$router = new Router();
return [
    'PageController' => $pageController,
    'PostController' => $postController,
    'UserController' => $userController,
    'CategoryController' => $categoryController,
    'Router' => $router,
];
