<?php

use App\Controllers\AdminController;
use App\Controllers\CategoriesController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;

return [

    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/', [HomeController::class, 'index']),

    Route::get('/register', [RegisterController::class, 'index']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index']),
    Route::get('/admin/categories/add', [CategoriesController::class, 'create']),
    Route::post('/admin/categories/destroy', [CategoriesController::class, 'destroy']),

];
