<?php

namespace Frstf4ll\PhpBlog;

readonly class PostDTO
{
    public function __construct(
        public string  $title,
        public string  $content,
        public string  $created_at,
        public int     $user_id,
        public ?string $image = null,
        public ?int    $id = null
    )
    {
    }

    public function toPayload()
    {
        $data = get_object_vars($this);
        unset($data['id']);
        return array_filter($data, fn($key) => $key !== null);
    }
}