<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;
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
                preview: $category['preview'],
                createdAt: $category['created_at'],
                updatedAt: $category['updated_at'],
            );
        }, $categories);

    }

    public function delete(int $id): void
    {
        $this->db->delete('categories', ['id' => $id]);
    }

    public function insert(string $name,UploadedInterface $image): void
    {

        $imagePath = $image->move('categories/preview');
        $this->db->insert('categories', ['name' => $name,'preview'=>$imagePath]);
    }

    public function find(int $id): ?Category
    {
        $category = $this->db->first('categories', ['id' => $id]);

        if (! $category) {
            return null;
        }

        return new Category(
            id: $category['id'],
            name: $category['name'],
            createdAt: $category['created_at'],
            updatedAt: $category['updated_at']
        );

    }

    public function update(int $id, string $name): void
    {
        $this->db->update('categories', ['name' => $name], ['id' => $id]); //таблица,какое поле мы меняем и дальше условие
    }
}
