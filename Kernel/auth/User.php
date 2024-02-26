<?php

namespace App\Kernel\auth;

class User
{
    public function __construct(
        private int $id,
        private string $username,
        private string $email,
        private string $create_at,
        private string $role,
        private string $avatar,
        private string $password,
    ) {

    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->username;
    }

    public function getCreateAt(): string
    {
        return $this->create_at;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getUserRole(): string
    {
        // Получаем идентификатор роли пользователя
        $roleId = $this->getRole();

        // Определяем название роли пользователя с помощью оператора switch
        switch ($roleId) {
            case 2:
                return 'Administrator';
            case 1:
                return 'User';
            default:
                return 'Неизвестная роль';
        }
    }

}
