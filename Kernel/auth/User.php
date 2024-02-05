<?php

namespace App\Kernel\auth;

class User
{
    public function __construct(
        private int $id,
        private string $name,
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
        return $this->name;
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
}
