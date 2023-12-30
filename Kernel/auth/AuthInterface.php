<?php

namespace App\Kernel\auth;

interface AuthInterface
{
    public function attempt(string $email, string $password): bool;

    public function logout(): void;

    public function check(): bool;

    public function user(): ?User; //либо нулл либо массив

    public function table(): string;

    public function email(): string;

    public function password(): string;

    public function sessionField(): string;
}