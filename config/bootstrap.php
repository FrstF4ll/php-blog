<?php
$pdo = require __DIR__ . '/../config/db.php';

use Frstf4ll\PhpBlog\Controller\PageController;
use Frstf4ll\PhpBlog\PostValidation;
use Frstf4ll\PhpBlog\PostFileUploader;
use Frstf4ll\PhpBlog\PostRepository;
use Frstf4ll\PhpBlog\PostService;
use Frstf4ll\PhpBlog\Controller\PostController;

$validator = new PostValidation();
$uploader = new PostFileUploader();
$repository = new PostRepository($pdo);

$postService = new PostService($validator, $repository, $uploader);
$postController = new PostController($postService);

$pageController = new PageController();

return [
    'PageController' => $pageController,
    'PostController' => $postController
]
?>