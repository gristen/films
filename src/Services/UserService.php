<?php

namespace App\Services;

use App\Kernel\auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;
use App\Models\Movie;

class UserService
{
    private MoviesService $moviesService;

    public function __construct(private readonly DatabaseInterface $db, MoviesService $moviesService)
    {
        $this->moviesService = $moviesService;
    }

    public function find(int $id): User
    {
        $user = $this->db->first('users', ['id' => $id]);

        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['create_at'],
            $user['is_admin'],
            $user['avatar'],
            $user['password'],
        );
    }

    public function store(string $name, string $email, UploadedInterface $avatar, string $password): false|int
    {

        $avatarPath = $avatar->move('/user/avatars');

        return $this->db->insert('users', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'avatar' => $avatarPath,

        ]);
    }

    public function getFavoritesMovies(int $userId): array
    {

        $movieData = $this->db->get('favorites', ['user_id' => $userId]);
        $movies = [];
        foreach ($movieData as $data) {
            $movies[] = $this->db->get('movies', ['id' => $data['film_id']]);
        }

        return array_map(function ($movie) {

            return new Movie(

                $movie[0]['id'],
                $movie[0]['film'],
                $movie[0]['name'],
                $movie[0]['description'],
                $movie[0]['preview'],
                $movie[0]['category_id'],
                $movie[0]['create_at'],
                $this->moviesService->getReviews($movie[0]['id'])

            );
        }, $movies);
    }
}
