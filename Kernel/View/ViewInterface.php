<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page(string $name, array $data = [], $title = []): void;

    public function components(string $name): void;

    public function getTitle(): string;
}
