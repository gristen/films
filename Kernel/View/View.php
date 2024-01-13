<?php

namespace App\Kernel\View;

use App\Kernel\auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;

class View implements ViewInterface
{
    public function __construct(
        private readonly SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {

    }

    public function page(string $name, array $data = []): void
    {

        $viewPath = APP_PATH.'/views/pages/'.$name.'.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException('путь не найден');
        }

        extract(array_merge($this->defaultData(), $data));

        include_once $viewPath;
    }

    public function components(string $name): void
    {
        extract($this->defaultData());
        include_once APP_PATH.'/views/components/'.$name.'.php';
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'storage' => $this->storage,
        ];
    }
}
