<?php

namespace Frstf4ll\PhpBlog;

use Frstf4ll\PhpBlog\User\UserController;

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
}