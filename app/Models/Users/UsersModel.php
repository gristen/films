<?php

namespace app\Models\Users;

use app\Models\ActiveRecordEntity;

class UsersModel extends ActiveRecordEntity
{
    protected $username;

    protected $email;
    protected $isConfirmed;

    protected $role;
    protected $password;
    protected $avatar;
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


}

