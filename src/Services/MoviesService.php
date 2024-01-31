<?php

namespace App\Services;

use App\Kernel\auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;
use App\Models\Movie;
use App\Models\Review;

class MoviesService
{
    public function __construct(private readonly DatabaseInterface $db)
    {

    }

    public function store(string $name, UploadedInterface $film, string $description, UploadedInterface $image, int $category): false|int
    {

        $previewPath = $image->move('movies/preview'); // в какую папку созранится файл
        $filmPath = $film->move('movies');

        //ключи должны совпадать с полями бд т.к бины создаются с ключей с массива
        return $this->db->insert('movies', [
            'name' => $name,
            'film' => $filmPath,
            'description' => $description,
            'preview' => $previewPath,
            'category_id' => $category,
        ]);

    }

    public function all(): array
    {
        $movies = $this->db->get('movies');

        return array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['film'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['category_id'],
                $movie['create_at'],
            );
        }, $movies);
    }

    public function destroy(int $id): void
    {
        $this->db->delete('movies', ['id' => $id]);
    }

    public function find(int $id): ?Movie
    {
        $movie = $this->db->first('movies', [
            'id' => $id,
        ]);

        if (! $movie) {
            return null;
        }

        return new Movie(
            $movie['id'],
            $movie['film'],
            $movie['name'],
            $movie['description'],
            $movie['preview'],
            $movie['category_id'],
            $movie['create_at'],
            $this->getReviews($movie['id']) // FIXME: в данном случае это лишнее
        );
    }

    private function getReviews(int $id): array
    {
        $reviews = $this->db->get('reviews', [
            'movie_id' => $id,
        ]);

        return array_map(function ($review) {
            $user = $this->db->first('users', [
                'id' => $review['user_id'],
            ]);

            return new Review(
                $review['id'],
                $review['rating'],
                $review['review'],
                $review['created_at'],
                new User(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['create_at'],
                    $user['is_admin'],
                    $user['password'],
                )
            );
        }, $reviews);
    }

    public function update(int $id, string $name, string $description, ?UploadedInterface $image, int $category): void
    {

        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
        ];
        if ($image && ! $image->hasErrors()) {
            $filePath = $image->move('movies');
            $data['preview'] = $filePath;
        }

        $this->db->update('movies', $data,
            [
                'id' => $id,
            ]
        );

    }

    public function newMovies(): array
    {
        $movies = $this->db->get('movies', [], ['id' => 'DESC'], 5);

        return array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['film'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['category_id'],
                $movie['create_at'],
                $this->getReviews($movie['id'])
            );
        }, $movies);

    }
}
