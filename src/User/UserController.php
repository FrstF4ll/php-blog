<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\BaseController;
use Frstf4ll\PhpBlog\ServiceException;

class UserController extends BaseController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(array $userData): void
    {
        $name = $userData['name'];
        $email = $userData['email'];
        $password = $userData['password'];
        $confirmPassword = $userData['password_confirm'];
        try {
            $this->userService->register($name, $email, $password, $confirmPassword);
            $this->flashAndRedirect('success', 'Registration successful, you can now log in.','?pages=login');

        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=register');
        }
    }

    public function authenticateSession(array $userData): void
    {
        $email = $userData['email'] ?? '';
        $password = $userData['password'] ?? '';
        try {
            $result = $this->userService->login($email, $password);
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $this->flashAndRedirect('success', 'Login successful.','?pages=home');

        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(),'?pages=login');
        }
    }

    public function renderUser(int $id)
    {
        return $this->userService->findWithAuthor($id);
    }
}