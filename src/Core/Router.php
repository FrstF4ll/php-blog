<?php

namespace Frstf4ll\PhpBlog\Core;

class Router
{
    private function routeVerification($page, $allowedPages)
    {
        $page = !in_array($page, $allowedPages) ? 'not_found' : $page;
        return $page;
    }

    private function routeSetup($page, $allowedPages, $tokenPages)
    {
        $ValidRoute = $this->routeVerification($page, $allowedPages);

        if ((in_array($ValidRoute, $tokenPages)) && empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            return $ValidRoute;
        }

        return $ValidRoute;
    }

    public function getPage()
    {
        $routeConfig = require __DIR__ . '/../../config/routes.php';
        $allowedPages = $routeConfig['allowed_pages'];
        $tokenPages = $routeConfig['token_pages'];

        $page = $_GET['pages'] ?? 'home';
        return $this->routeSetup($page, $allowedPages, $tokenPages);
    }
}