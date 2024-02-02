<?php

namespace App\Services;

use App\Kernel\auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\upload\UploadedInterface;

class UserService
{
    public function __construct(private readonly DatabaseInterface $db)
    {

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
}
