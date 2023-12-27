<?php

use App\Controllers\HomeController;
use App\Kernel\Routes\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
];
