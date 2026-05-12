<?php

namespace Frstf4ll\PhpBlog\User;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    private function failure($message): array
    {
        return ['success' => false, 'message' => $message];
    }

    private function validation(string $name, string $email, string $password, string $confirmPassword)
    {
        if (empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
            return $this->failure('Please fill all the required fields');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->failure('Please provide a valid email address');
        }

        if (empty($confirmPassword)) {
            return $this->failure('Please confirm your password');
        }

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

        if ($password !== $confirmPassword) {
            return $this->failure('Confirmed password does not match');
        }
        return ['success' => true];
    }

    public function register(string $name, string $email, string $password, string $confirmPassword): array
    {
        $validation = $this->validation($name, $email, $password, $confirmPassword);

        if (!$validation['success']) {
            return $validation;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);

        return ['success' => true, 'message' => 'Account created successfully, you can now login'];
    }

    public function login(string $email){
        $user = $this->repository->getUser($email);
        if (!$user) {
        return $this->failure('No account found with this email, please try registering');
        }
        return ['success' => true, 'message' => 'Login successful !'];
    }
}