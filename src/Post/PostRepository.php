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
        $query = "insert into posts(title, content, image, created_at, user_id, cat_id ) 
values(:title, :content, :image, :date, :user_id, :cat_id)";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'title' => $dto->title,
            'content' => $dto->content,
            'image' => $dto->image,
            'date' => $dto->created_at,
            'user_id' => $dto->user_id,
            'cat_id' => $dto->cat_id,
        ]);
    }

    public function getAllPosts(): array
    {
        $stmt = $this->pdo->query('select posts.*, u.name as author_name, c.name as cat_name, c.color as cat_color, c.text_color as cat_text_color from posts 
        left join users u on posts.user_id = u.id
        left join categories c on c.id = posts.cat_id
        order by created_at asc');
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn(array $post) => new PostDTOWithAuthorName(
            author_name: $post['author_name'] ?? 'Deleted User',
            cat_name: $post['cat_name'] ?? 'None',
            cat_color: $post['cat_color'] ?? '#f3f4f6',
            cat_text_color: $post['cat_text_color'] ?? '#000000',
            title: $post['title'],
            content: $post['content'],
            created_at: $post['created_at'],
            user_id: (int)$post['user_id'],
            cat_id: (int)$post['cat_id'] ?? 1,
            image: $post['image'],
            id: (int)$post['id']
        ), $posts);
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
            cat_id: (int)$data['cat_id'] ?? 1,
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