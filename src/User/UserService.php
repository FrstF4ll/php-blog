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
        if ($this->repository->emailExists($email)) {
            return ['success' => false, 'message' => 'Email already exists'];;
        }
        return ['success' => true, 'message' => 'Account created'];
    }

    public function register($name, $email, $password)
    {
        $validation = $this->validation($email);

        if (!$validation['success']) {
            return $validation;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);

        return $validation;
    }
}