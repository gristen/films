<?php

namespace App\Kernel\auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $database,
        private SessionInterface $session,
        private ConfigInterface $config,

    ) {
    }

    //login
    public function attempt(string $email, string $password): bool
    {
        $user = $this->database->first($this->table(), [
            $this->email() => $email,  //'email' =>$email

        ]);

        if (! $user) {
            return false;

        }

        if (! password_verify($password, $user[$this->password()])) { //$user['password']
            return false;
        }

        $this->session->set($this->sessionField(), $user['id']);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField()); //есть ли такая сессия
    }

    public function user(): ?User
    {
        if (! $this->check()) {
            return null;
        }

        $user = $this->database->first($this->table(), [
            'id' => $this->session->get($this->sessionField()),
        ]);
        if ($user) {

            return new User($user['id'], $user['name'], $user[$this->email()], $user['create_at'], $user['role'],
                $user['avatar'], $user[$this->password()]);
        }

        return null;
    }

    public function isAdmin(): bool
    {
        $user = $this->database->first('users', [
            'id' => $this->session->get($this->sessionField()),
        ]);

        if ($user['role'] === '2') {
            return true;
        }

        return false;
    }

    //поля для бд
    public function table(): string
    {
        return $this->config->get('auth.table');
    }

    public function email(): string
    {
        return $this->config->get('auth.email');
    }

    public function password(): string
    {
        return $this->config->get('auth.password');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field');
    }

    public function id(): int
    {
        return $this->session->get($this->sessionField());
    }
}
