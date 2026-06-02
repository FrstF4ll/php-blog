<?php

namespace Frstf4ll\PhpBlog\User;

readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int $role_id = null,
        public ?int   $id = null,
    )
    {
    }

    public function getFields()
    {
        $data = get_object_vars($this);
        unset($data['id']);
        return array_filter($data, fn($value) => $value !== null);
    }
}