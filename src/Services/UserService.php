<?php

namespace App\Services;

use App\Kernel\auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;
use App\Models\Movie;

class UserService
{
    private ?MoviesService $moviesService;

    public function __construct(private readonly DatabaseInterface $db, ?MoviesService $moviesService = null)
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
            $user['id_role'],
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
            'id_role' => 1,

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
                //$this->moviesService->getReviews($movie[0]['id'])

            );
        }, $movies);
    }

    public function getUsers(): array
    {
        $users = $this->db->get('users');

        return array_map(function ($user) {

            return new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['create_at'],
                $user['id_role'],
                $user['avatar'],
                $user['password'],

            );
        }, $users);
    }

    public function update(int $id,string $name,?UploadedInterface $image): void
    {
        $data = [
            'name'=>$name,

        ];

        if ($image && ! $image->hasErrors()) {
            $filePath = $image->move('movies');
            $data['avatar'] = $filePath;
        }
        $this->db->update('users',$data,['id'=>$id]);
    }


    public function getRegUser(array $data):? array
    {


        $userDataFromDatabase =$data;



        $monthsNames = array(
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь'
        );

        // Подготовка данных для графика
        $months = array();
        $userCounts = array();

        foreach ($userDataFromDatabase as $data) {
            $months[] = $monthsNames[$data["month"]]; // Получаем название месяца из массива $monthsNames
            $userCounts[] = $data["user_count"];
        }
        return [
            'months'=>$months,
            'userCount'=>$userCounts
        ];
    }


}
