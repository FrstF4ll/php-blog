<?php

namespace Frstf4ll\PhpBlog;

abstract class BaseController

{
    protected function flash(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message
        ];
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}