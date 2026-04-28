<?php

namespace Frstf4ll\PhpBlog;

readonly class PostDTO
{
    public function __construct(
        public string $title,
        public string $content,
        public string $date,
        public int $userId,
        public ?string $fileName = null
    ) {}
}