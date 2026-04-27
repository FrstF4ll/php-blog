<?php

namespace Frstf4ll\PhpBlog;

class PostDTO
{
    public string $title;
    public string $content;
    public string $date;
    public int $userId;
    public ?string $fileName;

    public function __construct(string $title, string $content, string $date, int $userId, ?string $fileName)
    {
        $this->title = $title;
        $this->content = $content;
        $this->date = $date;
        $this->userId = $userId;
        $this->fileName = $fileName;
    }
}