<?php

namespace App\Services;

use App\Kernel\auth\User;
use App\Kernel\Database\DatabaseInterface;

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
            $user['password'],
        );
    }
}
