<?php

namespace Frstf4ll\PhpBlog\Category;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository){}
    public function getAllCategories(): array
    {
        return $this->categoryRepository->selectAllCategories();
    }
}