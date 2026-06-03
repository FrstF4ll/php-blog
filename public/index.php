<?php

use Frstf4ll\PhpBlog\ServiceException;

require_once __DIR__ . '/../vendor/autoload.php';

// App bootstrap
session_start([
    'cookie_lifetime' => 0,
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax'
]);
$container = require dirname(__DIR__, 1) . '/config/bootstrap.php';

$router = $container['Router'];

$page = $_GET['pages'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];
try {
    [$controller, $action] = $router->dispatch($method, $page);
    ob_start();
    $controllerInstance = $container[$controller];
    $page = $controllerInstance->$action();
    $pageContent = ob_get_clean();
} catch (ServiceException $e) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => $e->getMessage(),
    ];
    header('Location: ?pages=home');
    exit;
} catch (\Throwable $e) {
    ob_end_clean();
    require __DIR__ . '/../views/pages/server_error.php';
    exit;
}
?>

<?php include dirname(__DIR__, 1) . '/views/layout.php'; ?>

