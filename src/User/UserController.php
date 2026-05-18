<?php

namespace Frstf4ll\PhpBlog\User;

class UserController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(array $userData): array
    {
        $name = $userData['name'];
        $email = $userData['email'];
        $password = $userData['password'];
        $confirmPassword = $userData['password_confirm'];

        return $this->userService->register($name, $email, $password, $confirmPassword);
    }

    public function authenticateSession(array $userData): array {
        $email = $userData['email'] ?? '';
        $password = $userData['password'] ?? '';
        $result = $this->userService->login($email, $password);
        if($result['success']){
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
        }
        return $result;
    }
}