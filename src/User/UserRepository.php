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
        $query = "select 1 from users where email = :email limit 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        return (bool) $stmt->fetchColumn();
    }

    public function getUser(string $email): ?array
    {
        $query = "select id, name, password from users where email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function joinUser(int $id)
    {
        $query = "SELECT posts.id, posts.title, posts.content, users.name as author_name 
              FROM posts
              INNER JOIN users ON users.id = posts.user_id
              WHERE posts.id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function selectSingleUser(int $userId): ?UserDTO
    {
        $query = "select * from users where id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $userId]);

        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return new UserDTO(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            id: (int)$data['id']
        );
    }
}