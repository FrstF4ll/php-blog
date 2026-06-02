<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\Core\BaseController;
use Frstf4ll\PhpBlog\Post\PostDTO;
use Frstf4ll\PhpBlog\ServiceException;

class UserController extends BaseController
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password_confirm'] ?? '';
        try {
            $this->userService->register($name, $email, $password, $confirmPassword);
            $this->flashAndRedirect('success', 'Registration successful, you can now log in.', '?pages=login');

        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=register');
        }
    }

    public function authenticateSession(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        try {
            $result = $this->userService->login($email, $password);
            session_regenerate_id(true);
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['role_id'] = $result['role_id'];
            $this->flashAndRedirect('success', 'Login successful.', '?pages=home');

        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=login');
        }
    }

    public function renderUser(int $id)
    {
        return $this->userService->findWithAuthor($id);
    }

    public function getConnectedUser(): ?UserDTO
    {
        $userId = $_SESSION['id'] ?? null;
        if (!$userId) {
            unset($_SESSION['id'], $_SESSION['name']);
            return null;
        }
        $user = $this->userService->getSingleUser($userId);
        return $user;
    }


    public function editUserProfile(): void
    {
        $userId = $_SESSION['id'] ?? null;
        $user = $this->userService->getSingleUser($userId);
        if (!$userId || !$user) {
            $this->flashAndRedirect('error', 'You must be logged in to edit your profile.', '?pages=login');
            return;
        }

        $password = $user->password;
        if (!empty($_POST['password'])) {
            $password = $_POST['password'];
        }

        $data = new UserDTO(
            name: $_POST['name'] ?? $user->name,
            email: $_POST['email'] ?? $user->email,
            password: $password,
            id: $user->id
        );
        try {
            $this->userService->update($data, !empty($_POST['password']));
            $_SESSION['name'] = $data->name;
            $this->flashAndRedirect('success', 'Profile updated !', '?pages=home');
        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=profile');
        }
    }

    public function resolveCurrentUser(string $page)
    {
        $userId = $_SESSION['id'] ?? null;
        if ($userId) {
            $user = $this->getConnectedUser($userId);
            if (!$user) {
                unset($_SESSION['id'], $_SESSION['name']);
                $userId = null;
            }
            return $user;
        }
        if ($page === 'profile') {
            $this->flashAndRedirect('error', 'You should be logged in to access this page', '?pages=login');
            return null;
        }
        return null;
    }
}