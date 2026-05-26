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
            $this->flash('success', 'Registration successful, you can now log in.');
            $this->redirect('?pages=login');

        } catch (ServiceException $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('?pages=register');
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
            $this->flash('success', 'Login successful.');
            $this->redirect('?pages=home');

        } catch (ServiceException $e) {
            $this->flash('error', $e->getMessage());
            $this->redirect('?pages=login');
        }
    }

    public function renderUser(int $id)
    {
        return $this->userService->findWithAuthor($id);
    }
}