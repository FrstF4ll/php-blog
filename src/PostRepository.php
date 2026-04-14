<?php

namespace Frstf4ll\PhpBlog;

use PDO;

class PostRepository
{
    private PDO $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createPost($title, $content, $fileName, $date, $user_id)
    {
        $query = "insert into posts(title, content, image, created_at, user_id ) 
values(:title, :content, :image, :date, :user_id)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'title' => $title,
            'content' => $content,
            'image' => $fileName,
            'date' => $date,
            'user_id' => $user_id
        ]);
    }

}