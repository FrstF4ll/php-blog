<?php

namespace Frstf4ll\PhpBlog\Core;

use Frstf4ll\PhpBlog\PageService;

class Router
{
    public function __construct(private PageService $pageService)
    {
    }

    private function routeVerification($routes, $method, $rawPage)
    {
        $routeRequest = isset($routes[$method][$rawPage])
            ? [$method, $rawPage]
            : ['GET', 'not_found'];

        return $routeRequest;
    }

    private function routeSetup($routes, $method, $rawPage)
    {
        [$method, $page] = $this->routeVerification($routes, $method, $rawPage);

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if ($method === 'POST') {
            if (!$this->pageService->isTokenValid()) {
                $method = 'GET';
                $page = 'forbidden';
            }
        }
        return [$method, $page];
    }

    public function dispatch($method, $rawPage)
    {
        $routes = require __DIR__ . '/../../config/routes.php';

        [$method, $page] = $this->routeSetup($routes, $method, $rawPage);
        [$controller, $action] = $routes[$method][$page];

        return [$controller, $action];
    }
}