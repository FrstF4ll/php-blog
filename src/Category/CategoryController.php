<?php

namespace Frstf4ll\PhpBlog\Category;

class CategoryController
{
    public function __construct(private CategoryService $categoryService)
    {

    }
    public function listCategories(): array
    {
        return $this->categoryService->getAllCategories();
    }
}