<?php

namespace Frstf4ll\PhpBlog;

readonly class PostDTO
{
    public function __construct(
        public string  $title,
        public string  $content,
        public string  $date,
        public int     $userId,
        public ?string $image = null,
        public ?int    $postId = null
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