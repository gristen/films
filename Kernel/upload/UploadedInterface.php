<?php

namespace App\Kernel\upload;

interface UploadedInterface
{
    public function move(string $path, string $fileName = null): string|false;

    public function getExtension(): string;

    public function hasErrors(): bool;
}
