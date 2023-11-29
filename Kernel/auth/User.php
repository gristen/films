<?php

namespace App\Kernel\auth;

class User
{
    public function __construct(
        private int $id,
        private string $email,
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
}
