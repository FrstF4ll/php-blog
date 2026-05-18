<?php

namespace Frstf4ll\PhpBlog;

class PageService
{
    public function redirect(callable $callback, string $direction): void
    {
        $result = $callback();
        if ($result['success']) {
            $_SESSION['notification'] = $result['message'];
            header("Location: $direction");
            exit;
        }
        $_SESSION['error_message'] = $result['message'];
    }

    public function isTokenValid(): bool
    {
        if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $_SESSION['error_message'] = 'Mismatched session token, try again.';
            return false;
        }
        return true;
    }

    public function disconnect(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}