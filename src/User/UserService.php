<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\Post\PostRepository;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    private function validation($email)
    {
        $this->repository->emailExists($email);
        if ($this->repository->emailExists($email)) {
            return ['valid' => false, 'message' => 'Email already taken'];
        }
        return ['valid' => true, 'message' => null];
    }

    public function register($name, $email, $password)
    {
        $validation = $this->validation($email);

        if (!$validation['valid']) {
            return ['success' => false, 'error' => $validation['message']];
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);

        return ['success' => true, 'message' => 'Account created successfully, please, log in'];
    }
}