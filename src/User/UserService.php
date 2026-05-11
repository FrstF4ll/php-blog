<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\Post\PostRepository;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    private function failure($message)
    {
        return ['success' => false, 'message' => $message];
    }

    private function validation($email, $password, $confirmPassword)
    {
        if ($this->repository->emailExists($email)) {
            return $this->failure('Email already exists');
        }
        if (strlen($password) < 8) {
            return $this->failure('Password must be at least 8 characters');
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        if (!preg_match($pattern, $password)) {
            return $this->failure('Password needs a mix of uppercase, lowercase, and numbers.');
        }

        if ($password != $confirmPassword) {
            return $this->failure('Confirmed password does not match');
        }
        return ['success' => true, 'message' => 'Account created'];
    }

    public function register($name, $email, $password, $confirmPassword)
    {
        $validation = $this->validation($email, $password, $confirmPassword);

        if (!$validation['success']) {
            return $validation;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);

        return $validation;
    }
}