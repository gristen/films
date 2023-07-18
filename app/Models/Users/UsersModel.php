<?php

namespace app\Models\Users;

use app\Services\DB;
use app\Exceptions\InvalidArgumentException;

class UsersModel
{

    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $CreatedAt;

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @return mixed
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->CreatedAt;
    }

    public function active():void
    {
        $this->isConfirmed = true;

    }


    public static  function sign(array $userData , array $userAvatar)
    {


        if (empty($userData['email'])||empty($userData['username'])||empty($userData['password'])||empty($userData['pass_conf'])||empty($userAvatar['avatar']['name']))
        {
            throw new InvalidArgumentException('Не передан nickname');

        }elseif (empty($userAvatar['avatar']['name']))
        {
            throw new InvalidArgumentException('Не передан avatar');

        }elseif (mb_strlen($userData['password']) < 5)
        {
            throw new InvalidArgumentException('больше 5 ');

        }elseif (mb_strlen($userData['email'])<10)
        {
            throw new InvalidArgumentException('емайл меньше 10');

        }

       $user = new UsersModel();
        $user->nickname = $userData['username'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'],PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = '1';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));



        self::InsertUser($userData['username'],$userData['email'],$user->getPasswordHash(),$user->getIsConfirmed(),$user->getRole(),$user->getAuthToken());
        return $user;

    }

    private static function InsertUser($nickname,$email,$pass,$conf,$role,$token)
    {
        $db = new DB;
        $query = $db->pdo->prepare("INSERT INTO users (email,username,password,avatar,auth_token,role,is_confirmed) VALUES (:email,:username,:password,:avatar,:token,:role,:is_confirmed)");
        $query->execute([
            "email"=>$email,
            "username"=>$nickname,
            "password"=>$pass,
            "avatar"=>"avatar",
            "token"=>$token,
            "role"=>$role,
            "is_confirmed"=>$conf,

        ]);

    }

}