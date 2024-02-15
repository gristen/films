<?php

use App\Controllers\AdminController;
use App\Controllers\CategoriesController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\ProfileController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Controllers\UserController;
use App\Kernel\Router\Route;
use App\Middleware\AdminMiddleware;
use App\Middleware\GuestMiddleware;

return [

    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/', [HomeController::class, 'index']),

    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]),
    //category
    Route::get('/admin/categories/add', [CategoriesController::class, 'create'], [AdminMiddleware::class]),
    Route::post('/admin/categories/add', [CategoriesController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategoriesController::class, 'destroy']),
    Route::get('/admin/categories/update', [CategoriesController::class, 'edit'], [AdminMiddleware::class]),
    Route::post('/admin/categories/update', [CategoriesController::class, 'update']),
    //movies
    Route::get('/admin/movies/add', [MovieController::class, 'create'], [AdminMiddleware::class]),
    Route::post('/admin/movies/add', [MovieController::class, 'store']),
    Route::post('/admin/movies/destroy', [MovieController::class, 'destroy']),
    Route::get('/admin/movies/update', [MovieController::class, 'edit'], [AdminMiddleware::class]),
    Route::post('/admin/movies/update', [MovieController::class, 'update']),
    Route::get('/movie', [MovieController::class, 'show']),

    //review

    Route::post('/reviews/add', [ReviewController::class, 'store']),

    //admin
    Route::get('/admin/users', [UserController::class, 'admin']),
    Route::get('/admin/user/update', [UserController::class, 'edit']),
    //

    Route::get('/profile', [ProfileController::class, 'index']),

    Route::get('/favorites', [UserController::class, 'favorites']),
    Route::get('/favorites/destroy', [UserController::class, 'favoritesDestroy']),



    Route::get('/best', [MovieController::class, 'best']),

];
