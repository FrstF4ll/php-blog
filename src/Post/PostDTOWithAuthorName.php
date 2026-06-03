<?php

namespace Frstf4ll\PhpBlog\Post;

readonly class PostDTOWithAuthorName extends PostDTO
{
    public function __construct(
        public string $author_name,
        string $title,
        string $content,
        string $created_at,
        int $user_id,
        ?string $image = null,
        ?int $id = null
    )
    {
        parent::__construct($title, $content, $created_at, $user_id, $image, $id);
    }
}