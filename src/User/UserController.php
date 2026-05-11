<?php

namespace Frstf4ll\PhpBlog\User;

class UserController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(array $postData): array
    {
        $name = $postData['name'];
        $email = $postData['email'];
        $password = $postData['password'];

        return $this->userService->register($name, $email, $password);
    }
}