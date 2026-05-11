<?php

namespace Frstf4ll\PhpBlog\User;

use PDO;

class UserRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function createUser(UserDTO $dto): void
    {
        $query = "insert into users(name, email, password) values(:name, :email, :password)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function emailExists(string $email): bool
    {
        $query = "select email from users where email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        return (bool) $stmt->fetchColumn();
    }
}