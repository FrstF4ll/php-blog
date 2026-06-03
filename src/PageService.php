<?php

namespace Frstf4ll\PhpBlog;

class PageService
{
    public function isTokenValid(): bool
    {
        if (empty($_POST['csrf_token']) || empty($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $_SESSION['error_message'] = 'Mismatched session token, try again.';
            return false;
        }
        return true;
    }

    public function deleteSession(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}