<?php

namespace Frstf4ll\PhpBlog;

use PDO;

class PostRepository
{


    public function __construct(private readonly PDO $pdo)
    {
    }

    public function createPost(PostDTO $dto)
    {
        $query = "insert into posts(title, content, image, created_at, user_id ) 
values(:title, :content, :image, :date, :user_id)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'title' => $dto->title,
            'content' => $dto->content,
            'image' => $dto->fileName,
            'date' => $dto->date,
            'user_id' => $dto->userId
        ]);
    }

}