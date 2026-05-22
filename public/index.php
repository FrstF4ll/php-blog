<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start([
        'cookie_lifetime' => 0,
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax'
]);
$container = require dirname(__DIR__, 1) . '/config/bootstrap.php';

$error_message = null;

$pageController = $container['PageController'];
$pageService = $container['PageService'];
$postController = $container['PostController'];
$userController = $container['UserController'];

$allowedPages = ['home', 'login', 'register', 'create', 'manage', 'edit', 'post', 'logout', 'forbidden'];
$tokenPages = ['login', 'register', 'create', 'edit'];

$page = $_GET['pages'] ?? 'home';

if ((in_array($page, $tokenPages)) && empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$posts = in_array($page, ['home', 'manage']) ? $postController->list() : [];
$postId = $_GET['id'] ?? null;
$post = null;
if ($postId) {
    $post = $postController->show((int)$postId);
}

$home = '?pages=home';

$actions = [
        'login' => [
                'callback' => fn() => $userController->authenticateSession($_POST),
                'direction' => $home,
        ],
        'register' => [
                'callback' => fn() => $userController->store($_POST),
                'direction' => '?pages=login',
        ],
        'logout' => [
                'callback' => fn() => $pageService->disconnect(),
                'direction' => '?pages=logout',
        ],
        'create' => [
                'callback' => fn() => $postController->createPost($_POST),
                'direction' => $home,
        ],
        'edit' => [
                'callback' => fn() => $postController->editPost($post, $_FILES['image'] ?? null),
                'direction' => '?pages=manage',
        ]
];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($actions[$page])) {
    if($pageService->isTokenValid()){
        $action = $actions[$page];
        $pageService->redirect($action['callback'], $action['direction']);
    }
}

$pageController->setViewData(['posts' => $posts, 'post' => $post]);
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
    if (in_array($page, $allowedPages) && method_exists($pageController, $page)) {
        $pageController->$page();
    } else {
        $pageController->not_found();
    }
    ?>
</main>

<?php include "../views/components/footer.php"; ?>

</body>
</html>
