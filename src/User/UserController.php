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
        $name = $userData['name'] ?? '';
        $email = $userData['email'] ?? '';
        $password = $userData['password'] ?? '';
        $confirmPassword = $userData['password_confirm'] ?? '';
        try {
            $this->userService->register($name, $email, $password, $confirmPassword);
            $this->flashAndRedirect('success', 'Registration successful, you can now log in.', '?pages=login');

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
            session_regenerate_id(true);
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $this->flashAndRedirect('success', 'Login successful.', '?pages=home');

        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=login');
        }
    }

    public function renderUser(int $id)
    {
        return $this->userService->findWithAuthor($id);
    }

    public function getConnectedUser(int $id): ?UserDTO
    {
        return $this->userService->getSingleUser($id);
    }

    public function editUserProfile(UserDTO $user): void
    {
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
            $this->flashAndRedirect('success', 'Profile updated !', '?pages=manage');
        } catch (ServiceException $e) {
            $this->flashAndRedirect('error', $e->getMessage(), '?pages=home');
        }
    }
}