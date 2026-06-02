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

ob_start();
$controllerInstance = $container[$controller];
$page = $controllerInstance->$action();
$pageContent = ob_get_clean();

?>

<?php include dirname(__DIR__, 1) . '/views/layout.php'; ?>

