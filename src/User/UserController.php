<?php

namespace Frstf4ll\PhpBlog\User;

class UserController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function handleResultRedirect($result, $redirect)
    {

        if (!$result['success']) {
            $_SESSION['error_message'] = $result['error'];
            return null;
        }

        $_SESSION['notification'] = $result['message'];
        header("Location: $redirect");
        exit;
    }

    public function store(array $postData): array
    {
        $name = $postData['name'];
        $email = $postData['email'];
        $password = $postData['password'];

        return $this->userService->register($name, $email, $password);
    }
}