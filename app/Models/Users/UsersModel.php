<?php

namespace app\Models\Users;

use app\Exceptions\InvalidArgumentException;
use app\Models\ActiveRecordEntity;

class UsersModel extends ActiveRecordEntity
{
    protected $username;

    protected $email;
    protected $isConfirmed;


    protected $password;

    protected $authToken;
    protected $created;

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->username;
    }

    protected static function getTableName(): string
    {
      return 'users';
    }

    public static function signUP(array $userData) :UsersModel
    {
        $user = new UsersModel();
        $user->username = "asd";
        $user->email = "asdasdadssad";
        $user->password = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = 0;
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;

    }


}

