<?php

use App\Controllers\AdminController;
use App\Controllers\CategoriesController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
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
    //category
    Route::get('/admin/categories/add', [CategoriesController::class, 'create']),
    Route::post('/admin/categories/add', [CategoriesController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategoriesController::class, 'destroy']),
    Route::get('/admin/categories/update', [CategoriesController::class, 'edit']),
    Route::post('/admin/categories/update', [CategoriesController::class, 'update']),
    //movies
    Route::get('/admin/movies/add', [MovieController::class, 'create']),
    Route::post('/admin/movies/add', [MovieController::class, 'store']),
    Route::post('/admin/movies/destroy', [MovieController::class, 'destroy']),
    Route::get('/admin/movies/update', [MovieController::class, 'edit']),
    Route::post('/admin/movies/update', [MovieController::class, 'update']),
    Route::get('/movie', [MovieController::class, 'show']),

    //review

    Route::post('/reviews/add', [ReviewController::class, 'store']),
];
