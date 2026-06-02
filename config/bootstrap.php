<?php
$pdo = require __DIR__ . '/../config/db.php';

use Frstf4ll\PhpBlog\{
    PageController,
    PageService,
    Core\Router,
    Post\PostController,
    Post\PostFileUploader,
    Post\PostRepository,
    Post\PostService,
    Post\PostValidation,
    User\UserController,
    User\UserRepository,
    User\UserService
};

$validator = new PostValidation();
$uploader = new PostFileUploader();
$repository = new PostRepository($pdo);

$postService = new PostService($validator, $repository, $uploader);
$postController = new PostController($postService);




$userRepository = new UserRepository($pdo);
$userService = new UserService($userRepository);
$userController = new UserController($userService);

$pageService = new PageService();
$pageController = new PageController($postService, $userService, $pageService);
$router = new Router($pageService);
return [
    'PageController' => $pageController,
    'PostController' => $postController,
    'PageService' => $pageService,
    'UserController' => $userController,
    'Router' => $router,
];
