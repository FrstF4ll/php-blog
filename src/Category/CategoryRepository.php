<?php

namespace Frstf4ll\PhpBlog\Category;

use PDO;

class CategoryRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function selectAllCategories(): array
    {
        $query = 'select * from categories';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn (array $category) => new CategoryDTO(
            id: $category['id'],
            name: $category['name'],
            color: $category['color'],
        ), $categories);
    }
}