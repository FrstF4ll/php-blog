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
        $query = "insert into users(role_id, name, email, password) values(:role_id, :name, :email, :password)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'role_id' => $dto->role_id,
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

        return (bool)$stmt->fetchColumn();
    }

    public function getUser(string $email): ?array
    {
        $query = "select id, name, password, role_id from users where email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function selectSingleUser(int $userId): ?UserDTO
    {
        $query = "select * from users where id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $userId]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        return new UserDTO(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            role_id: $data['role_id'],
            id: (int)$data['id']
        );
    }

    public function updateUser(UserDTO $dto): bool
    {
        $data = $dto->getFields();

        if (empty($data)) {
            return false;
        }

        $keys = array_keys($data);
        $mapped = array_map(fn($key) => "$key = :$key", $keys);
        $fields = implode(', ', $mapped);

        $query = "update users set $fields where id = :id";
        $stmt = $this->pdo->prepare($query);
        $payload = array_merge($data, ['id' => $dto->id]);
        return $stmt->execute($payload);
    }

}