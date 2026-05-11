<?php

namespace Frstf4ll\PhpBlog\User;

readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int   $id = null,
    )
    {
    }
}