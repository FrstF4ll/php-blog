<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\ServiceException;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    private function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ServiceException('Please provide a valid email address');
        }
    }

    private function validatePassword(string $password): void
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';

        if (strlen($password) < 8) {
            throw new ServiceException('Password must be at least 8 characters');
        }

        if (!preg_match($pattern, $password)) {
            throw new ServiceException('Password needs a mix of uppercase, lowercase, and numbers.');
        }
    }

    private function validation(string $name, string $email, string $password): void
    {
        if (empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
            throw new ServiceException('Please fill all the required fields');
        }

        if ($this->repository->selectExistingEmailS($email)) {
            throw new ServiceException('Email already exists');
        }

        $this->validateEmail($email);
        $this->validatePassword($password);
    }


    public function deleteSession(): void
    {
        $_SESSION = [];
        session_destroy();
    }

    public function register(string $name, string $email, string $password, string $confirmPassword): void
    {
        $this->validation($name, $email, $password);

        if (empty($confirmPassword)) {
            throw new ServiceException('Please confirm your password');
        }

        if ($password !== $confirmPassword) {
            throw new ServiceException('Confirmed password does not match');
        }

        $role_id = 1;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password, $role_id);
        $this->repository->createUser($requestDTO);
    }

    public function login(string $email, string $password): array
    {
        $user = $this->repository->selectUserByMail($email);
        if ($user && password_verify($password, $user->password)) {
            return ['id' => $user->id, 'name' => $user->name, 'role_id' => $user->role_id];
        }
        throw new ServiceException('Wrong credentials, register or retry.');
    }

    public function update(UserDTO $dto, bool $passwordChanged = false)
    {
        $existingUser = $this->repository->selectUserByMail($dto->email);
        if ($existingUser && (int)$existingUser->id !== (int)$dto->id) {
            throw new ServiceException('Email already exists');
        }

        $password = $dto->password;
        if ($passwordChanged) {
            $this->validatePassword($password);
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $updated = new UserDTO(name: $dto->name, email: $dto->email, password: $password, id: $dto->id);
        if (!$this->repository->updateUser($updated)) {
            throw new ServiceException('Failed to update profile. Please try again.');
        }
    }

    public function getSingleUser(int $id): ?UserDTO
    {
        return $this->repository->selectUserById($id);
    }

}