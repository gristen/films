<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;
use App\Models\Movie;

class MoviesService
{
    public function __construct(private readonly DatabaseInterface $db)
    {

    }

    public function store(string $name, string $description, UploadedInterface $image, int $category): false|int
    {
        $filePath = $image->move('movies'); // в какую папку созранится файл

        //ключи должны совпадать с полями бд т.к бины создаются с ключей с массива
        return $this->db->insert('movies', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
            'category_id' => $category,
        ]);

    }

    public function all(): array
    {
        $movies = $this->db->get('movies');

        return array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['category_id'],
            );
        }, $movies);
    }

    public function destroy(int $id): void
    {
        $this->db->delete('movies', ['id' => $id]);
    }
}
