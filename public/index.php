<?php

use Frstf4ll\PhpBlog\Controller\PageController;
use Frstf4ll\PhpBlog\Controller\PostController;
use Frstf4ll\PhpBlog\PostFileUploader;
use Frstf4ll\PhpBlog\PostRepository;
use Frstf4ll\PhpBlog\PostService;
use Frstf4ll\PhpBlog\PostValidation;

require_once __DIR__ . '/../vendor/autoload.php';
session_start();

$pageController = new PageController();

$page = $_GET['pages'] ?? 'home';
$error_message = null;


$validator = new PostValidation();
$uploader = new PostFileUploader();

$pdo = require __DIR__ . '/../config/db.php';
$repository = new PostRepository($pdo);
$postService = new PostService($validator, $repository, $uploader);

$postController = new PostController($postService);
$posts = $postController->list();

$postId = $_GET['id'] ?? null;
$post = null;
if($postId){
$post = $postController->show((int)$postId);
}

$pageController->setViewData(['posts' => $posts, 'post' => $post]);
// Post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $page === 'create') {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d');
    $user_id = 1;


    $result = $postService->create($title, $content, $user_id, $date);
    if ($result['success']) {
        $_SESSION['notification'] = $result['message'];
        header('Location: ?pages=home');
        exit;
    } else {
        $error_message = $result['error'];
    }
}
?>


<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <title>php-blog - Home</title>
</head>
<body class="grid grid-rows-[auto_1fr_auto] min-h-full">
<?php include "../views/components/navbar.php"; ?>
<main>
    <?php if (isset($_SESSION['notification'])): ?>
        <div class='text-green-700 border border-green-500 bg-green-50 rounded-md p-2.5 mb-2.5'>
            <?php echo $_SESSION['notification'];
            unset($_SESSION['notification']); ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message !== null) : ?>
        <div class="text-red-700 border border-red-500 bg-red-50 rounded-md p-2.5 mb-2.5">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <?php
    if (method_exists($pageController, $page)) {
        $pageController->$page();
    } else {
        http_response_code(404);
        echo '<h1>404 - Not found</h1>';
        echo '<p>The page you requested does not exist.</p>';
    }
    ?>
</main>

<?php include "../views/components/footer.php"; ?>

</body>
</html>
