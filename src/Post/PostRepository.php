<?php

namespace Frstf4ll\PhpBlog\Post;

use PDO;

class PostRepository
{


    public function __construct(private readonly PDO $pdo)
    {
    }

    public function insertPost(PostDTO $dto)
    {
        $query = "insert into posts(title, content, image, created_at, user_id ) 
values(:title, :content, :image, :date, :user_id)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'title' => $dto->title,
            'content' => $dto->content,
            'image' => $dto->image,
            'date' => $dto->created_at,
            'user_id' => $dto->user_id
        ]);
    }

    public function getAllPosts(): array
    {
        $stmt = $this->pdo->query('select posts.*, posts.id as post_id, u.name as author_name from posts 
         left join users u on posts.user_id = u.id
          order by created_at asc');
        return $stmt->fetchAll();
    }

    public function selectSinglePost(int $postId): ?PostDTO
    {
        $query = "select * from posts where id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $postId]);

        $data = $stmt->fetch();
        if (!$data) {
            return null;
        }
        return new PostDTO(
            title: $data['title'],
            content: $data['content'],
            created_at: $data['created_at'],
            user_id: (int)$data['user_id'],
            image: $data['image'],
            id: (int)$data['id']
        );
    }

    public function updatePost(PostDTO $dto): bool
    {
        $data = $dto->getFields();

        if (empty($data)) {
            return false;
        }

        $keys = array_keys($data);
        $mapped = array_map(fn($key) => "$key = :$key", $keys);
        $fields = implode(', ', $mapped);

        $query = "update posts set $fields where id = :id";
        $stmt = $this->pdo->prepare($query);
        $payload = array_merge($data, ['id' => $dto->id]);
        return $stmt->execute($payload);
    }
}