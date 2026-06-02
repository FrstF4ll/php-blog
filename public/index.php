<?php

require_once __DIR__ . '/../vendor/autoload.php';

// App bootstrap
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
$router = $container['Router'];

$page = $_GET['pages'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];
[$controller, $action] = $router->dispatch($method, $page);

$user = $userController->resolveCurrentUser($page);
$postData = $postController->resolveCurrentPost();

$pageController->setViewData([
        'post' => $postData['post'],
        'posts' => $postData['posts'],
        'user' => $user,
]);

ob_start();
$controllerInstance = $container[$controller];
$page = $controllerInstance->$action();
$pageContent = ob_get_clean();

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
<main> <?php if (isset($_SESSION['flash'])):
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        $error_color = 'text-red-700 border border-red-500 bg-red-50';
        $success_color = 'text-green-700 border border-green-500 bg-green-50';

        $isSuccess = ($flash['type'] === 'success');
        $colors = $isSuccess ? $success_color : $error_color;
        ?>
        <div class='<?= $colors ?> rounded-md p-2.5 mb-2.5'>
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>
    <?= $pageContent ?>
</main>

<?php include "../views/components/footer.php"; ?>

</body>
</html>
