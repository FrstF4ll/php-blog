<?php
$pdo = require __DIR__ . '/../config/db.php';

use Frstf4ll\PhpBlog\PageController;
use Frstf4ll\PhpBlog\Post\PostController;
use Frstf4ll\PhpBlog\Post\PostFileUploader;
use Frstf4ll\PhpBlog\Post\PostRepository;
use Frstf4ll\PhpBlog\Post\PostService;
use Frstf4ll\PhpBlog\Post\PostValidation;

$validator = new PostValidation();
$uploader = new PostFileUploader();
$repository = new PostRepository($pdo);

$postService = new PostService($validator, $repository, $uploader);
$postController = new PostController($postService);

$pageController = new PageController();

return [
    'PageController' => $pageController,
    'PostController' => $postController
];
