<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\ServiceException;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    private function validation(string $name, string $email, string $password): void
    {
        if (empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
            throw new ServiceException('Please fill all the required fields');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ServiceException('Please provide a valid email address');
        }

        if ($this->repository->emailExists($email)) {
            throw new ServiceException('Email already exists');
        }

        if (strlen($password) < 8) {
            throw new ServiceException('Password must be at least 8 characters');
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        if (!preg_match($pattern, $password)) {
            throw new ServiceException('Password needs a mix of uppercase, lowercase, and numbers.');
        }


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


        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);
    }

    public function login(string $email, string $password): array
    {
        $user = $this->repository->getUser($email);
        if ($user && password_verify($password, $user['password'])) {
            return ['id' => $user['id'], 'name' => $user['name']];
        }
        throw new ServiceException('Wrong credentials, register or retry.');
    }

    public function findWithAuthor(int $id)
    {
        return $this->repository->joinUser($id);
    }

    public function update(UserDTO $dto)
    {
        $updated = new UserDTO(name: $dto->name, email: $dto->email, password: $dto->password, id: $dto->id);
        $this->repository->updateUser($updated);
    }

    public function getSingleUser(int $id): ?UserDTO
    {
        return $this->repository->selectSingleUser($id);
    }

}