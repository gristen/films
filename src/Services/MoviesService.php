<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;

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
}
