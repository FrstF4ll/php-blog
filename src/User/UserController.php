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
            $_SESSION['error_message'] = $result['message'];
            return null;
        }

        $_SESSION['notification'] = $result['message'];
        header("Location: $redirect");
        exit;
    }

    public function store(array $userData): array
    {
        $name = $userData['name'];
        $email = $userData['email'];
        $password = $userData['password'];
        $confirmPassword = $userData['password_confirm'];

        return $this->userService->register($name, $email, $password, $confirmPassword);
    }
}