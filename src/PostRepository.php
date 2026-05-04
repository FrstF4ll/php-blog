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
            'image' => $dto->image,
            'date' => $dto->date,
            'user_id' => $dto->userId
        ]);
    }

    public function getAllPosts(): array
    {
        $stmt = $this->pdo->query('select * from posts order by created_at asc');
        return $stmt->fetchAll();
    }

    public function getSinglePost(int $postId): ?PostDTO {
        $query = "select * from posts where id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $postId]);

        $data = $stmt->fetch();
        if(!$data){
            return null;
        }
        return new PostDTO(
            title: $data['title'],
            content: $data['content'],
            date: $data['created_at'],
            userId: (int)$data['user_id'],
            image: $data['image'],
            postId: (int)$data['id']
        );
    }
}