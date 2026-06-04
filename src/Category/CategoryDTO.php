<?php

namespace Frstf4ll\PhpBlog\Category;

class CategoryDTO
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $color,
    )
    {
    }

}