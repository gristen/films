<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Category;

class CategoryService
{
    public function __construct(private readonly DatabaseInterface $db)
    {

    }

    public function all(): array
    {
        $categories = $this->db->get('categories');

        return array_map(function ($category) {
            return new Category(
                id: $category['id'],
                name: $category['name'],
                createdAt: $category['created_at'],
                updatedAt: $category['updated_at'],
            );
        }, $categories);

    }

    public function delete(int $id)
    {
        $this->db->delete('categories', ['id' => $id]);
    }
}
