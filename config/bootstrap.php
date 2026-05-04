<?php
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

return [
    'PostController' => $postController,
]
?>